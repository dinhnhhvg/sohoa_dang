<?php

namespace App\Http\Requests\Admin\Config\Religion;

use App\Http\Requests\BaseRequest;
use App\Models\Religion;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'code' => 'required|string|unique:roles,code',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ];
    }
}
