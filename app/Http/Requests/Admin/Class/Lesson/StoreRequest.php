<?php

namespace App\Http\Requests\Admin\Class\Lesson;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'class_id' => 'required|integer|exists:classes,id',
            'type_id' => 'required|integer|exists:types,id',
            'status_id' => 'required|integer|exists:statuses,id',
            'name' => 'required|string|max:255',
            'content' => 'nullable|string',
            'value' => 'nullable|string',
            'date' => 'required|date|unique:holidays,date',
            'start_time' => 'required|date_format:H:i|unique_datetime:lessons,date,start_time,end_time,class_id',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'center_id' => 'nullable|integer|exists:centers,id',
            'classroom_id' => 'nullable|integer|exists:classrooms,id|unique_datetime:lessons,date,start_time,end_time,classroom_id',
        ];
    }
}
