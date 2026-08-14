<?php

namespace App\Http\Requests\Root\Menu;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'parent_id' => 'sometimes|nullable|integer|exists:menus,id',
            'name' => 'sometimes|required|string|max:255',
            'account' => 'sometimes|required|string|exists:accounts,code',
            'router' => 'sometimes|nullable|string',
            'icon' => 'sometimes|nullable|string',
            'order_number' => 'sometimes|required|integer',
            'is_active' => 'sometimes|required|integer',
            'is_menu' => 'sometimes|required|integer',
        ];
    }
}
