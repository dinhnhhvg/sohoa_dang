<?php

namespace App\Services\Root;

use App\Repositories\AccountRepository;
use App\Repositories\ActionRepository;
use App\Repositories\MenuActionRepository;
use App\Repositories\MenuRepository;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class MenuService extends BaseService
{
    public function __construct(
        protected MenuRepository $menuRepository,
        protected ActionRepository $actionRepository,
        protected AccountRepository $accountRepository,
        protected MenuActionRepository $menuActionRepository,
    )
    {
        parent::__construct($menuRepository);
    }

    public function index(Request $request): array
    {
        $data = $request->all();
        $data['accounts'] = $this->accountRepository->get();
        return $data;
    }

    public function filter(Request $request): array
    {
        return [
            'menus' => $this->menuRepository->get($request->all(), ['actions'])
        ];
    }

    public function create(Request $request): array
    {
        $data = $request->all();
        $data['accounts'] = $this->accountRepository->get();
        $data['menus'] = $this->menuRepository->get();
        $data['actions'] = $this->actionRepository->get();
        return  $data;
    }

    public function store(Request $request): Model|array|null
    {
        $menu = $this->menuRepository->create($request->validated());
        $this->menuActionCreateMany($menu->id, $request->action_ids);
        return $menu;
    }

    public function edit(string|int $id, Request $request): array
    {
        $data = $request->all();
        $data['menu'] = $this->menuRepository->find($id);
        $data['accounts'] = $this->accountRepository->get();
        $data['menus'] = $this->menuRepository->get();
        $data['actions'] = $this->actionRepository->getNotInMenu($id);
        return  $data;
    }

    public function update(string|int $id, Request $request): array|bool|null
    {
        $this->menuActionCreateMany($id, $request->action_ids);
        return $this->menuRepository->update($id, $request->validated());
    }

    private function menuActionCreateMany(string|int $menuId, ?array $actionIds): void
    {
        if ($actionIds) {
            foreach ($actionIds as $actionId) {
                $menuActionCreateManyData[] = [
                    'menu_id' => $menuId,
                    'action_id' => $actionId,
                    'is_active' => 1
                ];
            }
            if (isset($menuActionCreateManyData) && $menuActionCreateManyData) {
                $this->menuActionRepository->createMany($menuActionCreateManyData);
            }
        }
    }
}
