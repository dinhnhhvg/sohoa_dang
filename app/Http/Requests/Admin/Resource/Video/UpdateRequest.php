<?php

namespace App\Http\Requests\Admin\Resource\Video;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'type_id' => 'required|integer|exists:types,id',
            'category_id' => 'required|integer|exists:categories,id',
            'description' => 'nullable|string',
            'videoId' => 'required|string',
            'order_number' => 'required|integer'
        ];
    }
}
