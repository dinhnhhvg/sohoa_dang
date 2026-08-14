<?php

namespace App\Http\Requests\Admin\Class\LessonCustomer;

use App\Http\Requests\BaseRequest;

class UpdateManyRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'ids' => 'required|string',
            'status_ids' => 'nullable|string',
        ];
    }
}
