<?php

namespace App\Http\Requests\Admin\Batch\Batch;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'old_agency_id' => 'required|integer|exists:old_agencies,id',
            'status_id' => 'required|integer|exists:statuses,id',
            'year' => 'required|integer',
            'type_id' => 'required|integer|exists:types,id',
            'name' => 'required|string|max:255',
            'folder_path' => 'required|string',
            'start_date' => 'required|date_format:d/m/Y',
            'end_date' => 'required|date_format:d/m/Y',
            'description' => 'nullable|string',
            'entry_id' => 'required|array',
            'entry_id.*' => 'required|exists:users,id',
            'checker_id' => 'required|array',
            'checker_id.*' => 'required|exists:users,id',
        ];
    }
}
