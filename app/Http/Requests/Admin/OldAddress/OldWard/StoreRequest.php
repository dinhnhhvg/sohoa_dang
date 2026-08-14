<?php

namespace App\Http\Requests\Admin\OldAddress\OldWard;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'old_district_id' => 'required|integer|exists:old_districts,id',
            'code' => 'required|string|unique:old_wards,code',
            'prefix' => 'required|string|max:255',
            'name' => 'required|string|max:255'
        ];
    }
}
