<?php

namespace App\Repositories;

use App\Models\Procuracy;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ProcuracyRepository extends BaseRepository
{
    public function __construct(
        protected Procuracy $procuracy
    )
    {
        parent::__construct($procuracy);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->filterLike($filters, ['code', 'name'])
            ->filterOrderBy($filters);
        return $this->getData($query, $filters['per_page'] ?? null, $withs, $withCounts);
    }
}
