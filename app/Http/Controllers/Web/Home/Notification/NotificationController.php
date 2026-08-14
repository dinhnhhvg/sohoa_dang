<?php

namespace App\Http\Controllers\Web\Home\Notification;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Home\Notification\Notification\StoreRequest;
use App\Http\Requests\Home\Notification\Notification\UpdateRequest;
use App\Services\Home\Notification\NotificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function __construct(
        protected NotificationService $notificationService
    )
    {
        parent::__construct($notificationService, env('APP_VIEW_PATH_HOME').'.notification.notification');
    }

    public function filterNotification(Request $request): JsonResponse
    {
        $data = $this->notificationService->filter($request);
        return $this->responseSuccess('', $data);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->notificationService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(string|int $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->notificationService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }

    public function read(string|int $id, Request $request): JsonResponse
    {
        $this->notificationService->read($id, $request);
        return $this->responseSuccess('');
    }
}
