<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ViewedProduct extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';
    protected $fillable = ['user_id', 'product_id', 'viewed_at'];

    public static function booted(): void
    {
        static::creating(function (ViewedProduct $viewedProduct) {
            $viewedProduct->id = Str::uuid();
        });
    }
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
