<?php

namespace App\Repositories;

use App\Models\Nationality;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class NationalityRepository extends BaseRepository
{
    public function __construct(
        protected Nationality $nationality
    )
    {
        parent::__construct($nationality);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->filterLike($filters, ['code', 'name'])
            ->filterOrderBy($filters);
        return $this->getData($query, $filters['per_page'] ?? null);
    }
}
