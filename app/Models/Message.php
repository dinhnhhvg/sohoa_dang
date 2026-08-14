<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Message extends BaseModel
{
    protected $guarded = [];

    protected $appends = ['created_at_formatted'];

    public function getCreatedAtFormattedAttribute(): ?string
    {
        return $this->created_at->format('H:i d-m-Y');
    }

    public function conversation(): BelongsTo
    {
        return $this->belongsTo(Conversation::class);
    }

    public function messageAttachment(): HasMany
    {
        return $this->hasMany(MessageAttachment::class, 'message_id');
    }

    public function createdBy(): MorphTo
    {
        return $this->morphTo();
    }
}
