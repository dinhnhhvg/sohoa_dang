<?php

namespace App\Repositories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PaymentRepository extends BaseRepository
{
    public function __construct(
        protected Payment $payment
    )
    {
        parent::__construct($payment);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->filterLike($filters, ['payments.name', 'payments.amount'])
            ->filterWhere($filters, ['order_id', 'status_id', 'sale_id', 'payment_method_id'])
            ->filterDate($filters, 'payments.date')
            ->filterOrderBy($filters)
            ->orderBy('payments.id', 'DESC');
        return $this->getData($query, $filters['per_page'] ?? null, $withs, $withCounts);
    }
}
