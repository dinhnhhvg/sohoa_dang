<?php

namespace App\Http\Requests\Admin\Center\Classroom;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'center_id' => 'required|integer|exists:centers,id',
            'name' => 'required|string|max:255',
            'locale' => 'required|string|max:255',
            'capacity' => 'required|integer'
        ];
    }
}
