<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'business_id', 'distribution_recommendation_id',
    'old_energy_cost', 'new_energy_cost', 'cost_saving',
    'productivity_increase_percentage', 'estimated_emission_reduction',
    'report_period', 'notes',
])]
class ImpactReport extends Model
{
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'old_energy_cost' => 'decimal:2',
            'new_energy_cost' => 'decimal:2',
            'cost_saving' => 'decimal:2',
            'productivity_increase_percentage' => 'decimal:2',
            'estimated_emission_reduction' => 'decimal:2',
        ];
    }

    /**
     * Get the business for this impact report.
     */
    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }

    /**
     * Get the distribution recommendation for this impact report.
     */
    public function distributionRecommendation(): BelongsTo
    {
        return $this->belongsTo(DistributionRecommendation::class);
    }
}
