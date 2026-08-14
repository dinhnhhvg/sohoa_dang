<?php

namespace App\Services\Admin\Class;

use App\Exports\Admin\ClassCustomerExport;
use App\Repositories\ClassCustomerRepository;
use App\Repositories\ClassRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\StatusRepository;
use App\Services\BaseService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ClassCustomerService extends BaseService
{
    public function __construct(
        protected ClassCustomerRepository $classCustomerRepository,
        protected CustomerRepository      $customerRepository,
        protected StatusRepository        $statusRepository,
        protected ClassRepository         $classRepository
    )
    {
        parent::__construct($classCustomerRepository);
    }

    public function index(Request $request): array
    {
        $data = $request->all();
        $data['statuses'] = $this->statusRepository->getActiveByModule('class_customer');
        return $data;
    }

    public function filter(Request $request): array
    {
        return [
            'classCustomers' => $this->classCustomerRepository->get($request->all(), ['customer'], ['lessonCustomers', 'lessonCustomerDone']),
            'orderByName' => $request->orderByName,
            'orderByType' => $request->orderByType,
            'viewType' => $request->viewType
        ];
    }

    public function create(Request $request): array
    {
        $data = $request->all();
        $data['customers'] = $this->customerRepository->get(['is_actives' => [1]]);
        $data['statuses'] = $this->statusRepository->getActiveByModule('class_customer');
        $data['class'] = $this->classRepository->find($request->class_id);
        return $data;
    }

    public function store(Request $request): ?Model
    {
        $createData = $request->all();
        if ($request->start_date) {
            $createData['start_date'] = Carbon::parse($request->start_date)->format('Y-m-d');
        }
        if ($request->end_date) {
            $createData['end_date'] = Carbon::parse($request->end_date)->format('Y-m-d');
        }
        return $this->classCustomerRepository->create($createData);
    }

    public function editEndDateMany(Request $request): array
    {
        return $request->all();
    }

    public function editStatusMany(Request $request): array
    {
        $data = $request->all();
        $data['statuses'] = $this->statusRepository->getActiveByModule('class_customer');
        return $data;
    }

    public function updateMany(Request $request): array|bool|null
    {
        $ids = $request->ids;
        $ids = explode(',', $ids);

        $updateData = $request->validated();
        unset($updateData['ids']);
        if (isset($updateData['end_date'])) {
            $updateData['end_date'] = Carbon::parse($updateData['end_date'])->format('Y-m-d');
        }

        foreach ($ids as $id) {
            $this->classCustomerRepository->update($id, $updateData);
        }
        return ['status' => true];
    }

    public function export(Request $request): BinaryFileResponse
    {
        $data = $this->classCustomerRepository->get($request->all());
        return Excel::download(new ClassCustomerExport($data), 'students.xlsx');
    }
}
