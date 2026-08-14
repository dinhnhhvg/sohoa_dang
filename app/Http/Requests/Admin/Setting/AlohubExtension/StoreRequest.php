<?php

namespace App\Http\Requests\Admin\Setting\AlohubExtension;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'extension' => 'required|string|max:255|unique:alohub_extensions,extension',
            'password' => 'nullable|string',
            'user_id' => 'nullable|array',
            'user_id.*' => 'nullable|integer|exists:users,id',
        ];
    }
}
