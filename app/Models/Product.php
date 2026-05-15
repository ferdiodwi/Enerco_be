<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'name',
        'description',
        'category',
        'price',
        'stock',
        'image',
        'is_clean_energy_powered',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'is_clean_energy_powered' => 'boolean',
        ];
    }

    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }
}
