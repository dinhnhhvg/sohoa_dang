<?php

namespace App\Repositories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class CustomerRepository extends BaseRepository
{
    public function __construct(
        protected Customer $customer
    )
    {
        parent::__construct($customer);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->filterLike($filters, ['customers.name', 'customers.email', 'customers.phone', 'customers.code'])
            ->filterWhere($filters, ['role_id', 'center_id', 'agency_id', 'province_id', 'customer_tag_id', 'is_active'])
            ->filterOrderBy($filters);
        return $this->getData($query, $filters['per_page'] ?? null, $withs, $withCounts);
    }

    public function findByPhoneAndName(array $filters): ?Model
    {
        return $this->model->newQuery()->where(['phone' => $filters['phone'], 'name' => $filters['name']])->first();
    }
}
