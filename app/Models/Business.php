<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'user_id', 'name', 'sector', 'description', 'address', 'city', 'province',
    'latitude', 'longitude', 'monthly_energy_need', 'current_energy_cost',
    'production_capacity', 'employee_count', 'clean_energy_access', 'status',
])]
class Business extends Model
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
            'monthly_energy_need' => 'decimal:2',
            'current_energy_cost' => 'decimal:2',
            'production_capacity' => 'decimal:2',
            'clean_energy_access' => 'boolean',
        ];
    }

    /**
     * Get the user that owns this business.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the priority scores for this business.
     */
    public function priorityScores(): HasMany
    {
        return $this->hasMany(PriorityScore::class);
    }

    /**
     * Get the latest priority score.
     */
    public function latestPriorityScore()
    {
        return $this->hasOne(PriorityScore::class)->latestOfMany();
    }

    /**
     * Get the distribution recommendations for this business.
     */
    public function distributionRecommendations(): HasMany
    {
        return $this->hasMany(DistributionRecommendation::class);
    }

    /**
     * Get the impact reports for this business.
     */
    public function impactReports(): HasMany
    {
        return $this->hasMany(ImpactReport::class);
    }

    /**
     * Get the products for this business.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get the partnership requests for this business.
     */
    public function partnershipRequests(): HasMany
    {
        return $this->hasMany(PartnershipRequest::class);
    }
}
