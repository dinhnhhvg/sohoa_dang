<?php

namespace App\Repositories;

use App\Models\LessonCustomer;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class LessonCustomerRepository extends BaseRepository
{
    public function __construct(
        protected LessonCustomer $lessonCustomer
    )
    {
        parent::__construct($lessonCustomer);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->select('lesson_customers.*')
            ->join('class_customers', 'class_customers.id', '=', 'lesson_customers.class_customer_id')
            ->join('customers', 'customers.id', '=', 'class_customers.customer_id')
            ->join('lessons', 'lessons.id', '=', 'lesson_customers.lesson_id')
            ->filterLike($filters, ['lessons.name', 'customers.code', 'customers.name'])
            ->filterWhere($filters, ['lesson_id', 'class_customer_id', 'status_id'])
            ->filterOrderBy($filters);
        return $this->getData($query, $filters['per_page'] ?? null, $withs, $withCounts);
    }
}
