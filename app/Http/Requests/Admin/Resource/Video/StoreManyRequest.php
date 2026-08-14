<?php

namespace App\Http\Requests\Admin\Resource\Video;

use App\Http\Requests\BaseRequest;

class StoreManyRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'video' => 'required|array',
            'video.*' => 'required|file|mimetypes:video/mp4,video/quicktime,video/webm|max:5120',
        ];
    }
}
