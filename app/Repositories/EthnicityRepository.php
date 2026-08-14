<?php

namespace App\Repositories;

use App\Models\Ethnicity;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class EthnicityRepository extends BaseRepository
{
    public function __construct(
        protected Ethnicity $ethnicity
    )
    {
        parent::__construct($ethnicity);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->filterLike($filters, ['code', 'name'])
            ->filterOrderBy($filters);
        return $this->getData($query, $filters['per_page'] ?? null);
    }
}
