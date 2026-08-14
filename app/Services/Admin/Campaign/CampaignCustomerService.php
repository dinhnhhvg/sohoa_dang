<?php

namespace App\Services\Admin\Campaign;

use App\Exports\Admin\CampaignCustomerExport;
use App\Models\User;
use App\Repositories\CampaignCustomerRepository;
use App\Repositories\CampaignRepository;
use App\Repositories\ChannelRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\StatusRepository;
use App\Repositories\UserRepository;
use App\SampleExports\CampaignCustomerSampleExport;
use App\Services\Admin\Customer\CustomerService;
use App\Services\Admin\Log\ImportLogService;
use App\Services\BaseService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\Support\Facades\Validator;

class CampaignCustomerService extends BaseService
{
    public function __construct(
        protected CampaignCustomerRepository $campaignCustomerRepository,
        protected CampaignRepository $campaignRepository,
        protected StatusRepository $statusRepository,
        protected CustomerRepository $customerRepository,
        protected UserRepository $userRepository,
        protected ChannelRepository $channelRepository,

        protected CustomerService $customerService,
        protected ImportLogService $importLogService
    ) {
        parent::__construct($campaignCustomerRepository);
    }

    public function index(Request $request): array
    {
        $data = $request->all();
        $data['campaign'] = $this->campaignRepository->find($request->campaign_id, ['sales']);
        $data['statuses'] = $this->statusRepository->getActiveByModule('campaign_customer');
        $data['sales'] = $this->userRepository->getSaleByRole();
        return $data;
    }

    public function filter(Request $request): array
    {
        $data = $request->all();
        $data['campaignCustomers'] = $this->campaignCustomerRepository->get($request->all(), ['customer', 'sale']);
        return $data;
    }

    public function createImport(Request $request): array
    {
        $data = $request->all();
        $data['sales'] = $this->campaignRepository->find($request->input('campaign_id'), ['sales'])->sales;
        return $data;
    }

    public function downloadImport(): BinaryFileResponse
    {
        return Excel::download(new CampaignCustomerSampleExport(), 'customers.xlsx');
    }

    public function storeImport(Request $request): array|null
    {
        if (in_array(0, $request->input('sale_id'))) {
            $campaign = $this->campaignRepository->find($request->input('campaign_id'), ['sales']);
            $saleIds = $campaign->sales->pluck('id')->toArray();
        } else {
            $saleIds = $request->input('sale_id');
        }
        $saleId = null;

        $sheets = Excel::toArray((object)[], public_path($request->input('file_path')));
        $sheet = $sheets[0] ?? [];

        $rules = [
            'name' => 'required|string|max:255',
            'phone' => 'required|regex:/^0[0-9]{9,10}$/',
            'email' => 'required|email',
        ];

        $logData = [];
        foreach ($sheet as $i => $row) {
            if ($i == 0) {
                continue;
            }

            $row = cleanExcelValue($row);
            $customerData = [
                'name' => $row['0'],
                'phone' => (!str_starts_with($row['1'], '0')) ? '0'.$row['1'] : $row['1'],
                'email' => $row['2'],
            ];

            $validator = Validator::make($customerData, $rules);

            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                $logData[] = [
                    'status' => false,
                    'name' => __('app.row').' '.$i+1,
                    'value' => $row,
                    'message' => $errors[0] ?? ''
                ];
                continue;
            }

            $customer = $this->customerRepository->findByPhoneAndName($customerData);
            if ($customer) {
                $check = $this->campaignCustomerRepository->findByCampaignAndCustomer($request->input('campaign_id'), $customer->id);
                if ($check) {
                    $logData[] = [
                        'status' => false,
                        'name' => __('app.row').' '.$i+1,
                        'value' => $row,
                        'message' => __('app.message.already_exist')
                    ];
                    continue;
                }
            } else {
                $customer = $this->customerService->storeCustomer($customerData);
            }

            $saleId = getNextSaleId($saleIds, $saleId);

            $createData = [
                'campaign_id' => $request->input('campaign_id'),
                'customer_id' => $customer->id,
                'status_id' => env('APP_DEFAULT_CAMPAIGN_CUSTOMER_STATUS_ID'),
                'note' => __('app.import_excel'),
                'sale_id' => $saleId,
            ];
            $this->campaignCustomerRepository->create($createData);
            $logData[] = [
                'status' => true,
                'name' => __('app.row').' '.$i+1,
                'value' => $row,
                'message' => __('app.message.create_success')
            ];
        }

