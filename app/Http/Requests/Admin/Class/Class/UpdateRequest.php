<?php

namespace App\Http\Requests\Admin\Class\Class;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'course_type_id' => 'sometimes|required|integer|exists:course_types,id',
            'code' => 'sometimes|required|string|max:255|unique:classes,code,'.$this->route('class'),
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string',
            'status_id' => 'sometimes|required|integer|exists:statuses,id',
            'start_date' => 'sometimes|nullable|date',
            'end_date' => 'sometimes|nullable|date|after:start_date',
            'center_id' => 'sometimes|nullable|integer|exists:centers,id',
            'classroom_id' => 'sometimes|nullable|integer|exists:classrooms,id',
            'schedule' => 'sometimes|nullable|string',
            'capacity' => 'sometimes|nullable|integer'
        ];
    }
}
