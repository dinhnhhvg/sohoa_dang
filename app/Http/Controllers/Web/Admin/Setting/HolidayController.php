<?php

namespace App\Http\Controllers\Web\Admin\Setting;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Setting\Holiday\StoreRequest;
use App\Http\Requests\Admin\Setting\Holiday\UpdateRequest;
use App\Services\Admin\Setting\HolidayService;
use Illuminate\Http\JsonResponse;

class HolidayController extends Controller
{
    public function __construct(
        protected HolidayService $holidayService
    )
    {
        parent::__construct($holidayService, env('APP_VIEW_PATH_ADMIN').'.setting.holiday');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->holidayService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(int|string $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->holidayService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
