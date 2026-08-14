<?php

namespace App\Http\Requests\Admin\Class\LessonSchedule;

use App\Http\Requests\BaseRequest;

class StoreLessonRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'ids' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ];
    }
}
