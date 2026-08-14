<?php

namespace App\Services\Admin\OldAddress;

use App\Exports\Admin\OldProvinceExport;
use App\Repositories\OldProvinceRepository;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class OldProvinceService extends BaseService
{
    public function __construct(
        protected OldProvinceRepository $oldProvinceRepository
    ) {
        parent::__construct($oldProvinceRepository);
    }

    public function filter(Request $request): array
    {
        $data = $request->all();
        $data['oldProvinces'] = $this->oldProvinceRepository->get($request->all(), null, ['oldDistricts']);
        return $data;
    }

    public function store(Request $request): Model|array|null
    {
        $createData = $request->validated();
        $createData['code_name'] = formatSlug($createData['name'], '_');
        $createData['full_name'] = $createData['prefix'].' '.$createData['name'];
        return $this->oldProvinceRepository->create($createData);
    }

    public function update(int|string $id, Request $request): bool
    {
        $updateData = $request->validated();
        $updateData['code_name'] = formatSlug($updateData['name'], '_');
        $updateData['full_name'] = $updateData['prefix'].' '.$updateData['name'];
        return $this->oldProvinceRepository->update($id, $updateData);
    }

    public function export(Request $request): BinaryFileResponse
    {
        $data = $this->oldProvinceRepository->get($request->all(), null, ['oldDistricts']);
        return Excel::download(new OldProvinceExport($data), 'oldProvinces.xlsx');
    }
}
