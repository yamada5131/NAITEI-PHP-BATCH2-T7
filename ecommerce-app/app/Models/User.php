<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    public $incrementing = false;

    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'string',
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function shoppingCarts(): HasMany
    {
        return $this->hasMany(ShoppingCart::class);
    }

    public function userAddresses(): HasMany
    {
        return $this->hasMany(UserAddress::class);
    }

    /*Payment where???
    public function userPayments(): HasMany
    {
        return $this->hasMany(UserPayment::class);
    }
    */

    public function userReview(): HasMany
    {
        return $this->hasMany(UserReview::class);
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->attributes['first_name'] . ' ' . $this->attributes['last_name'],
        );
    }

    protected function username(): Attribute
    {
        return Attribute::make(
            set: fn($value) => Str::slug($value),
        );
    }

    public static function booted(): void
    {
        static::creating(function (User $user) {
            $user->id = Str::uuid();
        });
    }
}


