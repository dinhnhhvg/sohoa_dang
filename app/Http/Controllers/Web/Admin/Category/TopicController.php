<?php

namespace App\Http\Controllers\Web\Admin\Category;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Category\Topic\StoreRequest;
use App\Http\Requests\Admin\Category\Topic\UpdateRequest;
use App\Services\Admin\Category\TopicService;
use Illuminate\Http\JsonResponse;

class TopicController extends Controller
{
    public function __construct(
        protected TopicService $topicService
    )
    {
        parent::__construct($this->topicService, env('APP_VIEW_PATH_ADMIN').'.category.topic');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->topicService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(string|int $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->topicService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
