<?php

namespace App\Http\Controllers\Web\Admin\Class;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Class\ClassCustomer\StoreRequest;
use App\Http\Requests\Admin\Class\ClassCustomer\UpdateManyRequest;
use App\Http\Requests\Admin\Class\ClassCustomer\UpdateRequest;
use App\Services\Admin\Class\ClassCustomerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClassCustomerController extends Controller
{
    public function __construct(
        protected ClassCustomerService $classCustomerService
    )
    {
        parent::__construct($classCustomerService, env('APP_VIEW_PATH_ADMIN') . '.class.class_customer');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->classCustomerService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(int|string $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->classCustomerService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }

    public function editEndDateMany(Request $request): View
    {
        $data = $this->classCustomerService->editEndDateMany($request);
        return view($this->viewPath . '.edit_end_date_many', $data);
    }

    public function editStatusMany(Request $request): View
    {
        $data = $this->classCustomerService->editStatusMany($request);
        return view($this->viewPath . '.edit_status_many', $data);
    }

    public function updateMany(UpdateManyRequest $request): JsonResponse
    {
        $data = $this->classCustomerService->updateMany($request);
        return $this->responseSuccess(__('app.message.update_success'), $data);
    }
}
