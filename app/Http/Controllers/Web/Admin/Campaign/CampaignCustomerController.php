<?php

namespace App\Http\Controllers\Web\Admin\Campaign;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Campaign\CampaignCustomer\StoreImportRequest;
use App\Http\Requests\Admin\Campaign\CampaignCustomer\UpdateRequest;
use App\Services\Admin\Campaign\CampaignCustomerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CampaignCustomerController extends Controller
{
   public function __construct(
       protected CampaignCustomerService $campaignCustomerService
   )
   {
       parent::__construct($campaignCustomerService, env('APP_VIEW_PATH_ADMIN').'.campaign.campaign_customer');
   }

    public function storeImport(StoreImportRequest $request): JsonResponse
    {
        $data = $this->campaignCustomerService->storeImport($request);
        return $this->responseSuccess(__('app.message.create_success'), $data);
    }

    public function update(string|int $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->campaignCustomerService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }

    public function showNote(string|int $id, Request $request): string
    {
        $data = $this->campaignCustomerService->showNote($id, $request);
        return view($this->viewPath.'.show_note', $data)->render();
    }

    public function editSaleMany(Request $request): string
    {
        $data = $this->campaignCustomerService->editSaleMany($request);
        return view($this->viewPath.'.edit_sale_many', $data)->render();
    }

    public function updateMany(Request $request): JsonResponse
    {
        $data = $this->campaignCustomerService->updateMany($request);
        return $this->responseSuccess(__('app.message.update_success'), $data);
    }

    public function createMany(Request $request): string
    {
        $data = $this->campaignCustomerService->createMany($request);
        return view($this->viewPath.'.create_many', $data)->render();
    }

    public function storeMany(Request $request): JsonResponse
    {
        $data = $this->campaignCustomerService->storeMany($request);
        return $this->responseSuccess(__('app.message.please_check_the_results'), $data);
    }
}
