<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\EnergySource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function markers(Request $request): JsonResponse
    {
        $bq = Business::where('verification_status', 'verified');
        $eq = EnergySource::where('status', 'active');

        if ($request->has('sector')) $bq->where('sector', $request->sector);
        if ($request->has('energy_type')) $eq->where('type', $request->energy_type);
        if ($request->has('region_id')) {
            $bq->where('region_id', $request->region_id);
            $eq->where('region_id', $request->region_id);
        }

        $businesses = $bq->select('id','name','sector','latitude','longitude','monthly_energy_need','verification_status')
            ->with('latestPriorityScore:id,business_id,score,category')->get()
            ->map(fn($b) => [
                'id' => $b->id, 'type' => 'business', 'name' => $b->name,
                'sector' => $b->sector, 'latitude' => $b->latitude, 'longitude' => $b->longitude,
                'energy_need' => $b->monthly_energy_need,
                'priority_score' => $b->latestPriorityScore?->score,
                'priority_category' => $b->latestPriorityScore?->category,
            ]);

        $sources = $eq->select('id','name','type','latitude','longitude','total_capacity_kwh','available_capacity_kwh','status')
            ->get()->map(fn($e) => [
                'id' => $e->id, 'type' => 'energy_source', 'name' => $e->name,
                'energy_type' => $e->type, 'latitude' => $e->latitude, 'longitude' => $e->longitude,
                'total_capacity' => $e->total_capacity_kwh, 'available_capacity' => $e->available_capacity_kwh,
            ]);

        return response()->json(['success' => true, 'data' => ['businesses' => $businesses, 'energy_sources' => $sources]]);
    }

    public function priorityAreas(): JsonResponse
    {
        $regions = \App\Models\Region::withCount('businesses')
            ->with(['businesses:id,region_id,monthly_energy_need'])->get()
            ->map(fn($r) => [
                'id' => $r->id, 'name' => $r->name, 'province' => $r->province,
                'latitude' => $r->latitude, 'longitude' => $r->longitude,
                'priority_level' => $r->priority_level, 'business_count' => $r->businesses_count,
                'total_energy_need' => $r->businesses->sum('monthly_energy_need'),
            ]);

        return response()->json(['success' => true, 'data' => $regions]);
    }
}
