<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'provider_id', 'name', 'type', 'description', 'address', 'city', 'province',
    'latitude', 'longitude', 'capacity_kwh', 'available_kwh', 'cost_per_kwh', 'status',
])]
class EnergySource extends Model
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
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
            'capacity_kwh' => 'decimal:2',
            'available_kwh' => 'decimal:2',
            'cost_per_kwh' => 'decimal:2',
        ];
    }

    /**
     * Get the provider (user) that owns this energy source.
     */
    public function provider(): BelongsTo
    {
        return $this->belongsTo(User::class, 'provider_id');
    }

    /**
     * Get the distribution recommendations for this energy source.
     */
    public function distributionRecommendations(): HasMany
    {
        return $this->hasMany(DistributionRecommendation::class);
    }
}
