<?php

namespace App\Repositories;

use App\Models\Lesson;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class LessonRepository extends BaseRepository
{
    public function __construct(
        protected Lesson $lesson
    )
    {
        parent::__construct($lesson);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->filterLike($filters, ['lessons.name'])
            ->filterWhere($filters, ['id', 'class_id', 'type_id', 'status_id'])
            ->filterDate($filters, 'lessons.date')
            ->filterOrderBy($filters)
            ->orderBy('lessons.date', 'ASC');
        return $this->getData($query, $filters['per_page'] ?? null, $withs, $withCounts);
    }
}
