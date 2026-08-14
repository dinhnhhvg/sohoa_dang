<?php

namespace App\Repositories;

use App\Models\CategoryAttribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryAttributeRepository extends BaseRepository
{
    public function __construct(
        protected CategoryAttribute $categoryAttribute
    )
    {
        parent::__construct($categoryAttribute);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->filterWhere($filters, ['category_id', 'attribute_id']);
        return $this->getData($query, $filters['per_page'] ?? null, $withs, $withCounts);
    }
}
