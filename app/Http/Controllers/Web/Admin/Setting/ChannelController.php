<?php

namespace App\Http\Controllers\Web\Admin\Setting;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Setting\Channel\StoreRequest;
use App\Http\Requests\Admin\Setting\Channel\UpdateRequest;
use App\Services\Admin\Setting\ChannelService;
use Illuminate\Http\JsonResponse;

class ChannelController extends Controller
{
    public function __construct(
        protected ChannelService $channelService
    )
    {
        parent::__construct($channelService, env('APP_VIEW_PATH_ADMIN').'.setting.channel');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->channelService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(int|string $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->channelService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
