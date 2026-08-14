<?php

namespace App\Http\Requests\Admin\Course\Chapter;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'course_id' => 'required|integer|exists:courses,id',
            'name' => 'required|string|max:255',
            'content' => 'nullable|string',
            'order_number' => 'required|integer',
            'topic_ids' => 'nullable|array',
            'topic_ids.*' => 'integer|exists:topics,id',
        ];
    }
}
