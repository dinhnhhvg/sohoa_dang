<?php

namespace App\Http\Requests\Admin\Config\Ethnicity;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'code' => 'required|string|unique:roles,code',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ];
    }
}
