<?php

namespace App\Http\Requests\Root\Status;

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
            'actions' => 'nullable|string',
            'bg_color' => 'nullable|string'
        ];
    }
}
