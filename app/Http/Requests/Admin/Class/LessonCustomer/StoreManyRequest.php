<?php

namespace App\Http\Requests\Admin\Class\LessonCustomer;

use App\Http\Requests\BaseRequest;

class StoreManyRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'class_id' => 'required|exists:classes,id',
            'class_customer_ids' => 'required|string',
            'lesson_id' => 'required|array'
        ];
    }
}
