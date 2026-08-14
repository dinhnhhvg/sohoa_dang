<?php

namespace App\Repositories;

use App\Models\CustomerTag;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CustomerTagRepository extends BaseRepository
{
    public function __construct(
        protected CustomerTag $customerTag
    )
    {
        parent::__construct($customerTag);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->filterLike($filters, ['customer_tag.name'])
            ->filterOrderBy($filters);
        return $this->getData($query, $filters['per_page'] ?? null, $withs, $withCounts);
    }
}
