<?php

namespace App\Services\Admin\Customer;

use App\Exports\Admin\CustomerExport;
use App\Repositories\AgencyRepository;
use App\Repositories\CenterRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\CustomerTagRepository;
use App\Repositories\ProvinceRepository;
use App\Repositories\WardRepository;
use App\SampleExports\CustomerSampleExport;
use App\Services\Admin\Log\ImportLogService;
use App\Services\BaseService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CustomerService extends BaseService
{
    public function __construct(
        protected CustomerRepository    $customerRepository,
        protected CenterRepository      $centerRepository,
        protected AgencyRepository $agencyRepository,
        protected ProvinceRepository    $provinceRepository,
        protected WardRepository        $wardRepository,
        protected CustomerTagRepository $customerTagRepository,

        protected ImportLogService $importLogService,
    )
    {
        parent::__construct($customerRepository);
    }

    public function index(Request $request): array
    {
        $data = $request->all();
        $data['centers'] = $this->centerRepository->get();
        $data['agencies'] = $this->agencyRepository->get();
        $data['provinces'] = $this->provinceRepository->get();
        $data['customerTags'] = $this->customerTagRepository->get();
        return $data;
    }

    public function create(Request $request): array
    {
        $data = $request->all();
        $data['customerTags'] = $this->customerTagRepository->get();
        $data['provinces'] = $this->provinceRepository->get();
        $data['agencies'] = $this->agencyRepository->get();
        $data['centers'] = $this->centerRepository->get();
        return $data;
    }

    public function store(Request $request): Model|array|null
    {
        $createData = $request->validated();
        return $this->storeCustomer($createData);
    }

    public function storeCustomer(array $createData): Model|array|null
    {
        $createData['code'] = 'CODE';
        if (isset($createData['birth_date']) && $createData['birth_date']) {
            $createData['birth_date'] = Carbon::parse($createData['birth_date'])->format('Y-m-d');
        }
        $createData['avatar'] =  $createData['avatar'] ?? env('APP_DEFAULT_AVATAR');
        $createData['is_active'] = 1;
        $createData['password'] = Hash::make(env('APP_DEFAULT_PASSWORD'));
        $customer = $this->customerRepository->create($createData);
        $updateData['code'] = str_pad($customer->id, 6, '0', STR_PAD_LEFT);
        $this->customerRepository->update($customer->id, $updateData);
        return $this->customerRepository->find($customer->id);
    }

    public function show(string|int $id, Request $request): array
    {
        $customer = $this->customerRepository->find($id);

        $data = $request->all();
        $data['customer'] = $customer;
        $data['centers'] = $this->centerRepository->get();
        $data['agencies'] = $this->agencyRepository->get();
        $data['provinces'] = $this->provinceRepository->get();
        $data['wards'] = $this->wardRepository->get(['province_id' => [$customer->province_id]]);
        $data['customerTags'] = $this->customerTagRepository->get();
        return $data;
    }

    public function findByPhoneAndName(Request $request): array
    {
        $customer = $this->customerRepository->findByPhoneAndName($request->all());
        $data['customer'] = $customer;
        if ($customer) {
            $data['agencies'] = $this->agencyRepository->get();
            $data['centers'] = $this->centerRepository->get();
            $data['provinces'] = $this->provinceRepository->get();
            $data['wards'] = $this->wardRepository->get(['province_id' => [$customer->province_id]]);
            $data['customerTags'] = $this->customerTagRepository->get();
        }
        return $data;
    }

    public function update(string|int $id, Request $request): array|bool|null
    {
        $updateData = $request->validated();
        if (isset($updateData['password'])) {
            $updateData['password'] = Hash::make($updateData['password']);
        }
        if (isset($updateData['birth_date']) && $updateData['birth_date']) {
            $updateData['birth_date'] = Carbon::parse($updateData['birth_date'])->format('Y-m-d');
        }
        if (!$this->customerRepository->update($id, $updateData)) {
            return false;
        }
        return true;
    }

    public function downloadImport(): BinaryFileResponse
    {
        return Excel::download(new CustomerSampleExport(), 'customers.xlsx');
    }

    public function storeImport(Request $request): array|null
    {
        $sheets = Excel::toArray((object)[], public_path($request->input('file_path')));
        $sheet = $sheets[0] ?? [];

        $rules = [
            'name' => 'required|string|max:255|unique_composite:customers,name,phone',
            'phone' => 'required|regex:/^0[0-9]{9,10}$/',
            'email' => 'required|email',
        ];

        $logData = [];
        foreach ($sheet as $i => $row) {
            if ($i === 0) {
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
            $this->storeCustomer($customerData);
            $logData[] = [
                'status' => true,
                'name' => __('app.row').' '.$i+1,
                'value' => $row,
                'message' => __('app.message.create_success')
            ];
        }

        $importLog = $this->importLogService->storeImportLog('customer', $request->input('file_path'), $logData);
        return [
            'status' => true,
            'url' => route('admin.import_log.show', ['import_log' => $importLog->id])
        ];
    }

    public function export(Request $request): BinaryFileResponse
    {
        $data = $this->customerRepository->get($request->all());
        return Excel::download(new CustomerExport($data), 'customers.xlsx');
    }
}
