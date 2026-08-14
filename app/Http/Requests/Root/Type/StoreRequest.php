<?php

namespace App\Http\Requests\Root\Type;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:types,name',
            'code' => 'required|string|max:255|unique:types,code',
            'module' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string'
        ];
    }
}
