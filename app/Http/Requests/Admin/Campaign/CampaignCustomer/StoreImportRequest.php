<?php

namespace App\Http\Requests\Admin\Campaign\CampaignCustomer;

use App\Http\Requests\BaseRequest;

class StoreImportRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'file_path' => 'required|string|file_exist|file_type_valid:excel',
            'sale_id' => 'required|array',
            'sale_id.*' => 'required'
        ];
    }
}
