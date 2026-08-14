<?php

namespace App\Http\Requests\Admin\Course\CourseType;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'course_id' => 'required|integer|exists:courses,id',
            'type_id' => 'required|integer|exists:types,id|unique_composite:course_types,course_id,type_id',
            'price' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
            'lesson_count' => 'nullable|integer',
        ];
    }
}
