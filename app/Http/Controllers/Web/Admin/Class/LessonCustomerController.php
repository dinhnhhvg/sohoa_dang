<?php

namespace App\Http\Controllers\Web\Admin\Class;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Class\LessonCustomer\StoreManyRequest;
use App\Http\Requests\Admin\Class\LessonCustomer\StoreRequest;
use App\Http\Requests\Admin\Class\LessonCustomer\UpdateManyRequest;
use App\Services\Admin\Class\LessonCustomerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LessonCustomerController extends Controller
{
    public function __construct(
        protected LessonCustomerService $lessonCustomerService
    )
    {
        parent::__construct($lessonCustomerService, env('APP_VIEW_PATH_ADMIN') . '.class.lesson_customer');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $data = $this->lessonCustomerService->store($request);
        return $this->responseSuccess(__('app.message.create_success'), $data);
    }

    public function updateMany(UpdateManyRequest $request): JsonResponse
    {
        $data = $this->lessonCustomerService->updateMany($request);
        return $this->responseSuccess(__('app.message.update_success'), $data);
    }

    public function createMany(Request $request): View
    {
        $data = $this->lessonCustomerService->createMany($request);
        return view($this->viewPath . '.create_many', $data);
    }

    public function storeMany(StoreManyRequest $request): JsonResponse
    {
        $data = $this->lessonCustomerService->storeMany($request);
        return $this->responseSuccess(__('app.message.create_success'), $data);
    }
}
