<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EnergySource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EnergySourceController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = EnergySource::with(['user', 'region']);

        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('region_id')) {
            $query->where('region_id', $request->region_id);
        }

        if ($request->has('search')) {
            $query->where('name', 'like', "%{$request->search}%");
        }

        $sources = $query->orderBy('created_at', 'desc')
            ->paginate($request->get('per_page', 15));

        return response()->json([
            'success' => true,
            'message' => 'Data sumber energi berhasil diambil',
            'data' => $sources,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'type' => 'required|in:solar,wind,hydro,biomass,geothermal,other',
            'description' => 'required|string',
            'address' => 'required|string',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'total_capacity_kwh' => 'required|numeric|min:0',
            'available_capacity_kwh' => 'required|numeric|min:0',
            'region_id' => 'nullable|exists:regions,id',
            'photo' => 'nullable|image|max:2048',
        ]);

        $validated['user_id'] = $request->user()->id;
        $validated['status'] = 'active';

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('energy-sources', 'public');
        }

        $source = EnergySource::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Sumber energi berhasil ditambahkan',
            'data' => $source->load(['user', 'region']),
        ], 201);
    }

    public function show(EnergySource $energySource): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Detail sumber energi berhasil diambil',
            'data' => $energySource->load(['user', 'region']),
        ]);
    }

    public function update(Request $request, EnergySource $energySource): JsonResponse
    {
        $user = $request->user();

        if ($user->id !== $energySource->user_id && !$user->hasRole('admin')) {
            return response()->json(['success' => false, 'message' => 'Tidak memiliki akses'], 403);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:150',
            'type' => 'sometimes|in:solar,wind,hydro,biomass,geothermal,other',
            'description' => 'sometimes|string',
            'address' => 'sometimes|string',
            'latitude' => 'sometimes|numeric|between:-90,90',
            'longitude' => 'sometimes|numeric|between:-180,180',
            'total_capacity_kwh' => 'sometimes|numeric|min:0',
            'available_capacity_kwh' => 'sometimes|numeric|min:0',
            'status' => 'sometimes|in:active,inactive,maintenance',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('energy-sources', 'public');
        }

        $energySource->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Sumber energi berhasil diubah',
            'data' => $energySource->load(['user', 'region']),
        ]);
    }

    public function destroy(EnergySource $energySource): JsonResponse
    {
        $energySource->delete();

        return response()->json([
            'success' => true,
            'message' => 'Sumber energi berhasil dihapus',
        ]);
    }

    /**
     * FR-ENERGY-005 Update capacity
     */
    public function updateCapacity(Request $request, EnergySource $energySource): JsonResponse
    {
        $validated = $request->validate([
            'available_capacity_kwh' => 'required|numeric|min:0',
        ]);

        $energySource->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Kapasitas berhasil diperbarui',
            'data' => $energySource,
        ]);
    }
}
