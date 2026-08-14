<?php

namespace App\Repositories;

use App\Models\ImportLog;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ImportLogRepository extends BaseRepository
{
    public function __construct(
        protected ImportLog $importLog
    )
    {
        parent::__construct($importLog);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->filterWhere($filters, 'module')
            ->filterDate($filters, 'import_logs.created_at')
            ->filterOrderBy($filters);
        return $this->getData($query, $filters['per_page'] ?? null);
    }
}
