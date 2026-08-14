<?php

namespace App\Http\Controllers\Web\Root;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Root\MenuAction\UpdateRequest;
use App\Services\Root\MenuActionService;
use Illuminate\Http\JsonResponse;

class MenuActionController extends Controller
{
    public function __construct(
        protected MenuActionService $menuActionService
    )
    {
        parent::__construct($menuActionService, env('APP_VIEW_PATH_ROOT').'.menu_action');
    }

    public function update(int|string $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->menuActionService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
