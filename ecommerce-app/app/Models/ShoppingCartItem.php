<?php

namespace App\Models;

use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShoppingCartItem extends Model
{
    use HasFactory;

    protected $fillable = ['*'];

    public $incrementing = false;

    protected $keyType = 'string';

    public function cart(): BelongsTo
    {
        return $this->belongsTo(ShoppingCart::class, 'shopping_cart_id');
    }

    public function product(): Product
    {
        return $this->belongsTo(Product::class, 'product_id')->first();
    }

    public static function booted(): void
    {
        static::creating(function (ShoppingCartItem $shoppingCartItem) {
            $shoppingCartItem->id = Str::uuid();
        });
    }
}


