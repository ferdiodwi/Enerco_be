<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EnergySource extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'region_id',
        'name',
        'type',
        'description',
        'address',
        'latitude',
        'longitude',
        'total_capacity_kwh',
        'available_capacity_kwh',
        'status',
        'photo',
    ];

    protected function casts(): array
    {
        return [
            'latitude' => 'decimal:8',
            'longitude' => 'decimal:8',
            'total_capacity_kwh' => 'decimal:2',
            'available_capacity_kwh' => 'decimal:2',
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

    public function recommendations(): HasMany
    {
        return $this->hasMany(Recommendation::class);
    }

    public function distributions(): HasMany
    {
        return $this->hasMany(Distribution::class);
    }
}
