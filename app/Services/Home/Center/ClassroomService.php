<?php

namespace App\Services\Home\Center;

use App\Repositories\ClassRoomRepository;
use App\Services\BaseService;
use Illuminate\Http\Request;

class ClassroomService extends BaseService
{
    public function __construct(
        protected ClassRoomRepository $classRoomRepository
    )
    {
        parent::__construct($classRoomRepository);
    }

    public function getByCenter(Request $request): array
    {
        $filters['center_id'] = [$request->center_id];
        return [
            'classrooms' => $this->classRoomRepository->get($filters)
        ];
    }
}
