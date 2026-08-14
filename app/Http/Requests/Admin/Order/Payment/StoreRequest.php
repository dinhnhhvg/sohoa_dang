<?php

namespace App\Http\Requests\Admin\Order\Payment;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'amount' => 'required|string',
            'expiry_date' => 'required|date',
            'content' => 'sometimes|nullable|string'
        ];
    }
}
