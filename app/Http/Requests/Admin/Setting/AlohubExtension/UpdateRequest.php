<?php

namespace App\Http\Requests\Admin\Setting\AlohubExtension;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'extension' => 'required|string|max:255|unique:alohub_extensions,extension,'.$this->route('alohub_extension'),
            'password' => 'sometimes|nullable|string',
            'user_id' => 'sometimes|nullable|array',
            'user_id.*' => 'sometimes|nullable|integer|exists:users,id',
        ];
    }
}
