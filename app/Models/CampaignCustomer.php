<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class CampaignCustomer extends BaseModel
{
    protected $guarded = [];

    protected $casts = [
        'schedule_at' => 'datetime'
    ];

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function sale(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sale_id', 'id');
    }

    public function itemNotes(): MorphMany
    {
        return $this->morphMany(ItemNote::class, 'item')
            ->with(['createdBy', 'status', 'channel']);
    }

    public static function booted(): void
    {
        static::deleting(function ($campaignCustomer) {
            $campaignCustomer->itemNotes()->delete();
        });
    }
}
