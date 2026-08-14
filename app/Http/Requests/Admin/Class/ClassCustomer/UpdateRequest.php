<?php

namespace App\Http\Requests\Admin\Class\ClassCustomer;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'status_id' => 'sometimes|required|integer|exists:statuses,id'
        ];
    }
}
