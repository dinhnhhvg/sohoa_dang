<?php

namespace App\Repositories;

use App\Models\Holiday;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class HolidayRepository extends BaseRepository
{
    public function __construct(
        protected Holiday $holiday
    )
    {
        parent::__construct($holiday);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->filterLike($filters, ['holidays.name'])
            ->filterDate($filters, 'holidays.date')
            ->filterOrderBy($filters);
        return $this->getData($query, $filters['per_page'] ?? null);
    }

    public function findByDate(string $date): ?Model
    {
        return $this->model->newQuery()->where('date', '=', Carbon::parse($date)->format('Y-m-d'))->first();
    }
}
