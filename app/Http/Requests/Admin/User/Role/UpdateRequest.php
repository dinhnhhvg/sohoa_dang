<?php

namespace App\Http\Requests\Admin\User\Role;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'code' => 'sometimes|required|string|unique:roles,code,'.$this->route('role'),
            'name' => 'sometimes|required|string|max:255',
            'account' => 'sometimes|required|string',
            'description' => 'sometimes|nullable|string',
            'is_active' => 'sometimes|required|integer',
        ];
    }
}
