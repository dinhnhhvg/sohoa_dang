<?php

namespace App\Repositories;

use App\Models\OldAgency;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class OldAgencyRepository extends BaseRepository
{
    public function __construct(
        protected OldAgency $oldAgency
    )
    {
        parent::__construct($oldAgency);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->filterLike($filters, ['name', 'code', 'phone', 'email'])
            ->filterWhere($filters, ['old_agency_id'])
            ->filterOrderBy($filters);
        return $this->getData($query, $filters['per_page'] ?? null, $withs, $withCounts);
    }
}
