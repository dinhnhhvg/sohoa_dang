<?php

namespace App\Http\Requests\Admin\Course\ChapterDocument;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'type_id' => 'sometimes|required|integer|exists:types,id',
            'file_path' => 'sometimes|required|string|file_exist',
            'is_free' => 'sometimes|required|integer',
            'content' => 'sometimes|nullable|string',
            'order_number' => 'sometimes|required|integer'
        ];
    }
}
