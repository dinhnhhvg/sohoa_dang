<?php

namespace App\Http\Requests\Admin\Agency;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'agency_id' => 'sometimes|nullable|integer|exists:agencies,id',
            'code' => 'sometimes|required|string|max:255|unique:agencies,code,'.$this->route('agency'),
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|nullable|email',
            'phone' => 'sometimes|nullable|regex:/^0[0-9]{9,10}$/',
            'province_id' => 'sometimes|nullable|integer|exists:provinces,id',
            'ward_id' => 'sometimes|nullable|integer|exists:wards,id',
            'address' => 'sometimes|nullable|string',
            'description' => 'sometimes|nullable|string'
        ];
    }
}
