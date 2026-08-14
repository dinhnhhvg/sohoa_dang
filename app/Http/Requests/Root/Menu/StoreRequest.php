<?php

namespace App\Http\Requests\Root\Menu;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'parent_id' => 'sometimes|nullable|integer|exists:menus,id',
            'name' => 'required|string|max:255',
            'account' => 'required|string|exists:accounts,code',
            'router' => 'sometimes|nullable|string',
            'icon' => 'sometimes|nullable|string',
            'order_number' => 'required|integer',
            'is_menu' => 'required|integer',
        ];
    }
}
