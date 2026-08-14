<?php

namespace App\Http\Requests\Admin\Class\LessonSchedule;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'class_id' => 'required|integer|exists:classes,id',
            'type_id' => 'required|integer|exists:types,id',
            'name' => 'required|string|max:255',
            'day_of_week' => 'required|integer',
            'content' => 'nullable|string',
            'value' => 'nullable|string',
            'start_time' => 'required|date_format:H:i|unique_datetime:lesson_schedules,day_of_week,start_time,end_time,class_id',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'center_id' => 'nullable|integer|exists:centers,id',
            'classroom_id' => 'nullable|integer|exists:classrooms,id',
        ];
    }
}
