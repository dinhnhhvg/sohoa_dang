<?php

namespace App\Http\Requests\Admin\OldAddress\OldDistrict;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'old_province_id' => 'required|integer|exists:old_provinces,id',
            'code' => 'required|string|unique:old_districts,code',
            'prefix' => 'required|string|max:255',
            'name' => 'required|string|max:255'
        ];
    }
}
