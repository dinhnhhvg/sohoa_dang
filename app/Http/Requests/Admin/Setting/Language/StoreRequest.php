<?php

namespace App\Http\Requests\Admin\Setting\Language;

use App\Http\Requests\BaseRequest;

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
