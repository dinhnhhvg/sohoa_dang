<?php

namespace App\Repositories;

use App\Models\ConversationMember;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ConversationMemberRepository extends BaseRepository
{
    public function __construct(
        protected ConversationMember $conversationMember
    )
    {
        parent::__construct($conversationMember);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->filterWhere($filters, ['conversation_id', 'member_id', 'member_type', 'type'])
            ->filterOrderBy($filters);
        if (isset($filters['search_key']) && $filters['search_key'] !== '') {
            $query->whereHas('members', function ($q) use ($filters) {
                $q->where('code', 'like', '%' . $filters['search_key'] . '%')
                    ->orWhere('name', 'like', '%' . $filters['search_key'] . '%');
            });
        }
        return $this->getData($query, $filters['per_page'] ?? null, $withs, $withCounts);
    }
}
