<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EnergyNeed extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'period',
        'monthly_need_kwh',
        'operating_hours_per_day',
        'main_equipment',
        'current_energy_cost',
        'energy_problem',
        'validation_status',
    ];

    protected function casts(): array
    {
        return [
            'monthly_need_kwh' => 'decimal:2',
            'current_energy_cost' => 'decimal:2',
        ];
    }

    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }
}
