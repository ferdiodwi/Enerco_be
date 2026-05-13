<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'business_id', 'energy_need_score', 'economic_impact_score', 'distance_score',
    'sustainability_score', 'emission_reduction_score', 'total_score',
    'priority_level', 'calculated_at',
])]
class PriorityScore extends Model
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
            'energy_need_score' => 'decimal:2',
            'economic_impact_score' => 'decimal:2',
            'distance_score' => 'decimal:2',
            'sustainability_score' => 'decimal:2',
            'emission_reduction_score' => 'decimal:2',
            'total_score' => 'decimal:2',
            'calculated_at' => 'datetime',
        ];
    }

    /**
     * Get the business that this priority score belongs to.
     */
    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }

    /**
     * Get the distribution recommendations based on this score.
     */
    public function distributionRecommendations(): HasMany
    {
        return $this->hasMany(DistributionRecommendation::class);
    }
}
