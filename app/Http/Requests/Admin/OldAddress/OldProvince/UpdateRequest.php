<?php

namespace App\Http\Requests\Admin\OldAddress\OldProvince;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'code' => 'sometimes|required|string|unique:old_provinces,code,'.$this->route('old_province'),
            'prefix' => 'sometimes|required|string|max:255',
            'name' => 'sometimes|required|string|max:255'
        ];
    }
}
