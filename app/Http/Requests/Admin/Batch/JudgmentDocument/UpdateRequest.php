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
            'physical_condition_id' => 'sometimes|required|integer|exists:configs,id',
            'document_type_id' => 'sometimes|required|integer|exists:configs,id',
            'agency_id' => 'sometimes|nullable|integer|exists:agencies,id',
            'old_agency_id' => 'sometimes|nullable|integer|exists:old_agencies,id',
            'note' => 'sometimes|required|string',
            'document_number' => 'sometimes|required|string',
            'document_notation' => 'sometimes|required|string',
            'issue_date' => 'sometimes|nullable|date_format:d/m/Y',
            'document_genre_id' => 'sometimes|required|integer|exists:configs,id',
            'content_summary' => 'sometimes|required|string',
            'signer' => 'sometimes|required|string',
            'confidentiality_level_id' => 'sometimes|required|integer|exists:configs,id',
            'copy_type_id' => 'sometimes|required|integer|exists:configs,id',
            'keywords' => 'sometimes|required|string',
            'topic' => 'sometimes|required|string',
            'original_doc_location' => 'sometimes|required|string',
            'data_entry_by' => 'sometimes|required|string',
            'doc_order_in_dossier' => 'sometimes|required|string',
            'page_number' => 'sometimes|required|string',
            'info_code' => 'sometimes|required|string',
            'usage_mode_id' => 'sometimes|required|integer|exists:configs,id',
            'handwritten_notes' => 'sometimes|required|string',
            'renamed_file_path' => 'sometimes|required|string',
        ];
    }
}
