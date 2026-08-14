<?php

namespace App\Repositories;

use App\Models\Config;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ConfigRepository extends BaseRepository
{
    public function __construct(
        protected Config $config
    )
    {
        parent::__construct($config);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->filterLike($filters, ['code', 'name'])
            ->filterWhere($filters, ['module'])
            ->filterOrderBy($filters);
        return $this->getData($query, $filters['per_page'] ?? null, $withs, $withCounts);
    }

    public function getByModule(string $module, ?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->where('module', $module)
            ->filterLike($filters, ['code', 'name'])
            ->filterOrderBy($filters);
        return $this->getData($query, $filters['per_page'] ?? null, $withs, $withCounts);
    }
}
