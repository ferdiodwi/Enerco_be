<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PriorityScore;
use App\Models\Business;
use App\Services\ScoringService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PriorityScoreController extends Controller
{
    public function __construct(
        private ScoringService $scoringService,
    ) {}

    /**
     * Calculate priority scores for all active businesses.
     *
     * POST /api/priority-scores/calculate
     */
    public function calculate(): JsonResponse
    {
        $scores = $this->scoringService->calculateForAllBusinesses();

        $ids = collect($scores)->pluck('id');
        $loaded = PriorityScore::with('business')->whereIn('id', $ids)->get();

        return response()->json([
            'success' => true,
            'message' => count($scores) . ' priority score(s) calculated.',
            'data' => $loaded,
        ]);
    }

    /**
     * Display a listing of priority scores.
     *
     * GET /api/priority-scores
     */
    public function index(Request $request): JsonResponse
    {
        $query = PriorityScore::with('business');

        // Filter by priority level
        if ($request->has('priority_level')) {
            $query->where('priority_level', $request->priority_level);
        }

        // Filter by business
        if ($request->has('business_id')) {
            $query->where('business_id', $request->business_id);
        }

        // Only latest scores per business
        if ($request->boolean('latest_only', true)) {
            $query->whereIn('id', function ($sub) {
                $sub->selectRaw('MAX(id)')
                    ->from('priority_scores')
                    ->groupBy('business_id');
            });
        }

        $scores = $query->orderByDesc('total_score')->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $scores,
        ]);
    }

    /**
     * Display the specified priority score.
     *
     * GET /api/priority-scores/{id}
     */
    public function show(PriorityScore $priorityScore): JsonResponse
    {
        $priorityScore->load(['business.user', 'distributionRecommendations']);

        return response()->json([
            'success' => true,
            'data' => $priorityScore,
        ]);
    }
}
