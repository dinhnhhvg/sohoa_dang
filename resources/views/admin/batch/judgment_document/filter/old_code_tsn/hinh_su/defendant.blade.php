<td>{{ $defendant->content_summary }}</td>
<td class="text-nowrap">{{ $defendant->has_appeal ? __('app.yes') : __('app.no') }}</td>

<td class="text-nowrap">{{ $defendant->full_name }}</td>
<td class="text-nowrap">{{ $defendant->alias_name }}</td>
<td class="text-nowrap">{{ renderCodeName($defendant?->identityDocument) }}</td>
<td class="text-nowrap">{{ $defendant->identity_number }}</td>
<td class="text-nowrap">{{ $defendant->identity_created_date?->format('d/m/Y') }}</td>
<td class="text-nowrap">{{ $defendant->identity_expiry_date?->format('d/m/Y') }}</td>
<td>{!! renderGender($defendant->gender) !!}</td>
<td class="text-nowrap">{{ $defendant->birth_date?->format('d/m/Y') }}</td>
<td class="text-nowrap">{{ renderManyName($defendant?->nationalities, true) }}</td>
<td class="text-nowrap">{{ $defendant->ethnicity?->name }}</td>
<td class="text-nowrap">{{ $defendant->religion?->name }}</td>

<td class="text-nowrap">{{ renderCodeName($defendant?->permanentOldProvince) }}</td>
<td class="text-nowrap">{{ renderCodeName($defendant?->permanentOldDistrict) }}</td>
<td class="text-nowrap">{{ renderCodeName($defendant?->permanentOldWard) }}</td>
<td>{{ $defendant->permanent_address }}</td>

<td class="text-nowrap">{{ renderCodeName($defendant?->hometownOldProvince) }}</td>
<td class="text-nowrap">{{ renderCodeName($defendant?->hometownOldDistrict) }}</td>
<td class="text-nowrap">{{ renderCodeName($defendant?->hometownOldWard) }}</td>
<td>{{ $defendant->hometown_address }}</td>

<td>{{ renderCodeName($defendant->foreignIdentityDocument) }}</td>
<td>{{ $defendant->foreign_identity_number }}</td>

<td class="text-nowrap">{{ $defendant->father_name }}</td>
<td class="text-nowrap">{{ $defendant->mother_name }}</td>
<td class="text-nowrap">{{ $defendant->spouse_name }}</td>

<td>{{ $defendant->organization_type }}</td>
<td>{{ $defendant->organization_name }}</td>
<td>{{ $defendant->organization_business_registration_code }}</td>
<td>{{ $defendant->organization_tax_code }}</td>
<td class="text-nowrap">{{ renderCodeName($defendant?->organizationProvince) }}</td>
<td class="text-nowrap">{{ renderCodeName($defendant?->organizationDistrict) }}</td>
<td class="text-nowrap">{{ renderCodeName($defendant?->organizationWard) }}</td>
<td>{{ $defendant->organization_address }}</td>

<td>{{ $defendant->crime_name }}</td>
<td>{{ $defendant->legal_basis }}</td>
<td>{{ renderManyName($defendant?->mainPenalties, true) }}</td>
<td>{{ $defendant->main_penalty_value }}</td>
<td>{{ $defendant->suspended_sentence }}</td>

<td>{{ numberFormat($defendant->first_instance_court_fee) }}</td>
<td>{{ numberFormat($defendant->appellate_court_fee) }}</td>
<td>{{ numberFormat($defendant->civil_court_fee) }}</td>
<td>{{ numberFormat($defendant->total_court_fee) }}</td>
<td>{{ $defendant->court_fee_status }}</td>

<td>{{ renderManyName($defendant?->additionalPenalties, true) }}</td>
<td>{{ $defendant->additional_penalty_value }}</td>

<td>{{ $defendant->prohibited_position }}</td>
<td>{{ $defendant->prohibition_duration }}</td>
<td class="text-nowrap">{{ $defendant->prohibition_start_date?->format('d/m/Y') }}</td>

<td>{{ renderManyName($defendant?->judicialMeasureNames) }}</td>
<td>{{ $defendant->judicialMeasureIssuer?->name }}</td>
<td class="text-nowrap">{{ $defendant->judicial_measure_start_date?->format('d/m/Y') }}</td>
<td class="text-nowrap">{{ $defendant->judicial_measure_end_date?->format('d/m/Y') }}</td>

<td>{{ $defendant->civil_obligation }}</td>
<td>{{ $defendant->criminal_record_status }}</td>
<td>{{ $defendant->criminal_record_description }}</td>
<td>
    @if($jd?->judgment?->batch?->end_date?->gte(now()->startOfDay()))
        @if((session('role_code') === 'admin' || in_array(session('user_id'), [$jd->judgment->entry_id, $jd->judgment->checker_id])) && in_array($jd->judgment->status->id, [env('APP_JUDGMENT_STATUS_NEW_ID'), env('APP_JUDGMENT_STATUS_ENTRIED_ID')]))
            @if($defendant?->id)
                <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }} {{ __('app.defendant') }}"
                   onclick="commonDelete('{{ route('admin.defendant.destroy', ['defendant' => $defendant->id]) }}')">
                    <i class="fa-solid fa-trash-can"></i>
                </a>
            @endif
        @endif
    @endif
</td>
