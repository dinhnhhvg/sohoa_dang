<?php

namespace App\Http\Requests\Admin\Order\Order;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'channel_id' => 'sometimes|nullable|integer|exists:channels,id',
            'note' => 'sometimes|nullable|string',
            'status_id' => 'sometimes|integer|exists:statuses,id',

            'content' => 'sometimes|nullable|string',
            'coupon_code' => 'sometimes|nullable|string|exists:coupons,code',
            'discount_amount' => 'sometimes|nullable|string',
        ];
    }
}
