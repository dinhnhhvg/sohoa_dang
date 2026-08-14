<?php

namespace App\Http\Requests\Admin\IssuingUnit\Procuracy;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'code' => 'sometimes|required|string|max:255|unique:procuracies,code,'.$this->route('procuracy'),
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string'
        ];
    }
}
