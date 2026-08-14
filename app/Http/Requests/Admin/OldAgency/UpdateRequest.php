<?php

namespace App\Http\Requests\Admin\OldAgency;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'old_agency_id' => 'sometimes|nullable|integer|exists:old_agencies,id',
            'code' => 'sometimes|required|string|max:255|unique:old_agencies,code,'.$this->route('old_agency'),
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|nullable|email',
            'phone' => 'sometimes|nullable|regex:/^0[0-9]{9,10}$/',
            'description' => 'sometimes|nullable|string'
        ];
    }
}
