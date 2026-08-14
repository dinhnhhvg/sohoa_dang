<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Contact extends BaseModel
{
    protected $fillable = [
        'title',
        'content',
        'status_id',
        'note',
        'schedule_at',
        'customer_id'
    ];

    protected $casts = [
        'schedule_at' => 'datetime'
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function itemNotes(): MorphMany
    {
        return $this->morphMany(ItemNote::class, 'item')
            ->with(['createdBy', 'status', 'channel']);
    }

    public static function booted(): void
    {
        static::deleting(function ($contact) {
            $contact->itemNotes()->delete();
        });
    }
}
