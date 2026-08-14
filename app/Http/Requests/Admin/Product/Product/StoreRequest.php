<?php

namespace App\Http\Requests\Admin\Product\Product;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'code' => 'required|string|unique:products,code',
            'name' => 'required|string|max:255',
            'image' => 'required|string|file_exist|file_type_valid:image',
            'meta_description' => 'nullable|string',
            'description' => 'nullable|string',
            'unit' => 'required|string',
            'old_price' => 'nullable|string',
            'price' => 'required|string',
            'order_number' => 'required|integer',
            'category_id' => 'required|integer|exists:categories,id',
            'topic_id' => 'nullable|array',
            'topic_id.*' => 'integer|exists:topics,id',
            'value_id' => 'nullable|array',
            'value_id.*' => 'integer|exists:attribute_values,id',
        ];
    }
}
