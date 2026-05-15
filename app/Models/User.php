<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasApiTokens, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function business(): HasOne
    {
        return $this->hasOne(Business::class);
    }

    public function energySources(): HasMany
    {
        return $this->hasMany(EnergySource::class);
    }

    public function sentPartnershipRequests(): HasMany
    {
        return $this->hasMany(PartnershipRequest::class, 'sender_id');
    }

    public function receivedPartnershipRequests(): HasMany
    {
        return $this->hasMany(PartnershipRequest::class, 'receiver_id');
    }
}
