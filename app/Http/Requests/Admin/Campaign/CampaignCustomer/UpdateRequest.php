<?php

namespace App\Http\Requests\Admin\Campaign\CampaignCustomer;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'status_id' => 'sometimes|int|exists:statuses,id',
            'channel_id' => 'sometimes|nullable|integer|exists:channels,id',
            'content' => 'sometimes|nullable|string',
            'note' => 'sometimes|nullable|string',
            'schedule_at' => 'sometimes|nullable|date_format:d-m-Y H:i',
        ];
    }
}
