<?php

namespace App\Http\Controllers\Web\Admin\Resource;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Resource\ItemMedia\StoreRequest;
use App\Http\Requests\Admin\Resource\ItemMedia\UpdateRequest;
use App\Services\Admin\Resource\ItemMediaService;
use Illuminate\Http\JsonResponse;

class ItemMediaController extends Controller
{
    public function __construct(
        protected ItemMediaService $itemMediaService
    )
    {
        parent::__construct($itemMediaService, env('APP_VIEW_PATH_ADMIN').'.resource.item_media');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->itemMediaService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(int|string $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->itemMediaService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
