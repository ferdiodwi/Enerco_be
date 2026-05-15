<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImpactReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'distribution_id',
        'period',
        'old_energy_cost',
        'new_energy_cost',
        'cost_saving',
        'cost_saving_percentage',
        'clean_energy_used_kwh',
        'estimated_emission_reduction',
        'productivity_before',
        'productivity_after',
        'productivity_increase_percentage',
    ];

    protected function casts(): array
    {
        return [
            'old_energy_cost' => 'decimal:2',
            'new_energy_cost' => 'decimal:2',
            'cost_saving' => 'decimal:2',
            'cost_saving_percentage' => 'decimal:2',
            'clean_energy_used_kwh' => 'decimal:2',
            'estimated_emission_reduction' => 'decimal:2',
            'productivity_before' => 'decimal:2',
            'productivity_after' => 'decimal:2',
            'productivity_increase_percentage' => 'decimal:2',
        ];
    }

    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }

    public function distribution(): BelongsTo
    {
        return $this->belongsTo(Distribution::class);
    }
}
