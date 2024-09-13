<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $guarded = [];

    protected $keyType = 'string';

    public static function booted(): void
    {
        static::creating(function (Product $product) {
            $product->id = Str::uuid();
        });
    }

    public function categories(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function carts(): BelongsToMany
    {
        return $this->belongsToMany(ShoppingCart::class, 'shopping_cart_items', 'product_id', 'shopping_cart_id');
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function userReviews(): HasManyThrough
    {
        return $this->hasManyThrough(UserReview::class, OrderItem::class);
    }

    public function rating(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->attributes['user_reviews_avg_rating'] ?
                number_format($this->attributes['user_reviews_avg_rating'], 1) : 0,
        );
    }

    public function trendRating(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                $avgRating = $this->attributes['user_reviews_avg_rating'] ? $this->attributes['user_reviews_avg_rating'] : 0;
                $count = $this->attributes['user_reviews_count'];

                return (2.4 * 2 + $avgRating * $count) / (2 + $count);
            }
        );
    }
}
