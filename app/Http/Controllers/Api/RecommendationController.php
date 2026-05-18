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
        $sources = \App\Models\EnergySource::where('status', 'active')->where('available_capacity_kwh', '>', 0)->get();
        
        if ($sources->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'Tidak ada sumber energi aktif yang tersedia']);
        }

        $results = [];
        $gemini = new \App\Services\GeminiService();

        // Siapkan data sumber energi untuk AI
        $sourcesList = "";
        foreach ($sources as $s) {
            $sourcesList .= "- ID: {$s->id} | Nama: {$s->name} | Kapasitas Tersedia: {$s->available_capacity_kwh} kWh | Lokasi (Lat, Lng): {$s->latitude}, {$s->longitude}\n";
        }

        foreach ($businesses as $biz) {
            // Hitung jarak ke setiap pembangkit sebagai data referensi (konteks) untuk AI
            $distancesContext = "";
            foreach ($sources as $s) {
                $dist = $scorer->haversineDistance($biz->latitude, $biz->longitude, $s->latitude, $s->longitude);
                $distancesContext .= "- Jarak ke {$s->name} (ID {$s->id}): {$dist} km\n";
            }

            $prompt = "Anda adalah AI Sistem Rekomendasi Energi. Pilihlah 1 sumber energi terbaik untuk UMKM ini:\n"
                . "Profil UMKM:\nNama: {$biz->name}\nKebutuhan Energi: {$biz->monthly_energy_need} kWh\nKaryawan: {$biz->employee_count}\nIndustri: {$biz->industry_type}\nDampak Ekonomi: {$biz->economic_impact}\n\n"
                . "Daftar Sumber Energi Aktif:\n{$sourcesList}\n"
                . "Jarak UMKM ke masing-masing sumber:\n{$distancesContext}\n\n"
                . "TUGAS:\n1. Pilih 1 ID Sumber Energi terdekat dan paling cocok kapasitasnya.\n"
                . "2. Tentukan total skor prioritas (0-100).\n"
                . "3. Tentukan kategori ('High Priority', 'Medium Priority', 'Low Priority').\n"
                . "4. Tentukan skor breakdown (skala 0-100) untuk: energy_need_score, economic_impact_score, worker_score, distance_score, emission_reduction_score, clean_energy_access_score.\n"
                . "5. Buat 'summary' (1 kalimat) dan 'reasoning' (alasan logis mengapa Anda memilih sumber ini).\n\n"
                . "KEMBALIKAN HANYA JSON DENGAN FORMAT INI:\n"
                . '{"best_energy_source_id": int, "total_score": float, "category": string, "energy_need_score": float, "economic_impact_score": float, "worker_score": float, "distance_score": float, "emission_reduction_score": float, "clean_energy_access_score": float, "summary": string, "reasoning": string}';

            $aiData = $gemini->generateJson($prompt);

            if ($aiData && isset($aiData['best_energy_source_id'])) {
                $nearest = $sources->firstWhere('id', $aiData['best_energy_source_id']);
                
                if ($nearest) {
                    $distKm = $scorer->haversineDistance($biz->latitude, $biz->longitude, $nearest->latitude, $nearest->longitude);
                    $estSaving = $biz->current_energy_cost * 0.23;
                    $estEmission = $biz->monthly_energy_need * 0.5;

                    // Simpan Keputusan Murni AI ke PriorityScore
                    $scoreModel = \App\Models\PriorityScore::create([
                        'business_id' => $biz->id,
                        'score' => $aiData['total_score'],
                        'category' => $aiData['category'],
                        'energy_need_score' => $aiData['energy_need_score'],
                        'economic_impact_score' => $aiData['economic_impact_score'],
                        'worker_score' => $aiData['worker_score'],
                        'distance_score' => $aiData['distance_score'],
                        'emission_reduction_score' => $aiData['emission_reduction_score'],
                        'clean_energy_access_score' => $aiData['clean_energy_access_score'],
                    ]);

                    $rec = Recommendation::create([
                        'business_id' => $biz->id, 'energy_source_id' => $nearest->id,
                        'priority_score_id' => $scoreModel->id, 'recommended_energy_kwh' => min($biz->monthly_energy_need, $nearest->available_capacity_kwh),
                        'distance_km' => $distKm, 'estimated_cost_saving' => $estSaving,
                        'estimated_emission_reduction' => $estEmission,
                        'ai_summary' => $aiData['summary'],
                        'ai_reasoning' => $aiData['reasoning'],
                        'action_plan' => "1. Verifikasi kebutuhan energi\n2. Koordinasi dengan penyedia\n3. Mulai distribusi",
                        'confidence_score' => min($aiData['total_score'], 95),
                        'status' => 'draft', 'generated_by' => $request->user()->id,
                    ]);
                    $results[] = $rec->load(['business', 'energySource', 'priorityScore']);
                }
            }
        }

        return response()->json(['success' => true, 'message' => count($results) . ' rekomendasi diputuskan oleh AI', 'data' => $results]);
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
