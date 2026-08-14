<?php

namespace App\Repositories;

use App\Models\Defendant;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class DefendantRepository extends BaseRepository
{
    public function __construct(
        protected Defendant $defendant
    )
    {
        parent::__construct($defendant);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->filterWhere($filters, ['judgment_id', 'id']);
        return $this->getData($query, $filters['per_page'] ?? null, $withs, $withCounts);
    }
}
