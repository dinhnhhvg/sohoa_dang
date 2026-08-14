<?php

namespace App\Http\Requests\Admin\Course\ChapterVideo;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'type_id' => 'sometimes|required|integer|exists:types,id',
            'video_id' => 'sometimes|required_without:src|nullable|integer|exists:videos,id',
            'src' => 'sometimes|required_without:video_id|nullable|string',
            'duration' => 'sometimes|required|integer',
            'max_view' => 'sometimes|nullable|integer',
            'is_free' => 'sometimes|sometimes|required|integer',
            'content' => 'sometimes|nullable|string',
            'order_number' => 'sometimes|required|integer'
        ];
    }
}
