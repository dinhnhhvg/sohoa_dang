<?php

namespace App\Http\Requests\Admin\Setting\Holiday;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'date' => 'required|date|unique_date:holidays,date',
            'description' => 'nullable|string'
        ];
    }
}
