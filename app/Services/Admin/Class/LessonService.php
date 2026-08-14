<?php

namespace App\Services\Admin\Class;

use App\Exports\Admin\LessonExport;
use App\Repositories\CenterRepository;
use App\Repositories\ClassRoomRepository;
use App\Repositories\LessonRepository;
use App\Repositories\StatusRepository;
use App\Repositories\TypeRepository;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class LessonService extends BaseService
{
    public function __construct(
        protected LessonRepository    $lessonRepository,
        protected TypeRepository      $typeRepository,
        protected StatusRepository    $statusRepository,
        protected CenterRepository    $centerRepository,
        protected ClassRoomRepository $classRoomRepository
    )
    {
        parent::__construct($lessonRepository);
    }

    public function index(Request $request): array
    {
        $data = $request->all();
        $data['types'] = $this->typeRepository->getActiveByModule('lesson');
        $data['statuses'] = $this->statusRepository->getActiveByModule('lesson');
        return $data;
    }

    public function filter(Request $request): array
    {
        $data = $request->all();
        $data['lessons'] = $this->lessonRepository->get($request->all(), [], ['lessonCustomers']);
        return $data;
    }

    public function create(Request $request): array
    {
        $data = $request->all();
        $data['types'] = $this->typeRepository->getActiveByModule('lesson');
        $data['centers'] = $this->centerRepository->get();
        return $data;
    }

    public function edit(string|int $id, Request $request): array
    {
        $lesson = $this->lessonRepository->find($id);

        $data = $request->all();
        $data['lesson'] = $lesson;
        $data['types'] = $this->typeRepository->getActiveByModule('lesson');
        $data['centers'] = $this->centerRepository->get();
        $data['classrooms'] = $this->classRoomRepository->get(['center_id' => $lesson->center_id]);
        return $data;
    }

    public function export(Request $request): BinaryFileResponse
    {
        $data = $this->lessonRepository->get($request->all());
        return Excel::download(new LessonExport($data), 'lessons.xlsx');
    }
}
