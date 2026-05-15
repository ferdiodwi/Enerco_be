<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Recommendation extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'energy_source_id',
        'priority_score_id',
        'recommended_energy_kwh',
        'distance_km',
        'estimated_cost_saving',
        'estimated_emission_reduction',
        'ai_summary',
        'ai_reasoning',
        'action_plan',
        'confidence_score',
        'status',
        'generated_by',
    ];

    protected function casts(): array
    {
        return [
            'recommended_energy_kwh' => 'decimal:2',
            'distance_km' => 'decimal:2',
            'estimated_cost_saving' => 'decimal:2',
            'estimated_emission_reduction' => 'decimal:2',
            'confidence_score' => 'decimal:2',
        ];
    }

    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }

    public function energySource(): BelongsTo
    {
        return $this->belongsTo(EnergySource::class);
    }

    public function priorityScore(): BelongsTo
    {
        return $this->belongsTo(PriorityScore::class);
    }

    public function generatedByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'generated_by');
    }

    public function distributions(): HasMany
    {
        return $this->hasMany(Distribution::class);
    }
}
