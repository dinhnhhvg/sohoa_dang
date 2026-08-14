<?php

namespace App\Http\Requests\Admin\Order\Payment;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string',
            'payment_method_id' => 'sometimes|required|integer|exists:payment_methods,id',
            'amount' => 'sometimes|required|string',
            'expiry_date' => 'sometimes|required|date',
            'content' => 'sometimes|nullable|string',

            'status_id' => 'sometimes|required|integer|exists:statuses,id',
            'payment_date' => 'sometimes|required|date_format:Y-m-d H:i',
            'image' => 'sometimes|required|string|file_exist|file_type_valid:image',
            'note' => 'sometimes|nullable|string',
        ];
    }
}
