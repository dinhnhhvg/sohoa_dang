<?php

namespace App\Http\Requests\Admin\Category\Category;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'code' => 'required|string|unique:categories,code',
            'name' => 'required|string|max:255',
            'module' => 'required|string|max:255',
            'parent_id' => 'nullable|integer|exists:categories,id',
            'order_number' => 'required|integer'
        ];
    }
}
