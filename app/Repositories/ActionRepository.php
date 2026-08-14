<?php

namespace App\Repositories;

use App\Models\Account;
use App\Models\Action;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ActionRepository extends BaseRepository
{
    public function __construct(
        protected Action $action
    )
    {
        parent::__construct($action);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->filterLike($filters, ['actions.name', 'actions.key']);
        return $this->getData($query, $filters['per_page'] ?? null, $withs, $withCounts);
    }

    public function getNotInMenu(string|int $menuId): Collection
    {
        return $this->model->whereDoesntHave('menus', fn($q) => $q->where('menu_id', $menuId))->get();
    }
}
