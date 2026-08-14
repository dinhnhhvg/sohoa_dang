<?php

namespace App\Repositories;

use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PaymentMethodRepository extends BaseRepository
{
    public function __construct(
        protected PaymentMethod $paymentMethod
    )
    {
        parent::__construct($paymentMethod);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->filterLike($filters, ['payment_methods.name']);
        return $this->getData($query, $filters['per_page'] ?? null, $withs, $withCounts);
    }
}
