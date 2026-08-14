<?php

namespace App\Repositories;

use App\Models\Center;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CenterRepository extends BaseRepository
{
    public function __construct(
        protected Center $center
    )
    {
        parent::__construct($center);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->filterLike($filters, ['centers.name', 'centers.code'])
            ->filterWhere($filters, ['is_active'])
            ->filterOrderBy($filters);
        return $this->getData($query, $filters['per_page'] ?? null, $withs, $withCounts);
    }
}
