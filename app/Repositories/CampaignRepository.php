<?php

namespace App\Repositories;

use App\Models\Campaign;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CampaignRepository extends BaseRepository
{
    public function __construct(
        protected Campaign $campaign
    )
    {
        parent::__construct($campaign);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->filterLike($filters, ['campaigns.name', 'campaigns.code'])
            ->filterWhere($filters, ['is_active'])
            ->filterOrderBy($filters)
            ->orderBy('campaigns.id', 'DESC');
        return $this->getData($query, $filters['per_page'] ?? null, $withs, $withCounts);
    }
}
