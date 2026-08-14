<?php

namespace App\Http\Requests\Admin\Batch\Judgment;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'folder_path' => 'sometimes|required|string',
            'batch_id' => 'sometimes|required|integer|exists:batches,id',
            'status_id' => 'sometimes|required|integer|exists:statuses,id',
            'is_after_merge' => 'sometimes|required|bool',
            'font_id' => 'sometimes|required|integer|exists:configs,id',
            'tenure_period_id' => 'sometimes|required|integer|exists:configs,id',
            'table_of_contents_number' => 'sometimes|required|string',
            'box_number' => 'sometimes|required|string',
            'dossier_number' => 'sometimes|required|string',
            'retention_period_id' => 'sometimes|required|integer|exists:configs,id',
            'dossier_title' => 'sometimes|required|string',
            'start_date' => 'sometimes|required|date_format:d/m/Y',
            'end_date' => 'sometimes|required|date_format:d/m/Y',
            'description' => 'sometimes|nullable|string',
            'language_id' => 'sometimes|nullable|array',
            'language_id.*' => 'sometimes|nullable|integer|exists:languages,id',
            'physical_condition_id' => 'sometimes|required|integer|exists:configs,id',
            'entry_id' => 'sometimes|required|integer|exists:users,id',
            'checker_id' => 'sometimes|required|integer|exists:users,id',
            'note' => 'sometimes|required|string',
        ];
    }
}
