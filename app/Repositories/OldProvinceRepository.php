<?php

namespace App\Repositories;

use App\Models\OldProvince;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class OldProvinceRepository extends BaseRepository
{
    public function __construct(
        protected OldProvince $oldProvince
    ) {
        parent::__construct($oldProvince);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->filterLike($filters, ['full_name', 'code'])
            ->filterOrderBy($filters);
        return $this->getData($query, $filters['per_page'] ?? null, $withs, $withCounts);
    }
}
