<?php

namespace App\Http\Requests\Admin\Order\Coupon;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'type' => 'sometimes|required|in:amount,percent',
            'value' => 'sometimes|required|string',
            'limit' => 'sometimes|nullable|integer',
            'min_amount' => 'sometimes|nullable|string',
            'max_amount' => 'sometimes|nullable|string|gt:min_amount',
            'start_date' => 'sometimes|nullable|date',
            'end_date' => 'sometimes|nullable|date|after:start_date',
            'is_active' => 'sometimes|required|integer',
        ];
    }
}
