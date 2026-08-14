<?php

namespace App\Http\Requests\Admin\OldAddress\OldProvince;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'code' => 'required|string|unique:oldProvinces,code',
            'prefix' => 'required|string|max:255',
            'name' => 'required|string|max:255'
        ];
    }
}
