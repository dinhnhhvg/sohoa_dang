<?php

namespace App\Http\Requests\Admin\Category\Topic;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'province_id' => 'sometimes|required|integer|exists:categories,id',
            'name' => 'sometimes|required|string|max:255',
            'order_number' => 'sometimes|required|integer'
        ];
    }
}
