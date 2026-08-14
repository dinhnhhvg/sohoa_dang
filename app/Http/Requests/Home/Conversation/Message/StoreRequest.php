<?php

namespace App\Http\Requests\Home\Conversation\Message;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'conversation_id' => 'required|integer|exists:conversations,id',
            'content' => 'required|string',
        ];
    }
}
