<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductRepository extends BaseRepository
{
    public function __construct(
        protected Product $product
    )
    {
        parent::__construct($product);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->filterLike($filters, ['products.name', 'provinces.code'])
            ->filterWhere($filters, ['category_id', 'is_active'])
            ->filterOrderBy($filters)
            ->orderBy('products.order_number', 'ASC');
        return $this->getData($query, $filters['per_page'] ?? null, $withs, $withCounts);
    }
}
