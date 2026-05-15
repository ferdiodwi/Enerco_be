<?php

namespace App\Services;

use App\Models\Business;
use App\Models\EnergySource;
use App\Models\PriorityScore;

class PriorityScoringService
{
    /**
     * Calculate priority score for a business.
     * Formula from SRS section 12.5:
     *
     * priority_score =
     *   (energy_need_score * 0.25) +
     *   (economic_impact_score * 0.20) +
     *   (worker_score * 0.15) +
     *   (distance_score * 0.15) +
     *   (emission_reduction_score * 0.15) +
     *   (clean_energy_access_score * 0.10)
     */
    public function calculate(Business $business): PriorityScore
    {
        $nearestSource = $this->findNearestEnergySource($business);
        $distanceKm = $nearestSource
            ? $this->haversineDistance(
                $business->latitude,
                $business->longitude,
                $nearestSource->latitude,
                $nearestSource->longitude
            )
            : 999;

        $energyNeedScore = $this->calculateEnergyNeedScore($business->monthly_energy_need);
        $economicImpactScore = $this->calculateEconomicImpactScore($business);
        $workerScore = $this->calculateWorkerScore($business->employee_count);
        $distanceScore = $this->calculateDistanceScore($distanceKm);
        $emissionReductionScore = $this->calculateEmissionReductionScore($business);
        $cleanEnergyAccessScore = $this->calculateCleanEnergyAccessScore($business->clean_energy_access);

        $totalScore = ($energyNeedScore * 0.25)
            + ($economicImpactScore * 0.20)
            + ($workerScore * 0.15)
            + ($distanceScore * 0.15)
            + ($emissionReductionScore * 0.15)
            + ($cleanEnergyAccessScore * 0.10);

        $totalScore = round($totalScore, 2);
        $category = $this->categorize($totalScore);

        return PriorityScore::create([
            'business_id' => $business->id,
            'score' => $totalScore,
            'category' => $category,
            'energy_need_score' => $energyNeedScore,
            'economic_impact_score' => $economicImpactScore,
            'worker_score' => $workerScore,
            'distance_score' => $distanceScore,
            'emission_reduction_score' => $emissionReductionScore,
            'clean_energy_access_score' => $cleanEnergyAccessScore,
            'calculation_notes' => "Nearest source: " . ($nearestSource?->name ?? 'N/A') . " ({$distanceKm} km)",
            'calculated_at' => now(),
        ]);
    }

    /**
     * SRS section 12.2 - Energy Need Score
     */
    protected function calculateEnergyNeedScore(float $monthlyNeedKwh): float
    {
        return match (true) {
            $monthlyNeedKwh > 1000 => 100,
            $monthlyNeedKwh >= 700 => 80,
            $monthlyNeedKwh >= 400 => 60,
            $monthlyNeedKwh >= 100 => 40,
            default => 20,
        };
    }

    /**
     * Economic impact based on energy cost & production capacity.
     */
    protected function calculateEconomicImpactScore(Business $business): float
    {
        $costRatio = $business->current_energy_cost > 0
            ? min($business->current_energy_cost / 5000000, 1) * 100
            : 20;

        return round($costRatio, 2);
    }

    /**
     * Worker score based on employee count.
     */
    protected function calculateWorkerScore(int $employeeCount): float
    {
        return match (true) {
            $employeeCount >= 50 => 100,
            $employeeCount >= 20 => 80,
            $employeeCount >= 10 => 60,
            $employeeCount >= 5 => 40,
            default => 20,
        };
    }

    /**
     * SRS section 12.3 - Distance Score
     */
    protected function calculateDistanceScore(float $distanceKm): float
    {
        return match (true) {
            $distanceKm <= 5 => 100,
            $distanceKm <= 10 => 80,
            $distanceKm <= 20 => 60,
            $distanceKm <= 40 => 40,
            default => 20,
        };
    }

    /**
     * Emission reduction estimate based on energy usage.
     */
    protected function calculateEmissionReductionScore(Business $business): float
    {
        // Higher energy needs = higher potential reduction
        $potentialReduction = $business->monthly_energy_need * 0.5; // kg CO2
        return match (true) {
            $potentialReduction > 500 => 100,
            $potentialReduction > 350 => 80,
            $potentialReduction > 200 => 60,
            $potentialReduction > 50 => 40,
            default => 20,
        };
    }

    /**
     * SRS section 12.4 - Clean Energy Access Score
     */
    protected function calculateCleanEnergyAccessScore(bool $hasAccess): float
    {
        return $hasAccess ? 30 : 100;
    }

    /**
     * SRS section 5.7 FR-SCORE-002 - Categorize score
     */
    protected function categorize(float $score): string
    {
        return match (true) {
            $score >= 80 => 'Sangat Prioritas',
            $score >= 60 => 'Prioritas',
            $score >= 40 => 'Menengah',
            default => 'Rendah',
        };
    }

    /**
     * SRS section 12.1 - Haversine distance calculation
     */
    public function haversineDistance(float $lat1, float $lon1, float $lat2, float $lon2): float
    {
        $earthRadius = 6371; // km

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2)
            + cos(deg2rad($lat1)) * cos(deg2rad($lat2))
            * sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return round($earthRadius * $c, 2);
    }

    /**
     * Find nearest energy source to a business.
     */
    protected function findNearestEnergySource(Business $business): ?EnergySource
    {
        $sources = EnergySource::where('status', 'active')->get();

        $nearest = null;
        $minDistance = PHP_FLOAT_MAX;

        foreach ($sources as $source) {
            $distance = $this->haversineDistance(
                $business->latitude,
                $business->longitude,
                $source->latitude,
                $source->longitude
            );

            if ($distance < $minDistance) {
                $minDistance = $distance;
                $nearest = $source;
            }
        }

        return $nearest;
    }
}
