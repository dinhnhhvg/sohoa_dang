<?php

namespace App\Repositories;

use App\Models\Chapter;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ChapterRepository extends BaseRepository
{
    public function __construct(
        protected Chapter $chapter
    )
    {
        parent::__construct($chapter);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->filterLike($filters, ['categories.full_name'])
            ->filterWhere($filters, ['course_id'])
            ->filterOrderBy($filters)
            ->orderBy('chapters.order_number', 'ASC');
        return $this->getData($query, $filters['per_page'] ?? null, $withs, $withCounts);
    }
}
