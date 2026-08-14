<?php

namespace App\Http\Controllers\Web\Admin\OldAddress;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\OldAddress\OldWard\StoreRequest;
use App\Http\Requests\Admin\OldAddress\OldWard\UpdateRequest;
use App\Services\Admin\OldAddress\OldWardService;
use Illuminate\Http\JsonResponse;

class OldWardController extends Controller
{
    public function __construct(
        protected OldWardService $oldWardService
    )
    {
        parent::__construct($oldWardService, env('APP_VIEW_PATH_ADMIN').'.old_address.old_ward');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->oldWardService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(int|string $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->oldWardService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
