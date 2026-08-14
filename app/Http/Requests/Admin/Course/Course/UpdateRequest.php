<?php

namespace App\Http\Requests\Admin\Course\Course;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'code' => 'sometimes|required|string|max:255|unique:courses,code,'.$this->route('course'),
            'name' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|string|max:255',
            'image' => 'sometimes|required|string|file_exist|file_type_valid:image',
            'duration' => 'sometimes|required|string|max:255',
            'introduce' => 'sometimes|nullable|string',
            'content' => 'sometimes|nullable|string',
            'description' => 'sometimes|nullable|string',
            'meta_description' => 'sometimes|nullable|string',
            'category_id' => 'sometimes|nullable|integer|exists:categories,id',
            'level_id' => 'sometimes|nullable|integer|exists:levels,id',
            'order_number' => 'sometimes|required|integer',
            'topic_id' => 'sometimes|nullable|array',
            'topic_id.*' => 'sometimes|integer|exists:topics,id',
            'is_active' => 'sometimes|required|integer'
        ];
    }
}
