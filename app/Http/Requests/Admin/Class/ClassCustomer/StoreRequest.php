<?php

namespace App\Http\Requests\Admin\Class\ClassCustomer;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'class_id' => 'required|integer|exists:classes,id',
            'customer_id' => 'required|integer|exists:customers,id|unique_composite:class_customers,class_id,customer_id',
            'status_id' => 'required|integer|exists:statuses,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date'
        ];
    }
}
