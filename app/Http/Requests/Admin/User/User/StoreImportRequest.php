<?php

namespace App\Http\Requests\Admin\User\User;

use App\Http\Requests\BaseRequest;

class StoreImportRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'file_path' => 'required|string|file_exist|file_type_valid:excel',
            'role_id' => 'required|integer|exists:roles,id',
        ];
    }
}
