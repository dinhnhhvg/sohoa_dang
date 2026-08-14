<?php

namespace App\Http\Requests\Admin\Category\Category;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'code' => 'sometimes|required|string|unique:categories,code,'.$this->route('category'),
            'name' => 'sometimes|required|string|max:255',
            'module' => 'sometimes|required|string|max:255',
            'parent_id' => 'sometimes|nullable|integer|exists:categories,id',
            'order_number' => 'sometimes|required|integer',
            'is_active' => 'sometimes|required|integer',
        ];
    }
}
