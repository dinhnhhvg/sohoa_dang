<?php

namespace App\Http\Requests\Admin\IssuingUnit\Procuracy;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'code' => 'required|string|max:255|unique:procuracies,code',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ];
    }
}
