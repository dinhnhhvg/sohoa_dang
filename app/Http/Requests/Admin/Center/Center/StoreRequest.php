<?php

namespace App\Http\Requests\Admin\Center\Center;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'code' => 'required|string|unique:roles,code',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'province_id' => 'required|integer|exists:provinces,id',
            'ward_id' => 'nullable|integer|exists:wards,id',
            'address' => 'nullable|nullable|string',
        ];
    }
}
