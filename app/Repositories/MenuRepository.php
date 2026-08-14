<?php

namespace App\Repositories;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class MenuRepository extends BaseRepository
{
    public function __construct(
        protected Menu $menu
    )
    {
        parent::__construct($menu);
    }

    public function get(?array $filters = null, ?array $withs = null, ?array $withCounts = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()
            ->filterLike($filters, 'menus.name')
            ->filterWhere($filters, ['account', 'is_active'])
            ->whereNull('menus.parent_id')
            ->orderBy('menus.order_number', 'ASC');
        return $this->getData($query, $filters['per_page'] ?? null, $withs, $withCounts);
    }

    public function getActiveMenu(?string $account = null): Collection
    {
        $query = $this->model->newQuery()
            ->with([
                'menus' => function ($q) use ($account) {
                    $q->where([
                        'account' => $account,
                        'is_active' => 1
                    ])
                    ->with([
                        'actions'
                    ]);
                },
                'actions'
            ])
            ->whereNull('menus.parent_id')
            ->where([
                'menus.account' => $account,
                'menus.is_active' => 1
            ])
            ->orderBy('menus.order_number', 'ASC');

        return $this->getData($query);
    }

    public function getActiveMenuByRole(string|int $roleId): Collection
    {
        $query = $this->model->newQuery()
            ->whereHas('roles', function ($q) use ($roleId) {
                $q->where('role_id', $roleId);
            })
            ->with([
                'menuActions' => function ($q) use ($roleId) {
                    $q->whereHas('roles', function ($q) use ($roleId) {
                        $q->where('role_id', $roleId);
                    })
                    ->with(['action']);
                },
                'menus' => function ($q) use ($roleId) {
                    $q->whereHas('roles', function ($q) use ($roleId) {
                        $q->where('role_id', $roleId);
                    })
                    ->with([
                        'menuActions' => function ($q) use ($roleId) {
                            $q->whereHas('roles', function ($q) use ($roleId) {
                                $q->where('role_id', $roleId);
                            })
                            ->with(['action']);
                        }
                    ]);
                }
            ])
            ->whereNull('menus.parent_id')
            ->where([
                'menus.is_active' => 1
            ])
            ->orderBy('menus.order_number', 'ASC');

        return $this->getData($query);
    }

    public function getMenuByAccount(?array $filters = null): Collection
    {
        $account = $filters['account'];
        $roleId = $filters['roleId'];

        $query = $this->model->newQuery()
            ->with([
                'menus' => function ($q) use ($account, $roleId) {
                    $q->where([
                        'account' => $account,
                        'is_active' => 1
                    ])
                    ->with([
                        'menuActions' => function ($q) use ($roleId) {
                            $q->where('is_active', 1)
                            ->with([
                                'action'
                            ])
                            ->withCount([
                                'roles' => function ($q) use ($roleId) {
                                    $q->where('role_id', $roleId);
                                }
                            ]);
                        }
                    ])
                    ->withCount([
                        'roles' => function ($q) use ($roleId) {
                            $q->where('role_id', $roleId);
                        }
                    ]);
                },
                'menuActions' => function ($q) use ($roleId) {
                    $q->where('is_active', 1)
                    ->with([
                        'action'
                    ])
                    ->withCount([
                        'roles' => function ($q) use ($roleId) {
                            $q->where('role_id', $roleId);
                        }
                    ]);
                }
            ])
            ->withCount([
                'roles' => function ($q) use ($roleId) {
                    $q->where('role_id', $roleId);
                }
            ])
            ->whereNull('menus.parent_id')
            ->where([
                'menus.account' => $account,
                'menus.is_active' => 1
            ])
            ->orderBy('menus.order_number', 'ASC');

        return $this->getData($query);
    }
}
