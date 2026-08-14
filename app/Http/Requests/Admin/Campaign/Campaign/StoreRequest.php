<?php

namespace App\Http\Requests\Admin\Campaign\Campaign;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'code' => 'required|string|max:255|unique:campaigns,code',
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'description' => 'nullable|string',
            'script' => 'nullable|string',
            'sale_id' => 'required|array',
            'sale_id.*' => 'required|integer|exists:users,id',
        ];
    }
}
