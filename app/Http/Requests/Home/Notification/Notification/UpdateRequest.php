<?php

namespace App\Http\Requests\Home\Notification\Notification;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'avatar' => 'sometimes|required|string|file_exist|file_type_valid:image',
        ];
    }
}
