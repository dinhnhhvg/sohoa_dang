<?php

namespace App\Services\Admin;

use App\Exports\Admin\AgencyExport;
use App\Repositories\AgencyRepository;
use App\Repositories\ProvinceRepository;
use App\Repositories\WardRepository;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class AgencyService extends BaseService
{
    public function __construct(
        protected AgencyRepository $agencyRepository,
        protected ProvinceRepository $provinceRepository,
        protected WardRepository $wardRepository
    )
    {
        parent::__construct($agencyRepository);
    }

    public function index(Request $request): array
    {
        $data = $request->all();
        $data['provinces'] = $this->provinceRepository->get();
        return $data;
    }

    public function create(Request $request): array
    {
        $data = $request->all();
        $data['provinces'] = $this->provinceRepository->get();
        return $data;
    }

    public function edit(string|int $id, Request $request): array
    {
        $agency = $this->agencyRepository->find($id);

        $data = $request->all();
        $data['agency'] = $agency;
        $data['provinces'] = $this->provinceRepository->get();
        $data['wards'] = $this->wardRepository->get(['province_id' => [$agency->province_id]]);
        return $data;
    }

    public function export(Request $request): BinaryFileResponse
    {
        return Excel::download(new AgencyExport($this->repository->get($request->all())), 'agencies.xlsx');
    }
}
