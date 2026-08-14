<?php

namespace App\Http\Requests\Admin\Category\Topic;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'category_id' => 'required|integer|exists:categories,id',
            'name' => 'required|string|max:255',
            'order_number' => 'required|integer'
        ];
    }
}
