<?php

namespace App\Http\Requests\Admin\Class\LessonSchedule;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'class_id' => 'sometimes|required|integer|exists:classes,id',
            'type_id' => 'sometimes|required|integer|exists:types,id',
            'name' => 'sometimes|required|string|max:255',
            'day_of_week' => 'sometimes|required|integer',
            'content' => 'sometimes|nullable|string',
            'value' => 'sometimes|nullable|string',
            'start_time' => 'sometimes|required|date_format:H:i|unique_datetime:lesson_schedules,day_of_week,start_time,end_time,class_id,'.$this->route('lesson_schedule'),
            'end_time' => 'sometimes|required|date_format:H:i|after:start_time',
            'center_id' => 'sometimes|nullable|integer|exists:centers,id',
            'classroom_id' => 'sometimes|nullable|integer|exists:classrooms,id'
        ];
    }
}
