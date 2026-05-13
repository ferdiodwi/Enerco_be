<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ImpactReport;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ImpactReportController extends Controller
{
    /**
     * Display a listing of impact reports.
     *
     * GET /api/impact-reports
     */
    public function index(Request $request): JsonResponse
    {
        $query = ImpactReport::with(['business', 'distributionRecommendation.energySource']);

        // Filter by business
        if ($request->has('business_id')) {
            $query->where('business_id', $request->business_id);
        }

        // Filter by period
        if ($request->has('report_period')) {
            $query->where('report_period', $request->report_period);
        }

        $reports = $query->orderBy('created_at', 'desc')->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $reports,
        ]);
    }

    /**
     * Store a newly created impact report.
     *
     * POST /api/impact-reports
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'business_id' => ['required', 'exists:businesses,id'],
            'distribution_recommendation_id' => ['nullable', 'exists:distribution_recommendations,id'],
            'old_energy_cost' => ['required', 'numeric', 'min:0'],
            'new_energy_cost' => ['required', 'numeric', 'min:0'],
            'productivity_increase_percentage' => ['required', 'numeric', 'min:0', 'max:100'],
            'estimated_emission_reduction' => ['required', 'numeric', 'min:0'],
            'report_period' => ['required', 'string', 'max:50'],
            'notes' => ['nullable', 'string'],
        ]);

        $validated['cost_saving'] = $validated['old_energy_cost'] - $validated['new_energy_cost'];

        $report = ImpactReport::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Impact report created successfully.',
            'data' => $report->load(['business', 'distributionRecommendation']),
        ], 201);
    }

    /**
     * Display the specified impact report.
     *
     * GET /api/impact-reports/{id}
     */
    public function show(ImpactReport $impactReport): JsonResponse
    {
        $impactReport->load(['business', 'distributionRecommendation.energySource']);

        return response()->json([
            'success' => true,
            'data' => $impactReport,
        ]);
    }
}
