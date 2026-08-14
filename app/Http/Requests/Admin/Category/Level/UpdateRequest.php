<?php

namespace App\Http\Requests\Admin\Category\Level;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'code' => 'sometimes|required|string|unique:levels,code,'.$this->route('level'),
            'name' => 'sometimes|required|string|max:255',
            'module' => 'sometimes|required|string|max:255',
            'order_number' => 'sometimes|required|integer',
            'is_active' => 'sometimes|required|integer',
        ];
    }
}
