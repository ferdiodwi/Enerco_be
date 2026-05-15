<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EnergyNeed;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EnergyNeedController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = EnergyNeed::with('business');

        if ($request->has('business_id')) {
            $query->where('business_id', $request->business_id);
        }

        if ($request->has('validation_status')) {
            $query->where('validation_status', $request->validation_status);
        }

        $needs = $query->orderBy('created_at', 'desc')
            ->paginate($request->get('per_page', 15));

        return response()->json([
            'success' => true,
            'message' => 'Data kebutuhan energi berhasil diambil',
            'data' => $needs,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'business_id' => 'required|exists:businesses,id',
            'period' => 'required|string|max:20',
            'monthly_need_kwh' => 'required|numeric|min:0',
            'operating_hours_per_day' => 'required|integer|min:1|max:24',
            'main_equipment' => 'required|string',
            'current_energy_cost' => 'required|numeric|min:0',
            'energy_problem' => 'required|string',
        ]);

        $validated['validation_status'] = 'pending';

        $need = EnergyNeed::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Kebutuhan energi berhasil ditambahkan',
            'data' => $need->load('business'),
        ], 201);
    }

    public function show(EnergyNeed $energyNeed): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Detail kebutuhan energi berhasil diambil',
            'data' => $energyNeed->load('business'),
        ]);
    }

    public function update(Request $request, EnergyNeed $energyNeed): JsonResponse
    {
        $validated = $request->validate([
            'period' => 'sometimes|string|max:20',
            'monthly_need_kwh' => 'sometimes|numeric|min:0',
            'operating_hours_per_day' => 'sometimes|integer|min:1|max:24',
            'main_equipment' => 'sometimes|string',
            'current_energy_cost' => 'sometimes|numeric|min:0',
            'energy_problem' => 'sometimes|string',
        ]);

        $energyNeed->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Kebutuhan energi berhasil diubah',
            'data' => $energyNeed->load('business'),
        ]);
    }

    public function validate_need(Request $request, EnergyNeed $energyNeed): JsonResponse
    {
        $validated = $request->validate([
            'validation_status' => 'required|in:pending,validated,rejected',
        ]);

        $energyNeed->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Status validasi kebutuhan energi berhasil diubah',
            'data' => $energyNeed,
        ]);
    }
}
