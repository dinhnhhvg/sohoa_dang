<?php

namespace App\Http\Requests\Admin\Config\Config;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'code' => 'sometimes|required|string|unique_composite:configs,code,module,'.$this->route('config'),
            'name' => 'sometimes|required|string|max:255',
            'module' => 'sometimes|nullable|string|max:255',
            'description' => 'sometimes|nullable|string'
        ];
    }
}
