<?php

namespace App\Http\Requests\Admin\Center\Center;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'code' => 'sometimes|required|string|unique:centers,code,'.$this->route('center'),
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string',
            'province_id' => 'sometimes|required|integer|exists:provinces,id',
            'ward_id' => 'sometimes|nullable|integer|exists:wards,id',
            'address' => 'sometimes|nullable|nullable|string',
            'is_active' => 'sometimes|required|integer',
        ];
    }
}
