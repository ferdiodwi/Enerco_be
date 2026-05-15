<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Services\PriorityScoringService;
use App\Models\Recommendation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Recommendation::with(['business', 'energySource', 'priorityScore']);
        if ($request->has('status')) $query->where('status', $request->status);
        if ($request->has('business_id')) $query->where('business_id', $request->business_id);

        $recs = $query->orderBy('created_at', 'desc')->paginate($request->get('per_page', 15));
        return response()->json(['success' => true, 'data' => $recs]);
    }

    public function generate(Request $request): JsonResponse
    {
        $scorer = new PriorityScoringService();
        $businesses = Business::where('verification_status', 'verified')->get();
        $results = [];

        foreach ($businesses as $biz) {
            $score = $scorer->calculate($biz);
            $nearest = $this->findBestSource($biz, $scorer);

            if ($nearest) {
                $distKm = $scorer->haversineDistance($biz->latitude, $biz->longitude, $nearest->latitude, $nearest->longitude);
                $estSaving = $biz->current_energy_cost * 0.23;
                $estEmission = $biz->monthly_energy_need * 0.5;

                $rec = Recommendation::create([
                    'business_id' => $biz->id, 'energy_source_id' => $nearest->id,
                    'priority_score_id' => $score->id, 'recommended_energy_kwh' => min($biz->monthly_energy_need, $nearest->available_capacity_kwh),
                    'distance_km' => $distKm, 'estimated_cost_saving' => $estSaving,
                    'estimated_emission_reduction' => $estEmission,
                    'ai_summary' => "UMKM {$biz->name} direkomendasikan untuk distribusi energi dari {$nearest->name}.",
                    'ai_reasoning' => "Skor prioritas: {$score->score} ({$score->category}). Jarak: {$distKm} km.",
                    'action_plan' => "1. Verifikasi kebutuhan energi\n2. Koordinasi dengan penyedia\n3. Mulai distribusi",
                    'confidence_score' => min($score->score, 95),
                    'status' => 'draft', 'generated_by' => $request->user()->id,
                ]);
                $results[] = $rec->load(['business', 'energySource', 'priorityScore']);
            }
        }

        return response()->json(['success' => true, 'message' => count($results) . ' rekomendasi berhasil digenerate', 'data' => $results]);
    }

    public function show(Recommendation $recommendation): JsonResponse
    {
        return response()->json(['success' => true, 'data' => $recommendation->load(['business', 'energySource', 'priorityScore'])]);
    }

    public function updateStatus(Request $request, Recommendation $recommendation): JsonResponse
    {
        $v = $request->validate(['status' => 'required|in:draft,reviewed,approved,rejected']);
        $recommendation->update($v);
        return response()->json(['success' => true, 'data' => $recommendation]);
    }

    private function findBestSource(Business $biz, PriorityScoringService $scorer)
    {
        $sources = \App\Models\EnergySource::where('status', 'active')->where('available_capacity_kwh', '>', 0)->get();
        $best = null; $minDist = PHP_FLOAT_MAX;
        foreach ($sources as $s) {
            $d = $scorer->haversineDistance($biz->latitude, $biz->longitude, $s->latitude, $s->longitude);
            if ($d < $minDist) { $minDist = $d; $best = $s; }
        }
        return $best;
    }
}
