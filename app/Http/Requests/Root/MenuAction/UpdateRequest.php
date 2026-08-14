<?php

namespace App\Http\Requests\Root\MenuAction;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'is_active' => 'sometimes|required|integer',
        ];
    }
}
