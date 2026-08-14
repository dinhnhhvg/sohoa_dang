<?php

namespace App\Http\Requests\Admin\IssuingUnit\Police;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'code' => 'sometimes|required|string|max:255|unique:polices,code,'.$this->route('police'),
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string'
        ];
    }
}
