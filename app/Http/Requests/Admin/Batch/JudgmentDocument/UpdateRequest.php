<?php

namespace App\Http\Requests\Admin\Batch\JudgmentDocument;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'file_path' => 'sometimes|required|string',
            'judgment_id' => 'sometimes|required|integer|exists:judgments,id',
            'description' => 'sometimes|nullable|string',
            'language_id' => 'sometimes|nullable|array',
            'language_id.*' => 'sometimes|nullable|integer|exists:languages,id',
            'physical_condition_id' => 'sometimes|nullable|integer|exists:configs,id',
            'document_type_id' => 'sometimes|nullable|integer|exists:configs,id',
            'agency_name' => 'sometimes|nullable|string',
            'note' => 'sometimes|nullable|string',
            'document_number' => 'sometimes|nullable|string',
            'document_notation' => 'sometimes|required|string',
            'issue_date' => 'sometimes|nullable|date_format:d/m/Y',
            'document_genre_id' => 'sometimes|required|integer|exists:configs,id',
            'content_summary' => 'sometimes|nullable|string',
            'signer' => 'sometimes|nullable|string',
            'confidentiality_level_id' => 'sometimes|nullable|integer|exists:configs,id',
            'copy_type_id' => 'sometimes|nullable|integer|exists:configs,id',
            'keywords' => 'sometimes|nullable|string',
            'topic' => 'sometimes|nullable|string',
            'original_doc_location' => 'sometimes|nullable|string',
            'data_entry_by' => 'sometimes|nullable|string',
            'doc_order_in_dossier' => 'sometimes|nullable|string',
            'page_number' => 'sometimes|nullable|string',
            'info_code' => 'sometimes|nullable|string',
            'usage_mode_id' => 'sometimes|nullable|integer|exists:configs,id',
            'handwritten_notes' => 'sometimes|nullable|string',
            'renamed_file_path' => 'sometimes|nullable|string',
        ];
    }
}
