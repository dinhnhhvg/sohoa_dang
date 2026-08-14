<?php

namespace App\Http\Requests\Admin\Campaign\Campaign;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'code' => 'sometimes|required|string|max:255|unique:campaigns,code,'.$this->route('campaign'),
            'name' => 'sometimes|required|string|max:255',
            'start_date' => 'sometimes|required|date',
            'end_date' => 'sometimes|required|date|after:start_date',
            'description' => 'sometimes|nullable|string',
            'script' => 'sometimes|nullable|string',
            'sale_id' => 'sometimes|required|array',
            'sale_id.*' => 'sometimes|required|integer|exists:users,id',
            'is_active' => 'sometimes|required|integer',
        ];
    }
}
