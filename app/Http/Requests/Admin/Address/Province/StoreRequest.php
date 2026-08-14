<?php

namespace App\Http\Requests\Admin\Address\Province;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'code' => 'required|string|unique:provinces,code',
            'prefix' => 'required|string|max:255',
            'name' => 'required|string|max:255'
        ];
    }
}
