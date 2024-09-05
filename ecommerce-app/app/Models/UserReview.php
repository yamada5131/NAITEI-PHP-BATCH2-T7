<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class UserReview extends Model
{
    use HasFactory;

    protected $table = "user_reviews";

    protected $fillable = [
        'id',
        'rating',
        'comment',
        'user_id',
        'order_item_id',
    ];

    protected $casts = [
        'id' => 'string',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orderItem(): BelongsTo
    {
        return $this->belongsTo(OrderItem::class, 'order_item_id');
    }

    public $incrementing = false;

    protected $keyType = 'string';

    public static function booted(): void
    {
        static::creating(function (UserReview $userReview) {
            $userReview->id = Str::uuid();
        });
    }
}



