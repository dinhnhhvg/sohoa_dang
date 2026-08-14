<?php

namespace App\Http\Requests\Admin\Center\Classroom;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'center_id' => 'sometimes|required|integer|exists:centers,id',
            'name' => 'sometimes|required|string|max:255',
            'locale' => 'sometimes|required|string|max:255',
            'capacity' => 'sometimes|required|integer'
        ];
    }
}
