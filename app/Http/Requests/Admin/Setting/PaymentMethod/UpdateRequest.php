<?php

namespace App\Http\Requests\Admin\Setting\PaymentMethod;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string'
        ];
    }
}
