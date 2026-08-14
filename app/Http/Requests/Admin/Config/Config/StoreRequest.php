<?php

namespace App\Http\Requests\Admin\Config\Config;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'code' => 'required|string|unique_composite:configs,code,module',
            'name' => 'required|string|max:255',
            'module' => 'nullable|string|max:255',
            'description' => 'nullable|string'
        ];
    }
}
