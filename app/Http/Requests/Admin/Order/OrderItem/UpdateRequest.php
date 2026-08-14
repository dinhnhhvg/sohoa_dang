<?php

namespace App\Http\Requests\Admin\Order\OrderItem;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'price' => 'sometimes|required|string',
            'content' => 'sometimes|nullable|string'
        ];
    }
}
