<?php

namespace App\Repositories;

use App\Models\OldDistrict;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class OldDistrictRepository extends BaseRepository
{
    public function __construct(
        protected OldDistrict $oldDistrict
    ) {
        parent::__construct($oldDistrict);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->filterLike($filters, ['full_name', 'code'])
            ->filterWhere($filters, ['old_province_id'])
            ->filterOrderBy($filters);
        return $this->getData($query, $filters['per_page'] ?? null);
    }
}
