<?php

namespace App\Repositories;

use App\Models\ClassCustomer;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ClassCustomerRepository extends BaseRepository
{
    public function __construct(
        protected ClassCustomer $classCustomer
    )
    {
        parent::__construct($classCustomer);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->select('class_customers.*')
            ->join('customers', 'customers.id', '=', 'class_customers.customer_id')
            ->filterLike($filters, ['customers.code', 'customers.name'])
            ->filterWhere($filters, ['status_id', 'class_id', 'customer_id'])
            ->filterOrderBy($filters);
        return $this->getData($query, $filters['per_page'] ?? null, $withs, $withCounts);
    }
}
