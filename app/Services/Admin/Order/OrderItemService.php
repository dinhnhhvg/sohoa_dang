<?php

namespace App\Services\Admin\Order;

use App\Repositories\CourseTypeRepository;
use App\Repositories\OrderItemRepository;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class OrderItemService extends BaseService
{
    public function __construct(
        protected OrderItemRepository $orderItemRepository,
        protected CourseTypeRepository $courseTypeRepository,

        protected OrderService $orderService
    )
    {
        parent::__construct($orderItemRepository);
    }

    public function filter(Request $request): array
    {
        $data = $request->all();
        $data['orderItems'] = $this->orderItemRepository->get($request->all(), ['item']);
        return $data;
    }

    public function create(Request $request): array
    {
        $data = $request->all();
        if ($request->type_code === 'course') {
            $data['courseTypes'] = $this->courseTypeRepository->get();
        }
        return $data;
    }

    public function store(Request $request): Model|array|null
    {
        $courseType = $this->courseTypeRepository->find($request->course_type_id);
        $createData = [
            'item_type' => 'App\Models\CourseType',
            'item_id' => $request->input('course_type_id'),
            'order_id' => $request->input('order_id'),
            'price' => $courseType->price,
            'content' => $request->input('content'),
        ];
        $orderItem = $this->orderItemRepository->create($createData);
        $this->orderService->updateAmount($request->order_id);

        return $orderItem;
    }

    public function update(string|int $id, Request $request): array|bool|null
    {
        $updateData = [
            'price' => formatPrice($request->input('price')),
            'content' => $request->input('content')
        ];
        $this->orderItemRepository->update($id, $updateData);
        $this->orderService->updateAmount($request->order_id);
        return true;
    }
}
