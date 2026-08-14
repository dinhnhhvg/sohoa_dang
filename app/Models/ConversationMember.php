<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ConversationMember extends BaseModel
{
    protected $guarded = [];

    protected $casts = [
        'last_read_at' => 'datetime',
        'last_delete_at' => 'datetime',
    ];

    public function conversation(): BelongsTo {
        return $this->belongsTo(Conversation::class);
    }

    public function newMessages(): HasMany
    {
        return $this->hasMany(Message::class, 'conversation');
    }

    public function member(): MorphTo
    {
        return $this->morphTo();
    }
}
