<?php

namespace App\Http\Requests\Root\Action;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255|unique:actions,name,'.$this->route('action'),
            'code' => 'sometimes|required|string|max:255',
        ];
    }
}
