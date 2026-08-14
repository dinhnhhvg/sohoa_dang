<?php

namespace App\Repositories;

use App\Models\Level;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class LevelRepository extends BaseRepository
{
    public function __construct(
        protected Level $level
    )
    {
        parent::__construct($level);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->filterLike($filters, ['levels.code', 'levels.name'])
            ->filterWhere($filters, ['module', 'is_active'])
            ->filterOrderBy($filters)
            ->orderBy('levels.order_number', 'ASC');
        return $this->getData($query, $filters['per_page'] ?? null, $withs, $withCounts);
    }
}
