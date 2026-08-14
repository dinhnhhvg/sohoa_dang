<?php

namespace App\Services\Admin\Address;

use App\Exports\Admin\ProvinceExport;
use App\Repositories\ProvinceRepository;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ProvinceService extends BaseService
{
    public function __construct(
        protected ProvinceRepository $provinceRepository
    ) {
        parent::__construct($provinceRepository);
    }

    public function filter(Request $request): array
    {
        $data = $request->all();
        $data['provinces'] = $this->provinceRepository->get($request->all(), null, ['wards']);
        return $data;
    }

    public function store(Request $request): Model|array|null
    {
        $createData = $request->validated();
        $createData['code_name'] = formatSlug($createData['name'], '_');
        $createData['full_name'] = $createData['prefix'].' '.$createData['name'];
        return $this->provinceRepository->create($createData);
    }

    public function update(int|string $id, Request $request): bool
    {
        $updateData = $request->validated();
        $updateData['code_name'] = formatSlug($updateData['name'], '_');
        $updateData['full_name'] = $updateData['prefix'].' '.$updateData['name'];
        return $this->provinceRepository->update($id, $updateData);
    }

    public function export(Request $request): BinaryFileResponse
    {
        $data = $this->repository->get($request->all(), null, ['wards']);
        return Excel::download(new ProvinceExport($data), 'provinces.xlsx');
    }
}
