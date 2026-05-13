<?php

namespace App\Services;

use App\Models\Business;
use App\Models\EnergySource;
use App\Models\PriorityScore;

class ScoringService
{
    /**
     * Weight configuration for priority scoring.
     * Based on planning document section 8.1.
     */
    private const WEIGHTS = [
        'energy_need' => 0.30,
        'economic_impact' => 0.25,
        'distance' => 0.15,
        'sustainability' => 0.15,
        'emission_reduction' => 0.15,
    ];

    /**
     * Priority level thresholds.
     * Based on planning document section 8.3.
     */
    private const PRIORITY_LEVELS = [
        [0, 40, 'low'],
        [41, 60, 'medium'],
        [61, 80, 'high'],
        [81, 100, 'urgent'],
    ];

    /**
     * Calculate priority score for a single business.
     */
    public function calculateForBusiness(Business $business, ?EnergySource $nearestSource = null): PriorityScore
    {
        if (!$nearestSource) {
            $nearestSource = $this->findNearestEnergySource($business);
        }

        $energyNeedScore = $this->calculateEnergyNeedScore($business);
        $economicImpactScore = $this->calculateEconomicImpactScore($business);
        $distanceScore = $nearestSource
            ? $this->calculateDistanceScore($business, $nearestSource)
            : 0;
        $sustainabilityScore = $this->calculateSustainabilityScore($business);
        $emissionReductionScore = $this->calculateEmissionReductionScore($business);

        $totalScore = ($energyNeedScore * self::WEIGHTS['energy_need'])
            + ($economicImpactScore * self::WEIGHTS['economic_impact'])
            + ($distanceScore * self::WEIGHTS['distance'])
            + ($sustainabilityScore * self::WEIGHTS['sustainability'])
            + ($emissionReductionScore * self::WEIGHTS['emission_reduction']);

        $totalScore = round(min(100, max(0, $totalScore)), 2);
        $priorityLevel = $this->determinePriorityLevel($totalScore);

        return PriorityScore::create([
            'business_id' => $business->id,
            'energy_need_score' => round($energyNeedScore, 2),
            'economic_impact_score' => round($economicImpactScore, 2),
            'distance_score' => round($distanceScore, 2),
            'sustainability_score' => round($sustainabilityScore, 2),
            'emission_reduction_score' => round($emissionReductionScore, 2),
            'total_score' => $totalScore,
            'priority_level' => $priorityLevel,
            'calculated_at' => now(),
        ]);
    }

    /**
     * Calculate priority scores for all active businesses.
     *
     * @return array<PriorityScore>
     */
    public function calculateForAllBusinesses(): array
    {
        $businesses = Business::where('status', 'active')->get();
        $scores = [];

        foreach ($businesses as $business) {
            $scores[] = $this->calculateForBusiness($business);
        }

        return $scores;
    }

    /**
     * Energy need score: higher energy need = higher score.
     * Scale: 0 - 100
     */
    private function calculateEnergyNeedScore(Business $business): float
    {
        $need = (float) $business->monthly_energy_need;

        // Normalize: 0-500 kWh = low, 500-1000 = medium, 1000-2000 = high, 2000+ = very high
        if ($need >= 2000) return 100;
        if ($need >= 1000) return 60 + (($need - 1000) / 1000) * 40;
        if ($need >= 500) return 30 + (($need - 500) / 500) * 30;
        return ($need / 500) * 30;
    }

    /**
     * Economic impact score: employee count, production capacity, sector.
     * Scale: 0 - 100
     */
    private function calculateEconomicImpactScore(Business $business): float
    {
        $score = 0;

        // Employee count contribution (max 40 points)
        $employees = $business->employee_count;
        if ($employees >= 50) $score += 40;
        elseif ($employees >= 20) $score += 25 + (($employees - 20) / 30) * 15;
        elseif ($employees >= 10) $score += 15 + (($employees - 10) / 10) * 10;
        else $score += ($employees / 10) * 15;

        // Production capacity contribution (max 30 points)
        $capacity = (float) ($business->production_capacity ?? 0);
        if ($capacity >= 1000) $score += 30;
        elseif ($capacity >= 500) $score += 20 + (($capacity - 500) / 500) * 10;
        elseif ($capacity >= 100) $score += 10 + (($capacity - 100) / 400) * 10;
        else $score += ($capacity / 100) * 10;

        // Sector priority contribution (max 30 points)
        $sectorScores = [
            'food_processing' => 28,
            'fisheries' => 25,
            'agriculture' => 27,
            'textile' => 20,
            'craft' => 18,
            'manufacturing' => 22,
            'services' => 15,
        ];
        $score += $sectorScores[$business->sector] ?? 15;

        return min(100, $score);
    }

