<?php

namespace App\Services\Admin\OldAddress;

use App\Exports\Admin\OldDistrictExport;
use App\Repositories\OldDistrictRepository;
use App\Repositories\OldProvinceRepository;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class OldDistrictService extends BaseService
{
    public function __construct(
        protected OldDistrictRepository $oldDistrictRepository,
        protected OldProvinceRepository $oldProvinceRepository
    ) {
        parent::__construct($oldDistrictRepository);
    }

    public function index(Request $request): array
    {
        $data = $request->all();
        $data['oldProvinces'] = $this->oldProvinceRepository->get();
        return $data;
    }

    public function filter(Request $request): array
    {
        $data = $request->all();
        $data['oldDistricts'] = $this->oldDistrictRepository->get($request->all(), ['oldProvince'], ['oldWards']);
        return $data;
    }

    public function create(Request $request): array
    {
        $data = $request->all();
        $data['oldProvinces'] = $this->oldProvinceRepository->get();
        return $data;
    }

    public function store(Request $request): Model|array|null
    {
        $createData = $request->validated();
        $createData['code_name'] = formatSlug($createData['name'], '_');
        $createData['full_name'] = $createData['prefix'].' '.$createData['name'];
        return $this->oldDistrictRepository->create($createData);
    }

    public function edit(string|int $id, Request $request): array
    {
        $data = $request->all();
        $data['oldDistrict'] = $this->oldDistrictRepository->find($id);
        $data['oldProvinces'] = $this->oldProvinceRepository->get();
        return $data;
    }

    public function update(int|string $id, Request $request): bool
    {
        $updateData = $request->validated();
        $updateData['code_name'] = formatSlug($updateData['name'], '_');
        $updateData['full_name'] = $updateData['prefix'].' '.$updateData['name'];
        return $this->oldDistrictRepository->update($id, $updateData);
    }

    public function export(Request $request): BinaryFileResponse
    {
        $data = $this->oldDistrictRepository->get($request->all(), ['']);
        return Excel::download(new oldDistrictExport($data), 'oldDistricts.xlsx');
    }
}
