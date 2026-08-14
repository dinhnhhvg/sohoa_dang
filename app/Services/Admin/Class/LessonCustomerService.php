<?php

namespace App\Services\Admin\Class;

use App\Repositories\ClassCustomerRepository;
use App\Repositories\LessonCustomerRepository;
use App\Repositories\LessonRepository;
use App\Repositories\StatusRepository;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class LessonCustomerService extends BaseService
{
    public function __construct(
        protected LessonCustomerRepository $lessonCustomerRepository,
        protected StatusRepository         $statusRepository,
        protected LessonRepository         $lessonRepository,
        protected ClassCustomerRepository  $classCustomerRepository
    )
    {
        parent::__construct($lessonCustomerRepository);
    }

    public function index(Request $request): array
    {
        $data = $request->all();
        $data['statuses'] = $this->statusRepository->getActiveByModule('lesson_customer');
        return $data;
    }

    public function filter(Request $request): array
    {
        $data = $request->all();
        $data['lessonCustomers'] = $this->lessonCustomerRepository->get($request->all(), ['classCustomer.customer', 'lesson']);
        $data['statuses'] = $this->statusRepository->getActiveByModule('lesson_customer');
        return $data;
    }

    public function create(Request $request): array
    {
        $data = $request->all();
        $data['statuses'] = $this->statusRepository->getActiveByModule('lesson_customer');
        if ($request->class_customer_id) {
            $data['lessons'] = $this->lessonRepository->get(['class_id' => $request->class_id]);
        } else {
            $data['classCustomers'] = $this->classCustomerRepository->get(['class_id' => $request->class_id], ['customer']);
        }
        return $data;
    }

    public function store(Request $request): Model|array|null
    {
        if (is_array($request->class_customer_id)) {
            $createData = [
                'lesson_id' => $request->lesson_id,
                'status_id' => $request->status_id
            ];
            foreach ($request->class_customer_id as $class_customer_id) {
                $createData['class_customer_id'] = $class_customer_id;
                $this->lessonCustomerRepository->create($createData);
            }
        }

        if (is_array($request->lesson_id)) {
            $createData = [
                'class_customer_id' => $request->class_customer_id,
                'status_id' => $request->status_id
            ];
            foreach ($request->lesson_id as $lesson_id) {
                $createData['lesson_id'] = $lesson_id;
                $this->lessonCustomerRepository->create($createData);
            }
        }
        return ['status' => true];
    }

    public function createMany(Request $request): array
    {
        $data = $request->all();
        $data['lessons'] = $this->lessonRepository->get(['class_id' => $request->class_id]);
        return $data;
    }

    public function storeMany(Request $request): ?array
    {
        $lessonIds = $request->lesson_id;
        $classCustomerIds = $request->class_customer_ids;
        $classCustomerIds = explode(',', $classCustomerIds);

        if (in_array(0, $lessonIds)) {
            $lessons = $this->lessonRepository->get(['class_id' => $request->class_id]);
        } else {
            $lessons = $this->lessonRepository->get(['id' => $lessonIds]);
        }

        foreach ($lessons as $lesson) {
            foreach ($classCustomerIds as $classCustomerId) {
                $checkClassCustomer = $this->classCustomerRepository->find($classCustomerId);
                if (!$checkClassCustomer || !in_array($checkClassCustomer['status_id'], [4, 9])) {
                    continue;
                }
                $checkLessonCustomer = $this->lessonCustomerRepository->get(['class_customer_id' => $classCustomerId, 'lesson_id' => $lesson->id]);
                if (count($checkLessonCustomer)) {
                    continue;
                }
                $createData = [
                    'class_customer_id' => $classCustomerId,
                    'lesson_id' => $lesson->id,
                    'status_id' => null
                ];
                $this->lessonCustomerRepository->create($createData);
            }
        }
        return ['status' => true];
    }

    public function updateMany(Request $request): ?array
    {
        $ids = $request->ids;
        $ids = $ids ? explode(',', $ids) : [];
        $statusIds = $request->status_ids;
        $statusIds = $statusIds ? explode(',', $statusIds) : $statusIds;
        foreach ($ids as $i => $id) {
            $updateData = [
                'status_id' => $statusIds[$i] ?: null
            ];
            $this->lessonCustomerRepository->update($id, $updateData);
        }
        return ['status' => true];
    }
}
