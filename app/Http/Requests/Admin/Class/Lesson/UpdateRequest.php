<?php

namespace App\Http\Requests\Admin\Class\Lesson;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'class_id' => 'sometimes|required|integer|exists:classes,id',
            'type_id' => 'sometimes|required|integer|exists:types,id',
            'status_id' => 'sometimes|required|exists:statuses,id',
            'name' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|nullable|string',
            'value' => 'sometimes|nullable|string',
            'date' => 'sometimes|required|date',
            'start_time' => 'sometimes|required|date_format:H:i|unique_datetime:lessons,date,start_time,end_time,class_id,'.$this->route('lesson'),
            'end_time' => 'sometimes|required|date_format:H:i|after:start_time',
            'center_id' => 'sometimes|nullable|integer|exists:centers,id',
            'classroom_id' => 'sometimes|nullable|integer|exists:classrooms,id|unique_datetime:lessons,date,start_time,end_time,classroom_id,'.$this->route('lesson'),
        ];
    }
}
