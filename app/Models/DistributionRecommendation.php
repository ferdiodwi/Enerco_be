<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable([
    'business_id', 'energy_source_id', 'priority_score_id',
    'recommended_energy_kwh', 'distance_km', 'recommendation_reason',
    'ai_summary', 'status',
])]
class DistributionRecommendation extends Model
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
            'recommended_energy_kwh' => 'decimal:2',
            'distance_km' => 'decimal:2',
        ];
    }

    /**
     * Get the business for this recommendation.
     */
    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }

    /**
     * Get the energy source for this recommendation.
     */
    public function energySource(): BelongsTo
    {
        return $this->belongsTo(EnergySource::class);
    }

    /**
     * Get the priority score for this recommendation.
     */
    public function priorityScore(): BelongsTo
    {
        return $this->belongsTo(PriorityScore::class);
    }

    /**
     * Get the impact report for this recommendation.
     */
    public function impactReport(): HasOne
    {
        return $this->hasOne(ImpactReport::class);
    }
}
