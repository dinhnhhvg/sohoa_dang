<?php

namespace App\Repositories;

use App\Models\CampaignCustomer;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class CampaignCustomerRepository extends BaseRepository
{
    public function __construct(
        protected CampaignCustomer $campaignCustomer
    )
    {
        parent::__construct($campaignCustomer);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->filterLike($filters, ['campaigns.name', 'campaigns.code'])
            ->filterWhere($filters, ['is_active'])
            ->filterOrderBy($filters)
            ->orderBy('campaign_customers.id', 'DESC');
        return $this->getData($query, $filters['per_page'] ?? null, $withs, $withCounts);
    }

    public function findByCampaignAndCustomer(string|int|null $campaignId, string|int|null $customerId): ?Model
    {
        return $this->model->newQuery()->where(['campaign_id' => $campaignId, 'customer_id' => $customerId])->first();
    }
}
