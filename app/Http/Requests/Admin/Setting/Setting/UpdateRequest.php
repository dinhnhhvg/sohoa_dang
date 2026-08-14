<?php

namespace App\Http\Requests\Admin\Setting\Setting;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string|max:255',
            'phone' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|max:255',
            'auth' => 'sometimes|required|string|max:255',
            'locale' => 'sometimes|required|string|max:255',

            'logo' => 'sometimes|required|string|file_exist|file_type_valid:image',
            'favicon' => 'sometimes|required|string|file_exist|file_type_valid:image',
            'default_avatar' => 'sometimes|required|string|file_exist|file_type_valid:image',
            'default_image' => 'sometimes|required|string|file_exist|file_type_valid:image',
            'default_empty' => 'sometimes|required|string|file_exist|file_type_valid:image',

            'default_user_id' => 'sometimes|required|integer|exists:users,id',
            'default_center_id' => 'sometimes|required|integer|exists:centers,id',
            'default_agency_id' => 'sometimes|required|integer|exists:agencies,id',
            'default_province_id' => 'sometimes|required|integer|exists:provinces,id',
            'default_per_page' => 'sometimes|required|integer',
            'default_password' => 'sometimes|required|string|min:8|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/'
        ];
    }
}
