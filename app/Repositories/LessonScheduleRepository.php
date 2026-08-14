<?php

namespace App\Repositories;

use App\Models\LessonSchedule;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class LessonScheduleRepository extends BaseRepository
{
    public function __construct(
        protected LessonSchedule $lessonSchedule
    )
    {
        parent::__construct($lessonSchedule);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->filterLike($filters, ['lesson_schedules.name'])
            ->filterWhere($filters, ['id', 'day_of_week', 'type_id', 'class_id'])
            ->filterOrderBy($filters)
            ->orderBy('lesson_schedules.day_of_week', 'ASC');
        return $this->getData($query, $filters['per_page'] ?? null, $withs, $withCounts);
    }
}
