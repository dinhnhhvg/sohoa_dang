<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryRepository extends BaseRepository
{
    public function __construct(
        protected Category $category
    ) {
        parent::__construct($category);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->filterLike($filters, ['categories.full_name', 'categories.code'])
            ->filterWhere($filters, ['module', 'is_active'])
            ->filterOrderBy($filters)
            ->orderBy('categories.order_number', 'ASC');
        return $this->getData($query, $filters['per_page'] ?? null, $withs, $withCounts);
    }

    public function getByModule(string $module): Collection
    {
        $query = $this->model->newQuery()
            ->where('module', $module)
            ->orderBy('categories.order_number', 'ASC');
           return $this->getData($query );
    }

    public function getParentByModule(string $module): Collection
    {
        $query = $this->model->newQuery()
            ->where('module', $module)
            ->whereNull('parent_id')
            ->orderBy('categories.order_number', 'ASC');
        return $this->getData($query );
    }
}
