<?php

namespace App\Http\Requests\Admin\Class\Class;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'course_type_id' => 'required|integer|exists:course_types,id',
            'code' => 'required|string|max:255|unique:classes,code',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status_id' => 'required|integer|exists:statuses,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date',
            'center_id' => 'nullable|integer|exists:centers,id',
            'classroom_id' => 'nullable|integer|exists:classrooms,id',
            'schedule' => 'nullable|string',
            'capacity' => 'nullable|integer'
        ];
    }
}
