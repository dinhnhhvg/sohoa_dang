<?php

namespace App\Repositories;

use App\Models\Notification;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class NotificationRepository extends BaseRepository
{
    public function __construct(
        protected Notification $notification
    )
    {
        parent::__construct($notification);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->filterLike($filters, ['title'])
            ->filterWhere($filters, ['account', 'module', 'sender_by_id', 'sender_by_type'])
            ->filterWhereNotIn()
            ->filterOrderBy($filters);
        return $this->getData($query, $filters['per_page'] ?? null);
    }
}
