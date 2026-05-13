<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

#[Fillable(['name', 'email', 'password', 'role', 'phone', 'status'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the business owned by this user (business_owner role).
     */
    public function business(): HasOne
    {
        return $this->hasOne(Business::class);
    }

    /**
     * Get the energy sources provided by this user (energy_provider role).
     */
    public function energySources(): HasMany
    {
        return $this->hasMany(EnergySource::class, 'provider_id');
    }

    /**
     * Get partnership requests sent by this user.
     */
    public function sentPartnershipRequests(): HasMany
    {
        return $this->hasMany(PartnershipRequest::class, 'sender_id');
    }

    /**
     * Get partnership requests received by this user.
     */
    public function receivedPartnershipRequests(): HasMany
    {
        return $this->hasMany(PartnershipRequest::class, 'receiver_id');
    }

    /**
     * Get activity logs for this user.
     */
    public function activityLogs(): HasMany
    {
        return $this->hasMany(ActivityLog::class);
    }

    /**
     * Check if the user has a specific role.
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    /**
     * Check if the user is an admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
