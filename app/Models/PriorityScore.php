<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PriorityScore extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'score',
        'category',
        'energy_need_score',
        'economic_impact_score',
        'worker_score',
        'distance_score',
        'emission_reduction_score',
        'clean_energy_access_score',
        'calculation_notes',
        'calculated_at',
    ];

    protected function casts(): array
    {
        return [
            'score' => 'decimal:2',
            'energy_need_score' => 'decimal:2',
            'economic_impact_score' => 'decimal:2',
            'worker_score' => 'decimal:2',
            'distance_score' => 'decimal:2',
            'emission_reduction_score' => 'decimal:2',
            'clean_energy_access_score' => 'decimal:2',
            'calculated_at' => 'datetime',
        ];
    }

    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }

    public function recommendations(): HasMany
    {
        return $this->hasMany(Recommendation::class);
    }
}
