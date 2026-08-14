<?php

namespace App\Http\Requests\Admin\Course\ChapterDocument;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'chapter_id' => 'required|integer|exists:chapters,id',
            'name' => 'required|string|max:255',
            'type_id' => 'required|integer|exists:types,id',
            'file_path' => 'required|string|file_exist',
            'is_free' => 'required|integer',
            'content' => 'nullable|string',
            'order_number' => 'required|integer'
        ];
    }
}
