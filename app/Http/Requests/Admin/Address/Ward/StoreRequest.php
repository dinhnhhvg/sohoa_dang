<?php

namespace App\Http\Requests\Admin\Address\Ward;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'province_id' => 'required|integer|exists:provinces,id',
            'code' => 'required|string|unique:wards,code',
            'prefix' => 'required|string|max:255',
            'name' => 'required|string|max:255'
        ];
    }
}
