<?php

namespace App\Http\Requests\Admin\Config\Nationality;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'code' => 'required|string|unique:roles,code',
            'name' => 'required|string|max:255',
            'flag' => 'nullable|string|file_exist|file_type_valid:image',
            'description' => 'nullable|string'
        ];
    }
}
