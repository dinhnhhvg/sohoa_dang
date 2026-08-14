<?php

namespace App\Repositories;

use App\Models\ClassRoom;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ClassRoomRepository extends BaseRepository
{
    public function __construct(
        protected ClassRoom $classRoom
    )
    {
        parent::__construct($classRoom);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->filterLike($filters, ['classrooms.name', 'classrooms.locale'])
            ->filterWhere($filters, ['center_id'])
            ->filterOrderBy($filters);
        return $this->getData($query, $filters['per_page'] ?? null, $withs, $withCounts);
    }
}
