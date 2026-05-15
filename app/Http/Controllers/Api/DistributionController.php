<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Distribution;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DistributionController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $q = Distribution::with(['recommendation', 'business', 'energySource']);
        if ($request->has('status')) $q->where('status', $request->status);
        if ($request->has('business_id')) $q->where('business_id', $request->business_id);
        $data = $q->orderBy('created_at', 'desc')->paginate($request->get('per_page', 15));
        return response()->json(['success' => true, 'data' => $data]);
    }

    public function store(Request $request): JsonResponse
    {
        $v = $request->validate([
            'recommendation_id' => 'required|exists:recommendations,id',
            'business_id' => 'required|exists:businesses,id',
            'energy_source_id' => 'required|exists:energy_sources,id',
            'allocated_energy_kwh' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'notes' => 'nullable|string',
        ]);
        $v['status'] = 'planned';
        $dist = Distribution::create($v);
        return response()->json(['success' => true, 'data' => $dist->load(['business', 'energySource'])], 201);
    }

    public function show(Distribution $distribution): JsonResponse
    {
        return response()->json(['success' => true, 'data' => $distribution->load(['recommendation', 'business', 'energySource'])]);
    }

    public function update(Request $request, Distribution $distribution): JsonResponse
    {
        $v = $request->validate([
            'allocated_energy_kwh' => 'sometimes|numeric|min:0',
            'start_date' => 'sometimes|date', 'end_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);
        $distribution->update($v);
        return response()->json(['success' => true, 'data' => $distribution]);
    }

    public function updateStatus(Request $request, Distribution $distribution): JsonResponse
    {
        $v = $request->validate(['status' => 'required|in:planned,in_progress,completed,cancelled']);
        $distribution->update($v);
        return response()->json(['success' => true, 'data' => $distribution]);
    }
}
