<?php

namespace App\Http\Requests\Admin\Order\OrderItem;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'course_type_id' => 'required|integer|exists:course_types,id',
            'content' => 'nullable|string'
        ];
    }
}
