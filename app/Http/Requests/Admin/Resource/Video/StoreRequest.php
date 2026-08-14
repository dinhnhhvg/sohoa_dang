<?php

namespace App\Http\Requests\Admin\Resource\Video;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'type_id' => 'sometimes|required|integer|exists:types,id',
            'category_id' => 'sometimes|required|integer|exists:categories,id',
            'description' => 'sometimes|nullable|string',
            'videoId' => 'sometimes|required|string',
            'order_number' => 'sometimes|required|integer'
        ];
    }
}
