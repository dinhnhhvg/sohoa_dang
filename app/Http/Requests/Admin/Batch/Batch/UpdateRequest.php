<?php

namespace App\Http\Requests\Admin\Batch\Batch;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'old_agency_id' => 'sometimes|required|integer|exists:old_agencies,id',
            'status_id' => 'sometimes|required|integer|exists:statuses,id',
            'year' => 'sometimes|required|integer',
            'type_id' => 'sometimes|required|integer|exists:types,id',
            'name' => 'sometimes|required|string|max:255',
            'folder_path' => 'sometimes|required|string',
            'start_date' => 'sometimes|required|date_format:d/m/Y',
            'end_date' => 'sometimes|required|date_format:d/m/Y',
            'description' => 'sometimes|nullable|string',
            'entry_id' => 'sometimes|required|array',
            'entry_id.*' => 'sometimes|required|exists:users,id',
            'checker_id' => 'sometimes|required|array',
            'checker_id.*' => 'sometimes|required|exists:users,id',
        ];
    }
}
