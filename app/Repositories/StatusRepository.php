<?php

namespace App\Repositories;

use App\Models\Status;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class StatusRepository extends BaseRepository
{
    public function __construct(
        protected Status $status
    )
    {
        parent::__construct($status);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->filterLike($filters, ['statuses.code', 'statuses.name'])
            ->filterWhere($filters, ['module', 'is_active'])
            ->filterOrderBy($filters);
        return $this->getData($query, $filters['per_page'] ?? null, $withs, $withCounts);
    }

    public function getActiveByModule(string $module): Collection
    {
        $filters = [
            'module' => $module,
            'is_actives' => [1]
        ];
        return $this->get($filters);
    }

    public function getReportByModule(string $module, ?array $wheres = null): Collection
    {
        return $this->model->newQuery()
            ->withCount([
                formatCamelCase($module).'s' => function ($q) use ($wheres) {
                    if ($wheres) {
                        $q->where($wheres);
                    }
                }
            ])
            ->where('module', $module)
            ->get();
    }
}
