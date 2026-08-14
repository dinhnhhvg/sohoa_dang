<?php

namespace App\Http\Requests\Root\Account;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255|unique:accounts,name,'.$this->route('account'),
            'code' => 'sometimes|required|string|max:255|unique:accounts,code,'.$this->route('account'),
            'image' => 'sometimes|required|string|file_exist|file_type_valid:image',
            'route' => 'sometimes|required|string|max:255',
            'is_active' => 'sometimes|required|integer'
        ];
    }
}
