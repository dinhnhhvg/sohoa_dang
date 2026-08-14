<?php

namespace App\Http\Requests\Root\Status;

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
            'actions' => 'sometimes|nullable|string',
            'bg_color' => 'sometimes|nullable|string',
            'is_active' => 'sometimes|required|integer'
        ];
    }
}
