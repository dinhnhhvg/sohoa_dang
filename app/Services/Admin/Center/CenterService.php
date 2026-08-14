<?php

namespace App\Services\Admin\Center;

use App\Exports\Admin\CenterExport;
use App\Repositories\CenterRepository;
use App\Repositories\ProvinceRepository;
use App\Repositories\WardRepository;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CenterService extends BaseService
{
    public function __construct(
        protected CenterRepository $centerRepository,
        protected ProvinceRepository $provinceRepository,
        protected WardRepository $wardRepository
    )
    {
        parent::__construct($centerRepository);
    }

    public function index(Request $request): array
    {
        $data = $request->all();
        $data['provinces'] = $this->provinceRepository->get();
        return $data;
    }

    public function filter(Request $request): array
    {
        return [
            'centers' => $this->centerRepository->get($request->all(), null, ['classrooms']),
            'orderByName' => $request->orderByName,
            'orderByType' => $request->orderByType
        ];
    }

    public function create(Request $request): array
    {
        $data = $request->all();
        $data['provinces'] = $this->provinceRepository->get();
        return $data;
    }

    public function edit(string|int $id, Request $request): array
    {
        $center = $this->centerRepository->find($id);
        $data['center'] = $center;
        $data['provinces'] = $this->provinceRepository->get();
        $data['wards'] = $this->wardRepository->get(['province_id' => [$center->province_id]]);
        return $data;
    }

    public function export(Request $request): BinaryFileResponse
    {
        $data = $this->centerRepository->get($request->all(), null, ['classrooms']);
        return Excel::download(new CenterExport($data), 'centers.xlsx');
    }
}
