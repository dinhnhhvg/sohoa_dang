<?php

namespace App\Http\Requests\Admin\Product\Product;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'code' => 'sometimes|required|string|unique:products,code,'.$this->route('product'),
            'name' => 'sometimes|required|string|max:255',
            'image' => 'sometimes|required|string|file_exist|file_type_valid:image',
            'meta_description' => 'sometimes|nullable|string',
            'description' => 'sometimes|nullable|string',
            'product_addon_id' => 'sometimes|array',
            'product_addon_id.*' => 'sometimes|required|exists:products,id',
            'unit' => 'sometimes|required|string',
            'old_price' => 'sometimes|nullable|string',
            'price' => 'sometimes|required|string',
            'order_number' => 'sometimes|required|integer',
            'category_id' => 'sometimes|required|integer|exists:categories,id',
            'topic_id' => 'sometimes|required|array',
            'topic_id.*' => 'sometimes|required|integer|exists:topics,id',
            'value_id' => 'sometimes|required|array',
            'value_id.*' => 'sometimes|required|integer|exists:attribute_values,id',
            'is_active' => 'sometimes|required|boolean',
        ];
    }
}
