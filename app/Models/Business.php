<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'region_id',
        'name',
        'sector',
        'description',
        'address',
        'latitude',
        'longitude',
        'employee_count',
        'production_capacity',
        'monthly_energy_need',
        'current_energy_cost',
        'clean_energy_access',
        'photo',
        'verification_status',
    ];

    protected function casts(): array
    {
        return [
            'latitude' => 'decimal:8',
            'longitude' => 'decimal:8',
            'production_capacity' => 'decimal:2',
            'monthly_energy_need' => 'decimal:2',
            'current_energy_cost' => 'decimal:2',
            'clean_energy_access' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function energyNeeds(): HasMany
    {
        return $this->hasMany(EnergyNeed::class);
    }

    public function priorityScores(): HasMany
    {
        return $this->hasMany(PriorityScore::class);
    }

    public function recommendations(): HasMany
    {
        return $this->hasMany(Recommendation::class);
    }

    public function distributions(): HasMany
    {
        return $this->hasMany(Distribution::class);
    }

    public function impactReports(): HasMany
    {
        return $this->hasMany(ImpactReport::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function latestPriorityScore()
    {
        return $this->hasOne(PriorityScore::class)->latestOfMany();
    }
}
