<?php

namespace App\Services\Admin\Campaign;

use App\Exports\Admin\CampaignExport;
use App\Repositories\CampaignRepository;
use App\Repositories\StatusRepository;
use App\Repositories\UserRepository;
use App\Services\BaseService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CampaignService extends BaseService
{
    public function __construct(
        protected CampaignRepository $campaignRepository,
        protected UserRepository $userRepository,
        protected StatusRepository $statusRepository
    )
    {
        parent::__construct($campaignRepository);
    }

    public function filter(Request $request): array
    {
        $data = $request->all();
        $data['campaigns'] = $this->campaignRepository->get($request->all(), ['sales'], ['campaignCustomers']);
        return $data;
    }

    public function create(Request $request): array
    {
        $data = $request->all();
        $data['sales'] = $this->userRepository->getSaleByRole();
        return $data;
    }

    public function store(Request $request): Model|array|null
    {
        $createData = $request->validated();
        $createData['slug'] = formatSlug($createData['name']);
        $createData['start_date'] = $request->input('start_date') ? Carbon::parse($request->input('start_date'))->format('Y-m-d') : null;
        $createData['end_date'] = $request->input('end_date') ? Carbon::parse($request->input('end_date'))->format('Y-m-d') : null;
        unset($createData['sale_id']);
        $campaign = $this->campaignRepository->create($createData);
        $campaign->sales()->attach($request->input('sale_id'));
        return $campaign;
    }

    public function edit(string|int $id, Request $request): array
    {
        $data = $request->all();
        $data['campaign'] = $this->campaignRepository->find($id);
        $data['sales'] = $this->userRepository->getSaleByRole();
        return $data;
    }

    public function update(string|int $id, Request $request): array|bool|null
    {
        $updateData = $request->validated();
        if (isset($updateData['name'])) {
            $updateData['slug'] = formatSlug($updateData['name']);
        }
        if (isset($updateData['start_date']) && $updateData['start_date']) {
            $updateData['start_date'] = Carbon::parse($updateData['start_date'])->format('Y-m-d');
        }
        if (isset($updateData['end_date']) && $updateData['start_date']) {
            $updateData['end_date'] = Carbon::parse($updateData['end_date'])->format('Y-m-d');
        }
        unset($updateData['sale_id']);
        $campaign = $this->campaignRepository->find($id);
        $campaign->sales()->sync($request->input('sale_id'));
        return $this->campaignRepository->update($id, $updateData);
    }

    public function show(string|int $id, Request $request): array
    {
        $statuses = $this->statusRepository->getReportByModule('campaign_customer', ['campaign_id' => $id]);

        $data = $request->all();
        $data['campaign'] = $this->campaignRepository->find($id);
        $data['chartData'] = $this->handleChart($statuses);
        return $data;
    }

    private function handleChart(mixed $data): array
    {
        $chartData = [];
        foreach ($data as $row) {
            $chartData[] = [
                'name' => __('app.'.$row->name),
                'count' => $row->campaign_customers_count,
                'color' => $row->bg_color
            ];
        }
        return $chartData;
    }

    public function export(Request $request): BinaryFileResponse
    {
        $data = $this->campaignRepository->get($request->all());
        return Excel::download(new CampaignExport($data), 'campaigns.xlsx');
    }
}
