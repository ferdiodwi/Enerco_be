<?php

namespace App\Services;

use App\Models\Business;
use App\Models\DistributionRecommendation;
use App\Models\EnergySource;
use App\Models\PriorityScore;

class RecommendationService
{
    public function __construct(
        private ScoringService $scoringService,
    ) {}

    /**
     * Generate distribution recommendations for all active businesses.
     *
     * @return array<DistributionRecommendation>
     */
    public function generateRecommendations(): array
    {
        $businesses = Business::where('status', 'active')->get();
        $recommendations = [];

        foreach ($businesses as $business) {
            $recommendation = $this->generateForBusiness($business);
            if ($recommendation) {
                $recommendations[] = $recommendation;
            }
        }

        return $recommendations;
    }

    /**
     * Generate a distribution recommendation for a specific business.
     */
    public function generateForBusiness(Business $business): ?DistributionRecommendation
    {
        // Find the nearest energy source with available capacity
        $nearestSource = $this->scoringService->findNearestEnergySource($business);

        if (!$nearestSource) {
            return null;
        }

        // Calculate priority score
        $priorityScore = $this->scoringService->calculateForBusiness($business, $nearestSource);

        // Calculate distance
        $distance = $this->scoringService->calculateDistance(
            (float) $business->latitude,
            (float) $business->longitude,
            (float) $nearestSource->latitude,
            (float) $nearestSource->longitude,
        );

        // Determine recommended energy allocation
        $recommendedKwh = min(
            (float) $business->monthly_energy_need,
            (float) $nearestSource->available_kwh
        );

        // Generate recommendation reason
        $reason = $this->generateRecommendationReason($business, $nearestSource, $priorityScore, $distance);

        // Generate AI-style summary
        $aiSummary = $this->generateAiSummary($business, $nearestSource, $priorityScore, $distance, $recommendedKwh);

        return DistributionRecommendation::create([
            'business_id' => $business->id,
            'energy_source_id' => $nearestSource->id,
            'priority_score_id' => $priorityScore->id,
            'recommended_energy_kwh' => $recommendedKwh,
            'distance_km' => $distance,
            'recommendation_reason' => $reason,
            'ai_summary' => $aiSummary,
            'status' => 'recommended',
        ]);
    }

    /**
     * Generate recommendation reason based on scoring data.
     */
    private function generateRecommendationReason(
        Business $business,
        EnergySource $energySource,
        PriorityScore $priorityScore,
        float $distance
    ): string {
        $reasons = [];

        if ((float) $priorityScore->energy_need_score >= 60) {
            $reasons[] = "Kebutuhan energi tinggi ({$business->monthly_energy_need} kWh/bulan)";
        }

        if ((float) $priorityScore->economic_impact_score >= 50) {
            $reasons[] = "Dampak ekonomi signifikan ({$business->employee_count} pekerja)";
        }

        if ($distance <= 10) {
            $reasons[] = "Lokasi dekat dengan sumber energi ({$distance} km)";
        }

        if (!$business->clean_energy_access) {
            $reasons[] = "Belum memiliki akses energi bersih";
        }

        if ((float) $business->current_energy_cost >= 3000000) {
            $costFormatted = number_format((float) $business->current_energy_cost, 0, ',', '.');
            $reasons[] = "Biaya energi saat ini tinggi (Rp {$costFormatted}/bulan)";
        }

        return implode('. ', $reasons) . '.';
    }

    /**
     * Generate an AI-style summary narrative.
     * This acts as a fallback when external AI API is not available.
     */
    private function generateAiSummary(
        Business $business,
        EnergySource $energySource,
        PriorityScore $priorityScore,
        float $distance,
        float $recommendedKwh
    ): string {
        $energyTypeLabels = [
            'solar' => 'surya',
            'wind' => 'angin',
            'hydro' => 'mikrohidro',
            'biomass' => 'biomassa',
            'hybrid' => 'hybrid',
        ];

        $energyTypeLabel = $energyTypeLabels[$energySource->type] ?? $energySource->type;
        $currentCostFormatted = number_format((float) $business->current_energy_cost, 0, ',', '.');

        // Estimate savings
        $estimatedSavingPercent = min(40, max(10, round(((float) $business->current_energy_cost - ($recommendedKwh * (float) $energySource->cost_per_kwh)) / (float) $business->current_energy_cost * 100)));
        $estimatedProductivityIncrease = min(25, max(5, round($estimatedSavingPercent * 0.6)));

        $priorityLabel = match ($priorityScore->priority_level) {
            'urgent' => 'sangat mendesak',
            'high' => 'tinggi',
            'medium' => 'menengah',
            'low' => 'rendah',
        };

        return "{$business->name} direkomendasikan menjadi prioritas {$priorityLabel} untuk distribusi energi bersih "
            . "karena memiliki kebutuhan energi {$business->monthly_energy_need} kWh/bulan, "
            . "biaya operasional energi Rp {$currentCostFormatted}/bulan, "
            . "serta mempekerjakan {$business->employee_count} orang. "
            . "Sumber energi {$energyTypeLabel} terdekat ({$energySource->name}) berjarak {$distance} km "
            . "dengan kapasitas tersedia {$energySource->available_kwh} kWh. "
            . "Distribusi energi bersih sebesar {$recommendedKwh} kWh diperkirakan dapat "
            . "menurunkan biaya energi sebesar {$estimatedSavingPercent}% "
            . "dan meningkatkan kapasitas produksi sebesar {$estimatedProductivityIncrease}%.";
    }
}