        $importLog = $this->importLogService->storeImportLog('campaign_customer', $request->input('file_path'), $logData);
        return [
            'status' => true,
            'url' => route('admin.import_log.show', ['import_log' => $importLog->id])
        ];
    }

    public function showNote(string|int $id, Request $request): array
    {
        $data = $request->all();
        $data['channels'] = $this->channelRepository->get();
        $data['campaignCustomer'] = $this->campaignCustomerRepository->find($id, ['itemNotes']);
        $data['statuses'] = $this->statusRepository->getActiveByModule('campaign_customer');
        return $data;
    }

    public function update(string|int $id, Request $request): array|bool|null
    {
        if ($request->input('status_id')) {
            $campaignCustomer = $this->campaignCustomerRepository->find($id);
            $campaignCustomer->itemNotes()->create([
                'status_id' => $request->input('status_id'),
                'note' => $request->input('note'),
                'channel_id' => $request->input('channel_id'),
                'created_by_id' => session('user_id'),
                'created_by_type' => User::class
            ]);

            $updateData = [
                'status_id' => $request->input('status_id'),
                'content' => $request->input('content'),
                'note' => $request->input('note'),
                'schedule_at' => $request->input('schedule_at') ? Carbon::parse($request->input('schedule_at'))->format('Y-m-d H:i:s') : null,
            ];
            return $this->campaignCustomerRepository->update($id, $updateData);
        }

        $updateData = [
            'content' => $request->input('content'),
        ];
        return $this->campaignCustomerRepository->update($id, $updateData);
    }

    public function editSaleMany(Request $request): array
    {
        $data = $request->all();
        $data['sales'] = $this->campaignRepository->find($request->input('campaign_id'), ['sales'])->sales;
        return $data;
    }

    public function updateMany(Request $request): array|bool|null
    {
        $ids = $request->ids;
        $ids = explode(',', $ids);

        $updateData['sale_id'] = $request->input('sale_id');
        $this->campaignCustomerRepository->update($ids, $updateData);
        return ['status' => true];
    }

    public function createMany(Request $request): array
    {
        $data = $request->all();
        $data['campaigns'] = $this->campaignRepository->get();
        return $data;
    }

    public function storeMany(Request $request): array
    {
        $saleId = null;

        $campaign = $this->campaignRepository->find($request->input('campaign_id'), ['sales']);
        $saleIds = $campaign->sales->pluck('id')->toArray();

        $logs = [];
        $customers = $this->customerRepository->get(['user_id' => explode(',', $request->input('ids'))]);
        foreach ($customers as $customer) {

            $check = $this->campaignCustomerRepository->findByCampaignAndCustomer($campaign->id, $customer->id);
            if ($check) {
                $logs[] = [
                    'status' => false,
                    'name' => $customer->name,
                    'message' => __('app.message.already_exist')
                ];
                continue;
            }

            $saleId = getNextSaleId($saleIds, $saleId);

            $createData = [
                'campaign_id' => $campaign->id,
                'customer_id' => $customer->id,
                'status_id' => env('APP_DEFAULT_CAMPAIGN_CUSTOMER_STATUS_ID'),
                'note' => __('app.create'),
                'sale_id' => $saleId,
            ];
            $this->campaignCustomerRepository->create($createData);
            $logs[] = [
                'status' => true,
                'name' => $customer->name,
                'message' => __('app.message.create_success')
            ];
        }
        return ['logs' => $logs];
    }

    public function export(Request $request): BinaryFileResponse
    {
        $data = $this->campaignCustomerRepository->get($request->all());
        return Excel::download(new CampaignCustomerExport($data), 'customers.xlsx');
    }
}
