<?php

namespace App\Http\Requests\Admin\Address\Ward;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'province_id' => 'sometimes|required|integer|exists:provinces,id',
            'code' => 'sometimes|required|string|unique:wards,code,'.$this->route('ward'),
            'prefix' => 'sometimes|required|string|max:255',
            'name' => 'sometimes|required|string|max:255'
        ];
    }
}
