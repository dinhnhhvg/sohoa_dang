<?php

namespace App\Repositories;

use App\Models\Account;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class AccountRepository extends BaseRepository
{
    public function __construct(
        protected Account $account
    )
    {
        parent::__construct($account);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->filterLike($filters, ['accounts.code', 'accounts.name'])
            ->filterWhere($filters, ['is_active']);
        return $this->getData($query, $filters['per_page'] ?? null, $withs, $withCounts);
    }
}
