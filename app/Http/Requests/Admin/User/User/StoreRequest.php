<?php

namespace App\Http\Requests\Admin\User\User;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|regex:/^0[0-9]{9,10}$/|unique:users,phone',
            'avatar' => 'required|string|file_exist|file_type_valid:image',
            'gender' => 'required|in:male,female',
            'birth_date' => 'required|date_format:d-m-Y',
            'role_id' => 'required|integer|exists:roles,id',
            'center_id' => 'nullable|integer|exists:centers,id',
            'province_id' => 'nullable|integer|exists:provinces,id',
            'ward_id' => 'nullable|integer|exists:wards,id',
            'address' => 'nullable|string'
        ];
    }
}
