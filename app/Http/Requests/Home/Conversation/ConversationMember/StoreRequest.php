<?php

namespace App\Http\Requests\Home\Conversation\ConversationMember;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'member_id' => 'required'
        ];
    }
}
