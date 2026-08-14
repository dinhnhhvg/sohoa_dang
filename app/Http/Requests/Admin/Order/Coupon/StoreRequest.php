<?php

namespace App\Http\Requests\Admin\Order\Coupon;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'type' => 'required|in:amount,percent',
            'value' => 'required|string',
            'limit' => 'nullable|integer',
            'quantity' => 'required|integer',
            'min_amount' => 'nullable|string',
            'max_amount' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date'
        ];
    }
}
