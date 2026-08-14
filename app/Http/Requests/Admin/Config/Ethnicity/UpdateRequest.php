<?php

namespace App\Http\Requests\Admin\Config\Ethnicity;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'code' => 'sometimes|required|string|unique:ethnicities,code,'.$this->route('ethnicity'),
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string'
        ];
    }
}
