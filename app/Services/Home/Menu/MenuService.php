<?php

namespace App\Services\Home\Menu;

use App\Repositories\MenuRepository;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Collection;

class MenuService extends BaseService
{
    public function __construct(
        protected MenuRepository $menuRepository
    )
    {
        parent::__construct($this->menuRepository);
    }

    public function getMenuByAccount(?string $account): ? Collection
    {
        return $this->menuRepository->getActiveMenu($account);
    }

    public function getActiveMenuByRole(?array $session = null): ?Collection
    {
        $session = $session ?: session()->all();
        if (isset($session['role_code']) && $session['role_code'] === 'admin') {
            return $this->menuRepository->getActiveMenu($session['account']);
        }
        return isset($session['role_id']) && $session['role_id'] ?
            $this->menuRepository->getActiveMenuByRole($session['role_id'])
            : null;
    }
}
