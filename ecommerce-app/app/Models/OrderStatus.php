<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class OrderStatus extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';

    public static function booted(): void
    {
        static::creating(function (OrderStatus $orderStatus) {
            $orderStatus->id = Str::uuid();
        });
    }

    public function orderDetail(): HasOne
    {  
        return $this->hasOne(OrderDetail::class);
    }
}
