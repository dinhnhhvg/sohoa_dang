<?php

namespace App\Repositories;

use App\Models\Classes;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ClassRepository extends BaseRepository
{
    public function __construct(
        protected Classes $classes
    )
    {
        parent::__construct($classes);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->select('classes.*')
            ->join('course_types', 'course_types.id', '=', 'classes.course_type_id')
            ->filterLike($filters, ['classes.code', 'classes.name'])
            ->filterWhere($filters, ['course_id', 'type_id', 'status_id', 'center_id'])
            ->filterOrderBy($filters)
            ->orderBy('classes.id', 'DESC');

        return $this->getData($query, $filters['per_page'] ?? null, $withs, $withCounts);
    }
}
