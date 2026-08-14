<?php

namespace App\Http\Requests\Admin\Product\Attribute;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|array',
            'category_id.*' => 'required|integer|exists:categories,id',
        ];
    }
}
