<?php

namespace App\Http\Requests\Admin\Customer\Customer;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255|unique_composite:customers,name,phone,'.$this->route('customer'),
            'email' => 'sometimes|required|email',
            'phone' => 'sometimes|required|regex:/^0[0-9]{9,10}$/',
            'avatar' => 'sometimes|required|string|file_exist|file_type_valid:image',
            'gender' => 'sometimes|required|in:male,female',
            'birth_date' => 'sometimes|nullable|date_format:d-m-Y',
            'center_id' => 'sometimes|nullable|integer|exists:centers,id',
            'agency_id' => 'sometimes|nullable|integer|exists:agencies,id',
            'province_id' => 'sometimes|required|integer|exists:provinces,id',
            'ward_id' => 'sometimes|nullable|integer|exists:wards,id',
            'address' => 'sometimes|nullable|string',
            'customer_tag_id' => 'sometimes|nullable|integer|exists:customer_tags,id',
            'channel_id' => 'sometimes|nullable|integer|exists:channels,id',
            'password' => 'sometimes|required|string|min:8|confirmed|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/',
            'is_active' => 'sometimes|required|integer',
        ];
    }
}
