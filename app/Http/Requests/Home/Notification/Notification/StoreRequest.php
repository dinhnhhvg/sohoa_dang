<?php

namespace App\Http\Requests\Home\Notification\Notification;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'is_group' => 'nullable|boolean',
            'member_id' => 'required|array'
        ];
    }
}
