<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Address extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';

    public static function booted(): void
    {
        static::creating(function (Address $address) {
            $address->id = Str::uuid();
        });
    }

    public function country(): HasOne
    {
        return $this->hasOne(Country::class);
    }
}
