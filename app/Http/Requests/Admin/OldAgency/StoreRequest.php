<?php

namespace App\Http\Requests\Admin\OldAgency;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'old_agency_id' => 'nullable|integer|exists:old_agencies,id',
            'code' => 'required|string|max:255|unique:old_agencies,code',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|regex:/^0[0-9]{9,10}$/',
            'description' => 'nullable|string'
        ];
    }
}
