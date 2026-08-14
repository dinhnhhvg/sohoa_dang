<?php

namespace App\Http\Controllers\Web\Admin\Customer;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Customer\Customer\StoreImportRequest;
use App\Http\Requests\Admin\Customer\Customer\StoreRequest;
use App\Http\Requests\Admin\Customer\Customer\UpdateRequest;
use App\Services\Admin\Customer\CustomerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct(
        protected CustomerService $customerService
    )
    {
        parent::__construct($customerService, env('APP_VIEW_PATH_ADMIN') . '.customer.customer');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->customerService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(string|int $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->customerService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }

    public function storeImport(StoreImportRequest $request): JsonResponse
    {
        $data = $this->customerService->storeImport($request);
        return $this->responseSuccess(__('app.message.create_success'), $data);
    }

    public function findByPhoneAndName(Request $request): string
    {
        $data = $this->customerService->findByPhoneAndName($request);
        if ($data['customer']) {
            return view($this->viewPath.'.find_by_phone_and_name', $data)->render();
        }
        return '';
    }
}
