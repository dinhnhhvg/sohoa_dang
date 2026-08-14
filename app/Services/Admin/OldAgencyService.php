<?php

namespace App\Services\Admin;

use App\Exports\Admin\OldAgencyExport;
use App\Repositories\OldAgencyRepository;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class OldAgencyService extends BaseService
{
    public function __construct(
        protected OldAgencyRepository $oldAgencyRepository
    )
    {
        parent::__construct($oldAgencyRepository);
    }

    public function index(Request $request): array
    {
        $data = $request->all();
        $data['oldAgencies'] = $this->oldAgencyRepository->get();
        return $data;
    }

    public function filter(Request $request): array
    {
        $data = $request->all();
        $data['oldAgencies'] = $this->oldAgencyRepository->get($request->all(), null, ['batches']);
        return $data;
    }

    public function create(Request $request): array
    {
        $data = $request->all();
        $data['oldAgencies'] = $this->oldAgencyRepository->get();
        return $data;
    }

    public function edit(string|int $id, Request $request): array
    {
        $data = $request->all();
        $data['oldAgencies'] = $this->oldAgencyRepository->get();
        $data['oldAgency'] = $this->oldAgencyRepository->find($id);
        return $data;
    }

    public function export(Request $request): BinaryFileResponse
    {
        return Excel::download(new OldAgencyExport($this->oldAgnecyRepository->get($request->all(), null, ['records'])), 'old_agencies.xlsx');
    }
}
