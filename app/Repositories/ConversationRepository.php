<?php

namespace App\Repositories;

use App\Models\Conversation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class ConversationRepository extends BaseRepository
{
    public function __construct(
        protected Conversation $conversation
    )
    {
        parent::__construct($conversation);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->selectRaw('
                conversations.*,
                conversation_members.id as conversation_member_id,
                COUNT(DISTINCT messages.id) as new_messages_count
            ')
            ->join('conversation_members', function ($join) {
                $join->on('conversation_members.conversation_id', '=', 'conversations.id')
                    ->where('conversation_members.member_id', '=', session('member_id'));
            })
            ->leftJoin('messages', function ($join) {
                $join->on('messages.conversation_id', '=', 'conversation_members.conversation_id')
                    ->on('messages.created_at', '>', 'conversation_members.last_read_at');
            })
            ->filterLike($filters, ['conversations.name'])
            ->filterWhere($filters, ['conversations.id', 'conversation_members.member_type', 'conversation_members.member_id'])
            ->orderBy('conversations.last_message_at', 'DESC')
            ->groupBy('conversations.id');

        if (isset($filters['search_key']) && $filters['search_key'] !== '') {
            $query->whereHas('conversationMembers', function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['search_key'] . '%');
            });
        }
        return $this->getData($query, $filters['per_page'] ?? null, $withs, $withCounts);
    }

    public function find(int|string $id, ?array $withs = null, ?array $withCounts = null): ?Model
    {
        $query = $this->model->newQuery()
            ->selectRaw('
                conversations.*,
                conversation_members.id as conversation_member_id
            ')
            ->join('conversation_members', function ($join) {
                $join->on('conversation_members.conversation_id', '=', 'conversations.id')
                    ->where('conversation_members.member_id', '=', session('member_id'));
            });
        if ($withs) {
            $query->with($withs);
        }
        if ($withCounts) {
            $query->withCount($withCounts);
        }
        return $query->find($id);
    }

    public function getUnreadConversationsCount(): ?int
    {
        $query = $this->model->newQuery()
            ->join('conversation_members', function ($join) {
                $join->on('conversation_members.conversation_id', '=', 'conversations.id')
                    ->where('conversation_members.member_id', '=', session('member_id'));
            })
            ->whereColumn('conversation_members.last_read_at', '<', 'conversations.last_message_at');

        return $this->getData($query)->count();
    }
}
