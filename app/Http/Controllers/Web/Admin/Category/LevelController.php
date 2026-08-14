<?php

namespace App\Http\Controllers\Web\Admin\Category;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Category\Level\StoreRequest;
use App\Http\Requests\Admin\Category\Level\UpdateRequest;
use App\Services\Admin\Category\LevelService;
use Illuminate\Http\JsonResponse;

class LevelController extends Controller
{
    public function __construct(
        protected LevelService $levelService
    )
    {
        parent::__construct($this->levelService, env('APP_VIEW_PATH_ADMIN').'.category.level');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->levelService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(string|int $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->levelService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
