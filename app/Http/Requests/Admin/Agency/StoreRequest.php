<?php

namespace App\Http\Requests\Admin\Agency;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'agency_id' => 'nullable|integer|exists:agencies,id',
            'code' => 'required|string|max:255|unique:agencies,code',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|regex:/^0[0-9]{9,10}$/',
            'province_id' => 'nullable|integer|exists:provinces,id',
            'ward_id' => 'nullable|integer|exists:wards,id',
            'address' => 'nullable|string',
            'description' => 'nullable|string'
        ];
    }
}
