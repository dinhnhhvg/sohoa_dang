<?php

namespace App\Http\Requests\Admin\Class\ClassCustomer;

use App\Http\Requests\BaseRequest;

class UpdateManyRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'ids' => 'required|string',
            'status_id' => 'sometimes|required|integer|exists:statuses,id',
            'end_date' => 'sometimes|required|date',
        ];
    }
}
