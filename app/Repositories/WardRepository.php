<?php

namespace App\Repositories;

use App\Models\Ward;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class WardRepository extends BaseRepository
{
    public function __construct(
        protected Ward $ward
    ) {
        parent::__construct($ward);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->filterLike($filters, ['wards.full_name', 'wards.code'])
            ->filterWhere($filters, ['province_id'])
            ->filterOrderBy($filters);
        return $this->getData($query, $filters['per_page'] ?? null);
    }
}
