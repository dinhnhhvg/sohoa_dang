<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Order extends BaseModel
{
    protected $guarded = [];

    protected $appends = ['final_amount'];

    public function getFinalAmountAttribute(): int
    {
        return $this->total_amount - $this->discount_amount - $this->coupon_amount;
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function itemNotes(): MorphMany
    {
        return $this->morphMany(ItemNote::class, 'item')
            ->with(['createdBy', 'status', 'channel']);
    }

    public static function booted(): void
    {
        static::deleting(function ($order) {
            $order->itemNotes()->delete();
        });
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function paymentAmount(): ?int
    {
        return $this->payments()->sum('amount');
    }
}
