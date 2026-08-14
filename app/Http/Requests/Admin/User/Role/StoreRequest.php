<?php

namespace App\Http\Requests\Admin\User\Role;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'code' => 'required|string|unique:roles,code',
            'name' => 'required|string|max:255',
            'account' => 'required|string',
            'description' => 'nullable|string',
        ];
    }
}
