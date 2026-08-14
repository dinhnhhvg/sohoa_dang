<?php

namespace App\Repositories;

use App\Models\Channel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ChannelRepository extends BaseRepository
{
    public function __construct(
        protected Channel $channel
    )
    {
        parent::__construct($channel);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->filterLike($filters, ['channels.name']);
        return $this->getData($query, $filters['per_page'] ?? null, $withs, $withCounts);
    }
}
