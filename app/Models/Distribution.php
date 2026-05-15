<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Distribution extends Model
{
    use HasFactory;

    protected $fillable = [
        'recommendation_id',
        'business_id',
        'energy_source_id',
        'allocated_energy_kwh',
        'start_date',
        'end_date',
        'status',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'allocated_energy_kwh' => 'decimal:2',
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }

    public function recommendation(): BelongsTo
    {
        return $this->belongsTo(Recommendation::class);
    }

    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }

    public function energySource(): BelongsTo
    {
        return $this->belongsTo(EnergySource::class);
    }

    public function impactReports(): HasMany
    {
        return $this->hasMany(ImpactReport::class);
    }
}
