<?php

namespace App\Http\Requests\Admin\Address\Province;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'code' => 'sometimes|required|string|unique:provinces,code,'.$this->route('province'),
            'prefix' => 'sometimes|required|string|max:255',
            'name' => 'sometimes|required|string|max:255'
        ];
    }
}
