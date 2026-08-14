<?php

namespace App\Http\Requests\Admin\Course\Course;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'code' => 'required|string|max:255|unique:courses,code',
            'name' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'image' => 'required|string|file_exist|file_type_valid:image',
            'duration' => 'required|string|max:255',
            'introduce' => 'nullable|string',
            'content' => 'nullable|string',
            'description' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'category_id' => 'nullable|integer|exists:categories,id',
            'level_id' => 'nullable|integer|exists:levels,id',
            'order_number' => 'required|integer',
            'topic_id' => 'nullable|array',
            'topic_id.*' => 'integer|exists:topics,id',
        ];
    }
}
