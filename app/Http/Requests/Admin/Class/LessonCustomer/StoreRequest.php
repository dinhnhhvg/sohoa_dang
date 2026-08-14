<?php

namespace App\Http\Requests\Admin\Class\LessonCustomer;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'class_customer_id' => 'required',
            'class_customer_id.*' => 'required|integer|exists:class_customers,id|unique_composite:lesson_customers,lesson_id,class_customer_id',
            'lesson_id' => 'required',
            'lesson_id.*' => 'required|integer|exists:lessons,id|unique_composite:lesson_customers,lesson_id,class_customer_id',
            'status_id' => 'nullable|exists:statuses,id',
        ];
    }
}
