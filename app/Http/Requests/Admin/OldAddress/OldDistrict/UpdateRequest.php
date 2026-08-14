<?php

namespace App\Http\Requests\Admin\OldAddress\OldDistrict;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'old_province_id' => 'sometimes|required|integer|exists:old_provinces,id',
            'code' => 'sometimes|required|string|unique:old_districts,code,'.$this->route('old_district'),
            'prefix' => 'sometimes|required|string|max:255',
            'name' => 'sometimes|required|string|max:255'
        ];
    }
}
