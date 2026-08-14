<?php

namespace App\Services\Admin\Course;

use App\Repositories\CourseTypeRepository;
use App\Repositories\TypeRepository;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CourseTypeService extends BaseService
{
    public function __construct(
        protected CourseTypeRepository $courseTypeRepository,
        protected TypeRepository $typeRepository
    )
    {
        parent::__construct($courseTypeRepository);
    }

    public function index(Request $request): array
    {
        $data = $request->all();
        $data['types'] = $this->typeRepository->getActiveByModule('course');
        return $data;
    }

    public function filter(Request $request): array
    {
        return [
            'courseTypes' => $this->repository->get($request->all(), ['type'])
        ];
    }

    public function create(Request $request): array
    {
        $data = $request->all();
        $data['types'] = $this->typeRepository->getActiveByModule('course');
        return $data;
    }

    public function store(Request $request): Model|array|null
    {
        $createData = $request->validated();
        $createData['price'] = formatPrice($createData['price']);
        return $this->courseTypeRepository->create($createData);
    }

    public function update(string|int $id, Request $request): array|bool|null
    {
        $updateData = $request->validated();
        $updateData['price'] = formatPrice($updateData['price']);
        return $this->courseTypeRepository->update($id, $updateData);
    }
}
