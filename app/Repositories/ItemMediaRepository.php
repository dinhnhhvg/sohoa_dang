<?php

namespace App\Repositories;

use App\Models\ItemMedia;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ItemMediaRepository extends BaseRepository
{
    public function __construct(
        protected ItemMedia $itemMedia
    )
    {
        parent::__construct($itemMedia);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->filterLike($filters, 'title')
            ->filterWhere($filters, ['item_type', 'item_id'])
            ->orderBy('order_number', 'ASC');
        return $this->getData($query, $filters['per_page'] ?? null);
    }
}
