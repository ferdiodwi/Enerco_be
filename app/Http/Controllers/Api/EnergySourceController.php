<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EnergySource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EnergySourceController extends Controller
{
    /**
     * Display a listing of energy sources.
     *
     * GET /api/energy-sources
     */
    public function index(Request $request): JsonResponse
    {
        $query = EnergySource::with('provider');

        // Filter by type
        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter by city
        if ($request->has('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }

        // Filter by province
        if ($request->has('province')) {
            $query->where('province', 'like', '%' . $request->province . '%');
        }

        // Filter by minimum available capacity
        if ($request->has('min_available_kwh')) {
            $query->where('available_kwh', '>=', $request->min_available_kwh);
        }

        $energySources = $query->orderBy('created_at', 'desc')->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $energySources,
        ]);
    }

    /**
     * Store a newly created energy source.
     *
     * POST /api/energy-sources
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:solar,wind,hydro,biomass,hybrid'],
            'description' => ['nullable', 'string'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:100'],
            'province' => ['required', 'string', 'max:100'],
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
            'capacity_kwh' => ['required', 'numeric', 'min:0'],
            'available_kwh' => ['required', 'numeric', 'min:0'],
            'cost_per_kwh' => ['required', 'numeric', 'min:0'],
        ]);

        $validated['provider_id'] = $request->user()->id;
        $validated['status'] = 'active';

        $energySource = EnergySource::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Energy source created successfully.',
            'data' => $energySource->load('provider'),
        ], 201);
    }

    /**
     * Display the specified energy source.
     *
     * GET /api/energy-sources/{id}
     */
    public function show(EnergySource $energySource): JsonResponse
    {
        $energySource->load([
            'provider',
            'distributionRecommendations.business',
        ]);

        return response()->json([
            'success' => true,
            'data' => $energySource,
        ]);
    }

    /**
     * Update the specified energy source.
     *
     * PUT /api/energy-sources/{id}
     */
    public function update(Request $request, EnergySource $energySource): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'type' => ['sometimes', 'in:solar,wind,hydro,biomass,hybrid'],
            'description' => ['nullable', 'string'],
            'address' => ['sometimes', 'string', 'max:255'],
            'city' => ['sometimes', 'string', 'max:100'],
            'province' => ['sometimes', 'string', 'max:100'],
            'latitude' => ['sometimes', 'numeric', 'between:-90,90'],
            'longitude' => ['sometimes', 'numeric', 'between:-180,180'],
            'capacity_kwh' => ['sometimes', 'numeric', 'min:0'],
            'available_kwh' => ['sometimes', 'numeric', 'min:0'],
            'cost_per_kwh' => ['sometimes', 'numeric', 'min:0'],
            'status' => ['sometimes', 'in:active,full,maintenance,inactive'],
        ]);

        $energySource->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Energy source updated successfully.',
            'data' => $energySource->fresh('provider'),
        ]);
    }

    /**
     * Remove the specified energy source.
     *
     * DELETE /api/energy-sources/{id}
     */
    public function destroy(EnergySource $energySource): JsonResponse
    {
        $energySource->delete();

        return response()->json([
            'success' => true,
            'message' => 'Energy source deleted successfully.',
        ]);
    }
}
