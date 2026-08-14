<?php

namespace App\Repositories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ContactRepository extends BaseRepository
{
    public function __construct(
        protected Contact $contact
    )
    {
        parent::__construct($contact);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->select('contacts.*')
            ->join('customers', 'customers.id', '=', 'contacts.customer_id')
            ->filterLike($filters, ['contacts.title', 'customers.name', 'customers.code', 'customers.phone', 'customers.email'])
            ->filterWhere($filters, ['customer_id', 'center_id', 'province_id', 'channel_id', 'sale_id', 'agency_id'])
            ->filterOrderBy($filters)
            ->orderBy('contacts.created_at', 'DESC');
        return $this->getData($query, $filters['per_page'] ?? null, $withs, $withCounts);
    }
}
