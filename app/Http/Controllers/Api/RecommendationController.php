<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DistributionRecommendation;
use App\Models\PriorityScore;
use App\Services\RecommendationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    public function __construct(
        private RecommendationService $recommendationService,
    ) {}

    /**
     * Generate recommendations for all active businesses.
     *
     * POST /api/recommendations/generate
     */
    public function generate(): JsonResponse
    {
        $recommendations = $this->recommendationService->generateRecommendations();

        // Reload with relations
        $ids = collect($recommendations)->pluck('id');
        $loaded = DistributionRecommendation::with(['business', 'energySource', 'priorityScore'])
            ->whereIn('id', $ids)
            ->get();

        return response()->json([
            'success' => true,
            'message' => count($recommendations) . ' recommendation(s) generated successfully.',
            'data' => $loaded,
        ]);
    }

    /**
     * Display a listing of recommendations.
     *
     * GET /api/recommendations
     */
    public function index(Request $request): JsonResponse
    {
        $query = DistributionRecommendation::with([
            'business',
            'energySource',
            'priorityScore',
        ]);

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter by business
        if ($request->has('business_id')) {
            $query->where('business_id', $request->business_id);
        }

        // Filter by priority level
        if ($request->has('priority_level')) {
            $query->whereHas('priorityScore', function ($q) use ($request) {
                $q->where('priority_level', $request->priority_level);
            });
        }

        // Sort by priority score (highest first)
        $query->orderByDesc(
            PriorityScore::select('total_score')
                ->whereColumn('priority_scores.id', 'distribution_recommendations.priority_score_id')
                ->limit(1)
        );

        $recommendations = $query->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $recommendations,
        ]);
    }

    /**
     * Display the specified recommendation.
     *
     * GET /api/recommendations/{id}
     */
    public function show(DistributionRecommendation $recommendation): JsonResponse
    {
        $recommendation->load([
            'business.user',
            'energySource.provider',
            'priorityScore',
            'impactReport',
        ]);

        return response()->json([
            'success' => true,
            'data' => $recommendation,
        ]);
    }

    /**
     * Update the status of a recommendation.
     *
     * PUT /api/recommendations/{id}/status
     */
    public function updateStatus(Request $request, DistributionRecommendation $recommendation): JsonResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:draft,recommended,approved,rejected,implemented'],
        ]);

        $recommendation->update(['status' => $validated['status']]);

        return response()->json([
            'success' => true,
            'message' => 'Recommendation status updated.',
            'data' => $recommendation->fresh([
                'business',
                'energySource',
                'priorityScore',
            ]),
        ]);
    }
}
