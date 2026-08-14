<?php

namespace App\Http\Requests\Admin\Product\Attribute;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string',
            'category_id' => 'sometimes|required|array',
            'category_id.*' => 'sometimes|required|integer|exists:categories,id',
        ];
    }
}
