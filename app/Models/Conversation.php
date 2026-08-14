<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Conversation extends BaseModel
{
    protected $guarded = [];

    protected $casts = [
        'last_message_at' => 'datetime',
    ];

    protected $appends = ['last_message_at_formatted'];

    public function getLastMessageAtFormattedAttribute(): ?string
    {
        return $this->created_at->format('H:i d-m-Y');
    }

    public function conversationMembers(): HasMany
    {
        return $this->hasMany(ConversationMember::class, 'conversation_id');
    }

    public function conversationMemberAdmins(): HasMany
    {
        return $this->hasMany(ConversationMember::class, 'conversation_id')->where('type', 'admin');
    }

    public function createdBy(): MorphTo
    {
        return $this->morphTo();
    }
}
