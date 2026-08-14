<?php

namespace App\Http\Requests\Admin\Category\Level;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'code' => 'required|string|unique:levels,code',
            'name' => 'required|string|max:255',
            'module' => 'required|string|max:255',
            'order_number' => 'required|integer'
        ];
    }
}
