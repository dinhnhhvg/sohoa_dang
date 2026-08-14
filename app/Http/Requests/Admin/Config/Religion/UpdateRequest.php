<?php

namespace App\Http\Requests\Admin\Config\Religion;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'code' => 'sometimes|required|string|unique:religions,code,'.$this->route('religion'),
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string'
        ];
    }
}
