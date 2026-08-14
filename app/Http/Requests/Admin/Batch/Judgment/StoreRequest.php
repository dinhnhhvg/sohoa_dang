<?php

namespace App\Http\Requests\Admin\Batch\Judgment;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'folder_path' => 'required|string',
            'batch_id' => 'required|integer|exists:batches,id',
            'is_after_merge' => 'required|bool',
            'original_record_code' => 'required|string',
            'description' => 'nullable|string',
            'language_id' => 'nullable|array',
            'language_id.*' => 'nullable|integer|exists:languages,id',
            'physical_condition_id' => 'required|integer|exists:configs,id',
            'entry_id' => 'required|integer|exists:users,id',
            'checker_id' => 'required|integer|exists:users,id',
        ];
    }
}