    /**
     * Distance score: closer to energy source = higher score.
     * Scale: 0 - 100
     */
    private function calculateDistanceScore(Business $business, EnergySource $energySource): float
    {
        $distance = $this->calculateDistance(
            (float) $business->latitude,
            (float) $business->longitude,
            (float) $energySource->latitude,
            (float) $energySource->longitude,
        );

        // Closer = higher score. Max distance considered = 100 km
        if ($distance <= 1) return 100;
        if ($distance <= 5) return 80 + ((5 - $distance) / 4) * 20;
        if ($distance <= 20) return 50 + ((20 - $distance) / 15) * 30;
        if ($distance <= 50) return 20 + ((50 - $distance) / 30) * 30;
        if ($distance <= 100) return ($distance > 100) ? 0 : ((100 - $distance) / 50) * 20;

        return 0;
    }

    /**
     * Sustainability score: based on business potential for local economy.
     * Scale: 0 - 100
     */
    private function calculateSustainabilityScore(Business $business): float
    {
        $score = 0;

        // Not having clean energy access = higher priority
        if (!$business->clean_energy_access) {
            $score += 40;
        }

        // Higher current energy cost = more savings potential
        $cost = (float) $business->current_energy_cost;
        if ($cost >= 5000000) $score += 35;
        elseif ($cost >= 3000000) $score += 25;
        elseif ($cost >= 1000000) $score += 15;
        else $score += 5;

        // More employees = more local economic impact
        $employees = $business->employee_count;
        if ($employees >= 20) $score += 25;
        elseif ($employees >= 10) $score += 18;
        elseif ($employees >= 5) $score += 10;
        else $score += 5;

        return min(100, $score);
    }

    /**
     * Emission reduction score: estimated reduction after switching to clean energy.
     * Scale: 0 - 100
     */
    private function calculateEmissionReductionScore(Business $business): float
    {
        // Estimate based on monthly energy need and current cost
        // Higher energy usage = more emission reduction potential
        $energyNeed = (float) $business->monthly_energy_need;
        $currentCost = (float) $business->current_energy_cost;

        // Simple estimation: assume 0.7 kg CO2 per kWh from fossil fuel
        $estimatedEmission = $energyNeed * 0.7;

        // Score based on potential emission reduction
        if ($estimatedEmission >= 1000) return 100;
        if ($estimatedEmission >= 500) return 60 + (($estimatedEmission - 500) / 500) * 40;
        if ($estimatedEmission >= 200) return 30 + (($estimatedEmission - 200) / 300) * 30;

        return ($estimatedEmission / 200) * 30;
    }

    /**
     * Find the nearest active energy source to a business.
     */
    public function findNearestEnergySource(Business $business): ?EnergySource
    {
        $energySources = EnergySource::where('status', 'active')
            ->where('available_kwh', '>', 0)
            ->get();

        $nearest = null;
        $minDistance = PHP_FLOAT_MAX;

        foreach ($energySources as $source) {
            $distance = $this->calculateDistance(
                (float) $business->latitude,
                (float) $business->longitude,
                (float) $source->latitude,
                (float) $source->longitude,
            );

            if ($distance < $minDistance) {
                $minDistance = $distance;
                $nearest = $source;
            }
        }

        return $nearest;
    }

    /**
     * Calculate distance between two GPS coordinates using Haversine formula.
     *
     * @return float Distance in kilometers
     */
    public function calculateDistance(float $lat1, float $lon1, float $lat2, float $lon2): float
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
     * Determine priority level based on total score.
     */
    private function determinePriorityLevel(float $score): string
    {
        foreach (self::PRIORITY_LEVELS as [$min, $max, $level]) {
            if ($score >= $min && $score <= $max) {
                return $level;
            }
        }

        return 'low';
    }
}
