<?php

namespace App\Services\Admin\OldAddress;

use App\Exports\Admin\OldWardExport;
use App\Repositories\OldDistrictRepository;
use App\Repositories\OldProvinceRepository;
use App\Repositories\OldWardRepository;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class OldWardService extends BaseService
{
    public function __construct(
        protected OldWardRepository $oldWardRepository,
        protected OldProvinceRepository $oldProvinceRepository,
        protected OldDistrictRepository $oldDistrictRepository
    ) {
        parent::__construct($oldWardRepository);
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
        $data['oldWards'] = $this->oldWardRepository->get($request->all(), ['oldDistrict.oldProvince']);
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
        return $this->oldWardRepository->create($createData);
    }

    public function edit(string|int $id, Request $request): array
    {
        $oldWard = $this->oldWardRepository->find($id);

        $data = $request->all();
        $data['oldWard'] = $oldWard;
        $data['oldProvinces'] = $this->oldProvinceRepository->get();
        $data['oldDistricts'] = $this->oldProvinceRepository->get(['province_id' => $oldWard->province_id]);
        return $data;
    }

    public function update(int|string $id, Request $request): bool
    {
        $updateData = $request->validated();
        $updateData['code_name'] = formatSlug($updateData['name'], '_');
        $updateData['full_name'] = $updateData['prefix'].' '.$updateData['name'];
        return $this->oldWardRepository->update($id, $updateData);
    }

    public function export(Request $request): BinaryFileResponse
    {
        $data = $this->oldWardRepository->get($request->all(), ['oldDistrict.oldProvince']);
        return Excel::download(new OldWardExport($data), 'oldWards.xlsx');
    }
}
