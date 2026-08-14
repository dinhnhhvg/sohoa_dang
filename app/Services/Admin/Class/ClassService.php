<?php

namespace App\Services\Admin\Class;

use App\Exports\Admin\UserExport;
use App\Repositories\CenterRepository;
use App\Repositories\ClassRepository;
use App\Repositories\ClassRoomRepository;
use App\Repositories\CourseRepository;
use App\Repositories\CourseTypeRepository;
use App\Repositories\StatusRepository;
use App\Repositories\TypeRepository;
use App\Services\BaseService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ClassService extends BaseService
{
    public function __construct(
        protected ClassRepository      $classRepository,
        protected CourseRepository     $courseRepository,
        protected TypeRepository       $typeRepository,
        protected StatusRepository     $statusRepository,
        protected CenterRepository     $centerRepository,
        protected ClassRoomRepository  $classRoomRepository,
        protected CourseTypeRepository $courseTypeRepository
    )
    {
        parent::__construct($classRepository);
    }

    public function index(Request $request): array
    {
        $data = $request->all();
        $data['courses'] = $this->courseRepository->get();
        $data['centers'] = $this->centerRepository->get();
        $data['types'] = $this->typeRepository->getActiveByModule('course');
        $data['statuses'] = $this->statusRepository->getActiveByModule('class');
        return $data;
    }

    public function filter(Request $request): array
    {
        $data = $request->all();
        $data['classes'] = $this->classRepository->get(
            $request->all(),
            ['courseType', 'center', 'classroom', 'status'],
            ['lessons', 'lessonDone', 'classCustomers']
        );
        return $data;
    }

    public function create(Request $request): array
    {
        $data = $request->all();
        $data['centers'] = $this->centerRepository->get();
        $data['courseTypes'] = $this->courseTypeRepository->get();
        $data['statuses'] = $this->statusRepository->getActiveByModule('class');
        return $data;
    }

    public function store(Request $request): Model|array|null
    {
        $createdData = $request->validated();
        $createdData['slug'] = formatSlug($request->name);
        if ($request->start_date) {
            $createdData['start_date'] = Carbon::parse($createdData['start_date'])->format('Y-m-d');
        }
        if ($request->end_date) {
            $createdData['end_date'] = Carbon::parse($createdData['end_date'])->format('Y-m-d');
        }
        return $this->classRepository->create($createdData);
    }

    public function show(string|int $id, Request $request): array
    {
        $class = $this->classRepository->find(
            $id,
            ['courseType', 'center', 'classroom', 'status'],
            ['lessons', 'lessonDone', 'classCustomers']
        );

        $data = $request->all();
        $data['class'] = $class;
        return $data;
    }

    public function edit(string|int $id, Request $request): array
    {
        $class = $this->classRepository->find($id);

        $data = $request->all();
        $data['class'] = $class;
        $data['centers'] = $this->centerRepository->get();
        $data['statuses'] = $this->statusRepository->getActiveByModule('class');
        $data['classrooms'] = $this->classRoomRepository->get(['center_id' => $class->classroom_id]);
        return $data;
    }

    public function update(string|int $id, Request $request): array|bool|null
    {
        $updateData = $request->validated();
        if ($updateData['name']) {
            $updateData['slug'] = formatSlug($updateData['name']);
        }
        if (isset($updateData['start_date']) && $updateData['start_date']) {
            $updateData['start_date'] = Carbon::parse($updateData['start_date'])->format('Y-m-d');
        }
        if (isset($updateData['end_date']) && $updateData['end_date']) {
            $updateData['end_date'] = Carbon::parse($updateData['end_date'])->format('Y-m-d');
        }
        return $this->classRepository->update($id, $updateData);
    }

    public function export(Request $request): BinaryFileResponse
    {
        $data = $this->repository->get($request->all());
        return Excel::download(new UserExport($data), 'users.xlsx');
    }
}
