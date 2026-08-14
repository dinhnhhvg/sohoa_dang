<?php

namespace App\Repositories;

use App\Models\Message;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class MessageRepository extends BaseRepository
{
    public function __construct(
        protected Message $message
    )
    {
        parent::__construct($message);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->join('conversation_members', function ($join) {
                $join->on('conversation_members.conversation_id', '=', 'messages.conversation_id')
                    ->where('conversation_members.member_id', '=', session('member_id'));
            })
            ->filterLike($filters, ['messages.content'])
            ->filterWhere($filters, ['messages.conversation_id'])
            ->whereColumn('messages.created_at', '>', 'conversation_members.last_delete_at')
            ->orderBy('messages.created_at', 'desc');

        if (isset($filters['max_id']) && $filters['max_id']) {
            $query->where('messages.id', '<', $filters['max_id']);
        }

        $collection = $this->getData($query, $filters['per_page'] ?? null, $withs, $withCounts);

        if ($collection instanceof LengthAwarePaginator) {
            $collection->setCollection(
                $collection->getCollection()->reverse()->values()
            );
        } else {
            $collection = $collection->reverse()->values();
        }
        return $collection;
    }
}
