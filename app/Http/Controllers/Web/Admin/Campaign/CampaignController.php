<?php

namespace App\Http\Controllers\Web\Admin\Campaign;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Campaign\Campaign\StoreRequest;
use App\Http\Requests\Admin\Campaign\Campaign\UpdateRequest;
use App\Services\Admin\Campaign\CampaignService;
use Illuminate\Http\JsonResponse;

class CampaignController extends Controller
{
   public function __construct(
       protected CampaignService $campaignService,
   )
   {
       parent::__construct($campaignService, env('APP_VIEW_PATH_ADMIN').'.campaign.campaign');
   }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->campaignService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(int|string $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->campaignService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
