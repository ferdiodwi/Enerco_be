<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Business;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    /**
     * Display a listing of businesses.
     *
     * GET /api/businesses
     */
    public function index(Request $request): JsonResponse
    {
        $query = Business::with(['user', 'latestPriorityScore']);

        // Filter by sector
        if ($request->has('sector')) {
            $query->where('sector', $request->sector);
        }

        // Filter by city
        if ($request->has('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }

        // Filter by province
        if ($request->has('province')) {
            $query->where('province', 'like', '%' . $request->province . '%');
        }

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter by clean energy access
        if ($request->has('clean_energy_access')) {
            $query->where('clean_energy_access', $request->boolean('clean_energy_access'));
        }

        $businesses = $query->orderBy('created_at', 'desc')->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $businesses,
        ]);
    }

    /**
     * Store a newly created business.
     *
     * POST /api/businesses
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sector' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:100'],
            'province' => ['required', 'string', 'max:100'],
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
            'monthly_energy_need' => ['required', 'numeric', 'min:0'],
            'current_energy_cost' => ['required', 'numeric', 'min:0'],
            'production_capacity' => ['nullable', 'numeric', 'min:0'],
            'employee_count' => ['required', 'integer', 'min:0'],
            'clean_energy_access' => ['boolean'],
        ]);

        $validated['user_id'] = $request->user()->id;

        $business = Business::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Business created successfully.',
            'data' => $business->load('user'),
        ], 201);
    }

    /**
     * Display the specified business.
     *
     * GET /api/businesses/{id}
     */
    public function show(Business $business): JsonResponse
    {
        $business->load([
            'user',
            'latestPriorityScore',
            'distributionRecommendations.energySource',
            'impactReports',
            'products',
        ]);

        return response()->json([
            'success' => true,
            'data' => $business,
        ]);
    }

    /**
     * Update the specified business.
     *
     * PUT /api/businesses/{id}
     */
    public function update(Request $request, Business $business): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'sector' => ['sometimes', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'address' => ['sometimes', 'string', 'max:255'],
            'city' => ['sometimes', 'string', 'max:100'],
            'province' => ['sometimes', 'string', 'max:100'],
            'latitude' => ['sometimes', 'numeric', 'between:-90,90'],
            'longitude' => ['sometimes', 'numeric', 'between:-180,180'],
            'monthly_energy_need' => ['sometimes', 'numeric', 'min:0'],
            'current_energy_cost' => ['sometimes', 'numeric', 'min:0'],
            'production_capacity' => ['nullable', 'numeric', 'min:0'],
            'employee_count' => ['sometimes', 'integer', 'min:0'],
            'clean_energy_access' => ['boolean'],
            'status' => ['sometimes', 'in:active,inactive,pending'],
        ]);

        $business->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Business updated successfully.',
            'data' => $business->fresh('user'),
        ]);
    }

    /**
     * Remove the specified business.
     *
     * DELETE /api/businesses/{id}
     */
    public function destroy(Business $business): JsonResponse
    {
        $business->delete();

        return response()->json([
            'success' => true,
            'message' => 'Business deleted successfully.',
        ]);
    }
}
