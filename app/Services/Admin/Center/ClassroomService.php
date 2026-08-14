<?php

namespace App\Services\Admin\Center;

use App\Exports\Admin\ClassroomExport;
use App\Repositories\CenterRepository;
use App\Repositories\ClassRoomRepository;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ClassroomService extends BaseService
{
    public function __construct(
        protected ClassRoomRepository $classRoomRepository,
        protected CenterRepository $centerRepository
    )
    {
        parent::__construct($this->classRoomRepository);
    }

    public function index(Request $request): array
    {
        $data = $request->all();
        $data['centers'] = $this->centerRepository->get();
        return $data;
    }

    public function create(Request $request): array
    {
        $data = $request->all();
        $data['centers'] = $this->centerRepository->get();
        return $data;
    }

    public function edit(string|int $id, Request $request): array
    {
        $data = $request->all();
        $data['classroom'] = $this->classRoomRepository->find($id);
        $data['centers'] = $this->centerRepository->get();
        return $data;
    }

    public function export(Request $request): BinaryFileResponse
    {
        $data = $this->repository->get($request->all());
        return Excel::download(new ClassroomExport($data), 'classrooms.xlsx');
    }
}
