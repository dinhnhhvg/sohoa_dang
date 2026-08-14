<?php

namespace App\Http\Requests\Root\Type;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255|unique:types,name,'.$this->route('type'),
            'code' => 'sometimes|required|string|max:255|unique:types,code,'.$this->route('type'),
            'module' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string',
            'icon' => 'sometimes|nullable|string',
            'is_active' => 'sometimes|required|integer'
        ];
    }
}
