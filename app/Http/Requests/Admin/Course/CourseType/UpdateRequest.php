<?php

namespace App\Http\Requests\Admin\Course\CourseType;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'course_id' => 'sometimes|required|integer|exists:courses,id',
            'type_id' => 'sometimes|required|integer|exists:types,id|unique_composite:course_types,course_id,type_id,'.$this->route('course_type'),
            'price' => 'sometimes|required|string|max:255',
            'duration' => 'sometimes|required|string|max:255',
            'lesson_count' => 'sometimes|nullable|integer',
        ];
    }
}
