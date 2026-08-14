<?php

namespace App\Services\Admin\Address;

use App\Exports\Admin\WardExport;
use App\Repositories\ProvinceRepository;
use App\Repositories\WardRepository;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class WardService extends BaseService
{
    public function __construct(
        protected WardRepository $wardRepository,
        protected ProvinceRepository $provinceRepository
    ) {
        parent::__construct($wardRepository);
    }

    public function index(Request $request): array
    {
        $data = $request->all();
        $data['provinces'] = $this->provinceRepository->get();
        return $data;
    }

    public function filter(Request $request): array
    {
        $data = $request->all();
        $data['wards'] = $this->repository->get($request->all(), ['province']);
        return $data;
    }

    public function create(Request $request): array
    {
        $data = $request->all();
        $data['provinces'] = $this->provinceRepository->get();
        return $data;
    }

    public function store(Request $request): Model|array|null
    {
        $createData = $request->validated();
        $createData['code_name'] = formatSlug($createData['name'], '_');
        $createData['full_name'] = $createData['prefix'].' '.$createData['name'];
        return $this->wardRepository->create($createData);
    }

    public function edit(string|int $id, Request $request): array
    {
        $data = $request->all();
        $data['ward'] = $this->wardRepository->find($id);
        $data['provinces'] = $this->provinceRepository->get();
        return $data;
    }

    public function update(int|string $id, Request $request): bool
    {
        $updateData = $request->validated();
        $updateData['code_name'] = formatSlug($updateData['name'], '_');
        $updateData['full_name'] = $updateData['prefix'].' '.$updateData['name'];
        return $this->wardRepository->update($id, $updateData);
    }

    public function export(Request $request): BinaryFileResponse
    {
        $data = $this->repository->get($request->all(), ['province']);
        return Excel::download(new WardExport($data), 'wards.xlsx');
    }
}
