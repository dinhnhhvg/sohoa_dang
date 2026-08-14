<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderRepository extends BaseRepository
{
    public function __construct(
        protected Order $order
    )
    {
        parent::__construct($order);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->select('orders.*')
            ->join('customers', 'customers.id', '=', 'orders.customer_id')
            ->filterLike($filters, ['customers.code', 'customers.name', 'customers.email', 'customers.phone'])
            ->filterWhere($filters, ['status_id', 'type_id', 'agency_id', 'sale_id'])
            ->filterDate($filters, 'orders.created_at')
            ->filterOrderBy($filters)
            ->orderBy('orders.id', 'DESC');

        return $this->getData($query, $filters['per_page'] ?? null, $withs, $withCounts);
    }
}
