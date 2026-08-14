<?php

namespace App\Http\Requests\Admin\OldAddress\OldWard;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'old_district_id' => 'sometimes|required|integer|exists:old_districts,id',
            'code' => 'sometimes|required|string|unique:old_wards,code,'.$this->route('old_ward'),
            'prefix' => 'sometimes|required|string|max:255',
            'name' => 'sometimes|required|string|max:255'
        ];
    }
}
