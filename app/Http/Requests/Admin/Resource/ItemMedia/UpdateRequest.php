<?php

namespace App\Http\Requests\Admin\Resource\ItemMedia;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'title' => 'sometimes|required|string|max:255',
            'type' => 'sometimes|required|string',
            'file_path' => 'sometimes|required|string|file_exist',
            'order_number' => 'sometimes|required|integer'
        ];
    }
}
