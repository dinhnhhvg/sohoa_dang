<?php

namespace App\Repositories;

use App\Models\Agency;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class AgencyRepository extends BaseRepository
{
    public function __construct(
        protected Agency $agency
    )
    {
        parent::__construct($agency);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->filterLike($filters, ['agencies.name', 'agencies.code', 'agencies.phone', 'agencies.email'])
            ->filterWhere($filters, ['province_id'])
            ->filterOrderBy($filters);
        return $this->getData($query, $filters['per_page'] ?? null, $withs, $withCounts);
    }
}
