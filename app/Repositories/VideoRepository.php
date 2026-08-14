<?php

namespace App\Repositories;

use App\Models\Video;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class VideoRepository extends BaseRepository
{
    public function __construct(
        protected Video $video
    )
    {
        parent::__construct($video);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->filterLike($filters, ['videos.name'])
            ->filterWhere($filters, ['type_id', 'category_id'])
            ->filterOrderBy($filters)
            ->orderBy('videos.order_number', 'ASC');
        return $this->getData($query, $filters['per_page'] ?? null, $withs, $withCounts);
    }
}
