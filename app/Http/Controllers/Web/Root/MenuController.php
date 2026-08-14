<?php

namespace App\Http\Controllers\Web\Root;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Root\Menu\StoreRequest;
use App\Http\Requests\Root\Menu\UpdateRequest;
use App\Services\Root\MenuService;
use Illuminate\Http\JsonResponse;

class MenuController extends Controller
{
    public function __construct(
        protected MenuService $menuService
    )
    {
        parent::__construct($menuService, env('APP_VIEW_PATH_ROOT').'.menu');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->menuService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(int|string $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->menuService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
