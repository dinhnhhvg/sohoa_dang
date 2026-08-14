<?php

namespace App\Http\Requests\Admin\Config\Nationality;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'code' => 'sometimes|required|string|unique:nationalities,code,'.$this->route('nationality'),
            'name' => 'sometimes|required|string|max:255',
            'flag' => 'sometimes|nullable|string|file_exist|file_type_valid:image',
            'description' => 'sometimes|nullable|string'
        ];
    }
}
