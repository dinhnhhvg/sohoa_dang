<?php

namespace App\Http\Controllers\Web\Admin\Batch;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Batch\Defendant\StoreRequest;
use App\Services\Admin\Batch\DefendantService;
use Illuminate\Http\JsonResponse;

class DefendantController extends Controller
{
    public function __construct(
        protected DefendantService $defendantService
    )
    {
        parent::__construct($defendantService, env('APP_VIEW_PATH_ADMIN').'.batch.defendant');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $defendant = $this->defendantService->store($request);
        return $this->responseSuccess(__('app.message.create_success'), ['defendant_id' => $defendant->id]);
    }
}
