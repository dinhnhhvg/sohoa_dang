<?php

namespace App\Http\Requests\Admin\Course\Chapter;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'course_id' => 'sometimes|required|integer|exists:courses,id',
            'name' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|nullable|string',
            'order_number' => 'sometimes|required|integer',
            'topic_ids' => 'sometimes|nullable|array',
            'topic_ids.*' => 'sometimes|integer|exists:topics,id',
        ];
    }
}
