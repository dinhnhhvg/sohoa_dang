<?php

namespace App\Http\Requests\Admin\Batch\Defendant;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'judgment_id' => 'required|integer|exists:judgments,id',
            'judgment_document_id' => 'required|integer|exists:judgment_documents,id',
            'defendant_id' => 'required',

            'has_appeal' => 'sometimes|required|boolean',

            'full_name' => 'required|string|max:255',
            'alias_name' => 'nullable|string|max:255',

            'identity_document_id' => 'nullable|integer|exists:configs,id',
            'identity_number' => 'required|string|max:255',
            'identity_created_date' => 'nullable|date_format:d/m/Y',
            'identity_expiry_date' => 'nullable|string|max:255',

            'gender' => 'nullable|in:male,female',
            'birth_date' => 'nullable|date_format:d/m/Y',

            'nationality_id' => 'nullable|array',
            'nationality_id.*' => 'nullable|integer|exists:nationalities,id',
            'ethnicity_id' => 'nullable|integer|exists:ethnicities,id',
            'religion_id' => 'nullable|integer|exists:religions,id',

            'permanent_province_id' => 'nullable|integer|exists:provinces,id',
            'permanent_ward_id' => 'nullable|integer|exists:wards,id',
            'permanent_old_province_id' => 'nullable|integer|exists:old_provinces,id',
            'permanent_old_district_id' => 'nullable|integer|exists:old_districts,id',
            'permanent_old_ward_id' => 'nullable|integer|exists:old_wards,id',
            'permanent_address' => 'nullable|string|max:255',

            'hometown_province_id' => 'nullable|integer|exists:provinces,id',
            'hometown_ward_id' => 'nullable|integer|exists:wards,id',
            'hometown_old_province_id' => 'nullable|integer|exists:old_provinces,id',
            'hometown_old_district_id' => 'nullable|integer|exists:old_districts,id',
            'hometown_old_ward_id' => 'nullable|integer|exists:old_wards,id',
            'hometown_address' => 'nullable|string|max:255',

            'foreign_identity_document_id' => 'nullable|integer|exists:configs,id',
            'foreign_identity_number' => 'nullable|string|max:255',

            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'spouse_name' => 'nullable|string|max:255',

            'organization_type' => 'nullable|in:Cơ quan,Tổ chức',
            'organization_name' => 'nullable|string|max:255',
            'organization_tax_code' => 'nullable|string|max:255',
            'organization_business_registration_code' => 'nullable|string|max:255',

            'organization_province_id' => 'nullable|integer|exists:provinces,id',
            'organization_ward_id' => 'nullable|integer|exists:wards,id',
            'organization_old_province_id' => 'nullable|integer|exists:old_provinces,id',
            'organization_old_district_id' => 'nullable|integer|exists:old_districts,id',
            'organization_old_ward_id' => 'nullable|integer|exists:old_wards,id',
            'organization_address' => 'nullable|string|max:255',

            'crime_name' => 'nullable|string|max:255',
            'legal_basis' => 'nullable|string',

            'main_penalty_id' => 'nullable|array',
            'main_penalty_id.*' => 'nullable|integer|exists:configs,id',
            'main_penalty_value' => 'nullable|string',

            'suspended_sentence' => 'nullable|in:Không,Có',

            'first_instance_court_fee' => 'nullable|string|max:255',
            'appellate_court_fee' => 'nullable|string|max:255',
            'civil_court_fee' => 'nullable|string|max:255',
            'court_fee_status' => 'nullable|in:Không,Có',

            'additional_penalty_id' => 'nullable|array',
            'additional_penalty_id.*' => 'nullable|integer|exists:configs,id',
            'additional_penalty_value' => 'nullable|string|max:255',

            'prohibited_position' => 'nullable|string|max:255',
            'prohibition_duration' => 'nullable|string|max:255',
            'prohibition_start_date' => 'nullable|date_format:d/m/Y',

            'judicial_measure_name_id' => 'nullable|array',
            'judicial_measure_name_id.*' => 'nullable|integer|exists:configs,id',
            'judicial_measure_issuer_id' => 'nullable|integer|exists:configs,id',

            'judicial_measure_start_date' => 'nullable|date_format:d/m/Y',
            'judicial_measure_end_date' => 'nullable|date_format:d/m/Y',

            'civil_obligation' => 'nullable|string',

            'criminal_record_status' => 'nullable',
            'criminal_record_description' => 'nullable|string',

            'legal_relationship_id' => 'nullable|array',
            'legal_relationship_id.*' => 'nullable|integer|exists:configs,id',
            'litigation_status_id' => 'nullable|integer|exists:configs,id',

            'marital_status_id' => 'sometimes|required|integer|exists:configs,id',
            'marriage_certificate_number' => 'nullable|string|max:255',

            'execution_status' => 'nullable|string|max:255',
            'execution_date' => 'nullable|date_format:d/m/Y',
        ];
    }
}
