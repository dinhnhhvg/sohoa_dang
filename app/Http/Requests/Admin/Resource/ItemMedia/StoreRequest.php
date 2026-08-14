<?php

namespace App\Http\Requests\Admin\Resource\ItemMedia;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'item_type' => 'required|string',
            'item_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'type' => 'required|string',
            'file_path' => 'required|string|file_exist',
            'order_number' => 'required|integer'
        ];
    }
}
