<?php

namespace App\Http\Requests\Admin\Setting\Holiday;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'date' => 'sometimes|required|date|unique_date:holidays,date,'.$this->route('holiday'),
            'description' => 'sometimes|nullable|string'
        ];
    }
}
