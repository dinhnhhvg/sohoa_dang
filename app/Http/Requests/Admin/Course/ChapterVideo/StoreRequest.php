<?php

namespace App\Http\Requests\Admin\Course\ChapterVideo;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'chapter_id' => 'required|integer|exists:chapters,id',
            'name' => 'required|string|max:255',
            'type_id' => 'required|integer|exists:types,id',
            'video_id' => 'required_without:src|nullable|integer|exists:videos,id',
            'src' => 'required_without:video_id|nullable|string',
            'duration' => 'required|integer',
            'max_view' => 'nullable|integer',
            'is_free' => 'required|integer',
            'content' => 'nullable|string',
            'order_number' => 'required|integer'
        ];
    }
}
