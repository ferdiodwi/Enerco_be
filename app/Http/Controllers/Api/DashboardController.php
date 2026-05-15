<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Distribution;
use App\Models\EnergySource;
use App\Models\ImpactReport;
use App\Models\Product;
use App\Models\Recommendation;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'total_users' => User::count(),
                'total_businesses' => Business::count(),
                'total_energy_sources' => EnergySource::count(),
                'total_recommendations' => Recommendation::count(),
                'active_distributions' => Distribution::whereIn('status', ['planned', 'in_progress'])->count(),
                'total_products' => Product::count(),
                'recent_recommendations' => Recommendation::with('business:id,name')->latest()->take(5)->get(),
            ],
        ]);
    }

    public function umkm(Request $request): JsonResponse
    {
        $user = $request->user();
        $biz = $user->business;

        if (!$biz) {
            return response()->json(['success' => true, 'data' => ['has_business' => false]]);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'has_business' => true,
                'business' => $biz,
                'verification_status' => $biz->verification_status,
                'energy_needs_count' => $biz->energyNeeds()->count(),
                'recommendations_count' => $biz->recommendations()->count(),
                'products_count' => $biz->products()->count(),
                'latest_score' => $biz->latestPriorityScore,
            ],
        ]);
    }

    public function government(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'total_businesses' => Business::count(),
                'verified_businesses' => Business::where('verification_status', 'verified')->count(),
                'total_energy_sources' => EnergySource::where('status', 'active')->count(),
                'total_recommendations' => Recommendation::count(),
                'approved_recommendations' => Recommendation::where('status', 'approved')->count(),
                'total_energy_distributed' => Distribution::where('status', 'completed')->sum('allocated_energy_kwh'),
            ],
        ]);
    }

    public function provider(Request $request): JsonResponse
    {
        $user = $request->user();
        $sources = $user->energySources;

        return response()->json([
            'success' => true,
            'data' => [
                'total_sources' => $sources->count(),
                'total_capacity' => $sources->sum('total_capacity_kwh'),
                'available_capacity' => $sources->sum('available_capacity_kwh'),
                'active_distributions' => Distribution::whereIn('energy_source_id', $sources->pluck('id'))
                    ->whereIn('status', ['planned', 'in_progress'])->count(),
            ],
        ]);
    }

    public function partner(Request $request): JsonResponse
    {
        $user = $request->user();
        return response()->json([
            'success' => true,
            'data' => [
                'potential_businesses' => Business::where('verification_status', 'verified')->count(),
                'total_products' => Product::where('status', 'active')->count(),
                'my_partnerships' => $user->sentPartnershipRequests()->count() + $user->receivedPartnershipRequests()->count(),
                'pending_partnerships' => $user->sentPartnershipRequests()->where('status', 'pending')->count(),
            ],
        ]);
    }
}
