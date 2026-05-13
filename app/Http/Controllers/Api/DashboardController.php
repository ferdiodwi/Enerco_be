<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\DistributionRecommendation;
use App\Models\EnergySource;
use App\Models\ImpactReport;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Get dashboard summary statistics.
     *
     * GET /api/dashboard/summary
     */
    public function summary(): JsonResponse
    {
        $totalEnergySources = EnergySource::count();
        $activeEnergySources = EnergySource::where('status', 'active')->count();
        $totalCapacity = EnergySource::sum('capacity_kwh');
        $totalAvailable = EnergySource::sum('available_kwh');

        $totalBusinesses = Business::count();
        $activeBusinesses = Business::where('status', 'active')->count();
        $totalEnergyNeed = Business::where('status', 'active')->sum('monthly_energy_need');
        $totalEmployees = Business::where('status', 'active')->sum('employee_count');

        $totalRecommendations = DistributionRecommendation::count();
        $implementedRecommendations = DistributionRecommendation::where('status', 'implemented')->count();
        $approvedRecommendations = DistributionRecommendation::where('status', 'approved')->count();

        $totalCostSaving = ImpactReport::sum('cost_saving');
        $totalEmissionReduction = ImpactReport::sum('estimated_emission_reduction');
        $avgProductivityIncrease = ImpactReport::avg('productivity_increase_percentage') ?? 0;

        $usersByRole = User::select('role', DB::raw('count(*) as count'))
            ->groupBy('role')
            ->pluck('count', 'role');

        return response()->json([
            'success' => true,
            'data' => [
                'energy' => [
                    'total_sources' => $totalEnergySources,
                    'active_sources' => $activeEnergySources,
                    'total_capacity_kwh' => round((float) $totalCapacity, 2),
                    'total_available_kwh' => round((float) $totalAvailable, 2),
                    'utilization_percentage' => $totalCapacity > 0
                        ? round((($totalCapacity - $totalAvailable) / $totalCapacity) * 100, 2)
                        : 0,
                ],
                'businesses' => [
                    'total' => $totalBusinesses,
                    'active' => $activeBusinesses,
                    'total_energy_need_kwh' => round((float) $totalEnergyNeed, 2),
                    'total_employees' => $totalEmployees,
                ],
                'recommendations' => [
                    'total' => $totalRecommendations,
                    'approved' => $approvedRecommendations,
                    'implemented' => $implementedRecommendations,
                ],
                'impact' => [
                    'total_cost_saving' => round((float) $totalCostSaving, 2),
                    'total_emission_reduction_kg' => round((float) $totalEmissionReduction, 2),
                    'avg_productivity_increase' => round((float) $avgProductivityIncrease, 2),
                ],
                'users_by_role' => $usersByRole,
            ],
        ]);
    }

    /**
     * Get energy distribution chart data.
     *
     * GET /api/dashboard/energy-chart
     */
    public function energyChart(): JsonResponse
    {
        // Energy sources by type
        $byType = EnergySource::select('type', DB::raw('count(*) as count'), DB::raw('SUM(capacity_kwh) as total_capacity'), DB::raw('SUM(available_kwh) as total_available'))
            ->groupBy('type')
            ->get();

        // Energy sources by status
        $byStatus = EnergySource::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status');

        // Top energy sources by capacity
        $topSources = EnergySource::with('provider')
            ->orderByDesc('capacity_kwh')
            ->limit(5)
            ->get(['id', 'name', 'type', 'provider_id', 'capacity_kwh', 'available_kwh', 'status']);

        return response()->json([
            'success' => true,
            'data' => [
                'by_type' => $byType,
                'by_status' => $byStatus,
                'top_sources' => $topSources,
            ],
        ]);
    }

    /**
     * Get impact chart data.
     *
     * GET /api/dashboard/impact-chart
     */
    public function impactChart(): JsonResponse
    {
        // Impact by report period
        $byPeriod = ImpactReport::select(
                'report_period',
                DB::raw('SUM(cost_saving) as total_saving'),
                DB::raw('SUM(estimated_emission_reduction) as total_emission_reduction'),
                DB::raw('AVG(productivity_increase_percentage) as avg_productivity_increase'),
                DB::raw('COUNT(*) as report_count')
            )
            ->groupBy('report_period')
            ->orderBy('report_period')
            ->get();

        // Impact by business sector
        $bySector = ImpactReport::join('businesses', 'impact_reports.business_id', '=', 'businesses.id')
            ->select(
                'businesses.sector',
                DB::raw('SUM(impact_reports.cost_saving) as total_saving'),
                DB::raw('SUM(impact_reports.estimated_emission_reduction) as total_emission_reduction'),
                DB::raw('COUNT(*) as report_count')
            )
            ->groupBy('businesses.sector')
            ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'by_period' => $byPeriod,
                'by_sector' => $bySector,
            ],
        ]);
    }

    /**
     * Get priority map data (businesses and energy sources with coordinates).
     *
     * GET /api/dashboard/priority-map
     */
    public function priorityMap(): JsonResponse
    {
        // Businesses with their latest priority score
        $businesses = Business::with('latestPriorityScore')
            ->where('status', 'active')
            ->get(['id', 'name', 'sector', 'city', 'latitude', 'longitude', 'monthly_energy_need', 'employee_count', 'clean_energy_access']);

        // Active energy sources
        $energySources = EnergySource::where('status', 'active')
            ->get(['id', 'name', 'type', 'city', 'latitude', 'longitude', 'capacity_kwh', 'available_kwh']);

        // Recommendation connections (for drawing lines on the map)
        $connections = DistributionRecommendation::with(['business:id,name,latitude,longitude', 'energySource:id,name,latitude,longitude'])
            ->whereIn('status', ['recommended', 'approved', 'implemented'])
            ->get(['id', 'business_id', 'energy_source_id', 'distance_km', 'status']);

        return response()->json([
            'success' => true,
            'data' => [
                'businesses' => $businesses,
                'energy_sources' => $energySources,
                'connections' => $connections,
            ],
        ]);
    }
}
