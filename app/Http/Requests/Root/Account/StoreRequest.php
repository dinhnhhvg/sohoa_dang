<?php

namespace App\Http\Requests\Root\Account;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:accounts,name',
            'code' => 'required|string|max:255|unique:accounts,code',
            'image' => 'required|string|file_exist|file_type_valid:image',
            'route' => 'required|string|max:255'
        ];
    }
}
