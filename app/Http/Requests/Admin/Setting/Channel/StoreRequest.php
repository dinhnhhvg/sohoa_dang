<?php

namespace App\Http\Requests\Admin\Setting\Channel;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ];
    }
}
