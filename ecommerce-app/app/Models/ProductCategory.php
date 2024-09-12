<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class ProductCategory extends Model
{
    use HasFactory;

    protected $table = 'product_categories';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'description',
        'created_at',
        'modified_at',
        'deleted_at',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public static function booted(): void
    {
        static::creating(function (ProductCategory $productCategory) {
            $productCategory->id = Str::uuid();
        });
    }
}
