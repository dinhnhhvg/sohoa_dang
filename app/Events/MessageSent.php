<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use SerializesModels;

    public mixed $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function broadcastOn(): Channel
    {
        return new Channel('conversation');
    }

    public function broadcastWith(): array
    {
        return [
            'message' => $this->message->toArray(),
            'member_ids' => $this->message->conversation->conversationMembers->pluck('member_id')->toArray(),
            'conversation_read_url' => route('conversation.read', ['conversation' => $this->message->conversation_id]),
            'conversation_unread_url' => route('conversation.unread', ['conversation' => $this->message->conversation_id]),
        ];
    }

    public function broadcastAs(): string
    {
        return 'message.sent';
    }
}
