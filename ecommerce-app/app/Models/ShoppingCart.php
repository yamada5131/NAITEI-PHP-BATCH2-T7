<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class ShoppingCart extends Model
{
    use HasFactory;

    protected $fillable = ['*'];

    protected function casts(): array
    {
        return [
            'id' => 'string',
        ];
    }

    public function shoppingCartItems(): HasMany
    {
        return $this->hasMany(ShoppingCartItem::class, 'shopping_cart_id');
    }

    public $incrementing = false;

    protected $keyType = 'string';

    public static function booted(): void
    {
        static::creating(function (ShoppingCart $shoppingCart) {
            $shoppingCart->id = Str::uuid();
        });
    }
}
