<td>{{ $defendant?->content_summary }}</td>
<td class="text-nowrap">{{ $defendant->has_appeal ? __('app.yes') : __('app.no') }}</td>

<td>{{ numberFormat($defendant?->total_court_fee) }}</td>
<td>{{ $defendant?->court_fee_status }}</td>
<td class="text-nowrap">{{ renderManyName($defendant?->legalRelationships) }}</td>
<td class="text-nowrap">{{ $defendant?->litigationStatus?->name }}</td>

<td class="text-nowrap">{{ $defendant?->full_name }}</td>
<td class="text-nowrap">{{ $defendant?->alias_name }}</td>
<td class="text-nowrap">{{ renderCodeName($defendant?->identityDocument) }}</td>
<td class="text-nowrap">{{ $defendant?->identity_number }}</td>
<td class="text-nowrap">{{ $defendant?->identity_created_date?->format('d/m/Y') }}</td>
<td class="text-nowrap">{{ $defendant?->identity_expiry_date?->format('d/m/Y') }}</td>
<td>{!! renderGender($defendant?->gender) !!}</td>
<td class="text-nowrap">{{ $defendant?->birth_date?->format('d/m/Y') }}</td>
<td class="text-nowrap">{{ renderManyName($defendant?->nationalities, true) }}</td>
<td class="text-nowrap">{{ $defendant?->ethnicity?->name }}</td>
<td class="text-nowrap">{{ $defendant?->religion?->name }}</td>

<td class="text-nowrap">{{ renderCodeName($defendant?->permanentOldProvince) }}</td>
<td class="text-nowrap">{{ renderCodeName($defendant?->permanentOldDistrict) }}</td>
<td class="text-nowrap">{{ renderCodeName($defendant?->permanentOldWard) }}</td>
<td>{{ $defendant?->permanent_address }}</td>

<td class="text-nowrap">{{ renderCodeName($defendant?->hometownOldProvince) }}</td>
<td class="text-nowrap">{{ renderCodeName($defendant?->hometownOldDistrict) }}</td>
<td class="text-nowrap">{{ renderCodeName($defendant?->hometownOldWard) }}</td>
<td>{{ $defendant?->hometown_address }}</td>

<td>{{ renderCodeName($defendant?->foreignIdentityDocument) }}</td>
<td>{{ $defendant?->foreign_identity_number }}</td>

<td class="text-nowrap">{{ $defendant?->father_name }}</td>
<td class="text-nowrap">{{ $defendant?->mother_name }}</td>
<td class="text-nowrap">{{ $defendant?->spouse_name }}</td>

<td>{{ $defendant?->organization_type }}</td>
<td>{{ $defendant?->organization_name }}</td>
<td>{{ $defendant?->organization_business_registration_code }}</td>
<td>{{ $defendant?->organization_tax_code }}</td>
<td class="text-nowrap">{{ renderCodeName($defendant?->organizationProvince) }}</td>
<td class="text-nowrap">{{ renderCodeName($defendant?->organizationDistrict) }}</td>
<td class="text-nowrap">{{ renderCodeName($defendant?->organizationWard) }}</td>
<td>{{ $defendant?->organization_address }}</td>

<td>
    @if($jd?->judgment?->batch?->end_date?->gte(now()->startOfDay()))
        @if((session('role_code') === 'admin' || in_array(session('user_id'), [$jd->judgment->entry_id, $jd->judgment->checker_id])) && in_array($jd->judgment->status->id, [env('APP_JUDGMENT_STATUS_NEW_ID'), env('APP_JUDGMENT_STATUS_ENTRIED_ID')]))
            @if($defendant?->id)
                <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }} {{ __('app.defendant') }}"
                   onclick="commonDelete('{{ route('admin.defendant.destroy', ['defendant' => $defendant?->id]) }}')">
                    <i class="fa-solid fa-trash-can"></i>
                </a>
            @endif
        @endif
    @endif
</td>
