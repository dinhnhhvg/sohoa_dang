<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Payment extends BaseModel
{
    protected $guarded = [];

    protected $casts = [
        'expiry_date' => 'date',
        'payment_time' => 'datetime',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function sale(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sale_id', 'users');
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function itemNotes(): MorphMany
    {
        return $this->morphMany(ItemNote::class, 'item')
            ->with(['createdBy', 'status', 'channel']);
    }

    public static function booted(): void
    {
        static::deleting(function ($payment) {
            $payment->itemNotes()->delete();
        });
    }
}
