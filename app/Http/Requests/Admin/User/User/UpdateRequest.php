<?php

namespace App\Http\Requests\Admin\User\User;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,'.$this->route('user'),
            'phone' => 'sometimes|required|regex:/^0[0-9]{9,10}$/|unique:users,phone,'.$this->route('user'),
            'avatar' => 'sometimes|required|string|file_exist|file_type_valid:image',
            'gender' => 'sometimes|required|in:male,female',
            'birth_date' => 'sometimes|required|date_format:d-m-Y',
            'role_id' => 'sometimes|required|integer|exists:roles,id',
            'center_id' => 'sometimes|nullable|integer|exists:centers,id',
            'province_id' => 'sometimes|required|integer|exists:provinces,id',
            'ward_id' => 'sometimes|nullable|integer|exists:wards,id',
            'note_value' => 'sometimes|nullable|string',
            'care_value' => 'sometimes|nullable|string',
            'address' => 'sometimes|nullable|string',
            'password' => 'sometimes|required|string|min:8|confirmed|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/',
            'is_active' => 'sometimes|required|integer',
        ];
    }
}
