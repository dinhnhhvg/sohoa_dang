<?php

namespace App\Http\Requests\Root\Action;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:actions,name',
            'keys' => 'required|string|max:255'
        ];
    }
}
