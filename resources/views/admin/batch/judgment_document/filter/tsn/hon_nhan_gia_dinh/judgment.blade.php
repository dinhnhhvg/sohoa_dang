<td>{{ $i }}</td>
<td class="text-center">
    @if($ide == 0)
        @if($jd?->judgment?->batch?->end_date?->gte(now()->startOfDay()))
            @if((session('role_code') === 'admin' || session('user_id') == $jd->judgment->entry_id) && $jd->judgment->status->id == env('APP_JUDGMENT_STATUS_NEW_ID'))
                <a href="javascript:void(0)" class="btn btn-sm btn-success mb-1" title="{{ __('app.entry') }}"
                   onclick="commonShowModal('{{ route('admin.judgment_document.edit', ['judgment_document' => $jd->id, 'action_type' => 'entry']) }}', '#sub-modal-fullscreen')">
                    <i class="fa fa-pen"></i>
                </a>
            @endif
            @if((session('role_code') === 'admin' || session('user_id') == $jd->judgment->checker_id) && $jd->judgment->status->id == env('APP_JUDGMENT_STATUS_ENTRIED_ID'))
                <a href="javascript:void(0)" class="btn btn-sm btn-primary mb-1" title="{{ __('app.check') }}"
                   onclick="commonShowModal('{{ route('admin.judgment_document.edit', ['judgment_document' => $jd->id, 'action_type' => 'check']) }}', '#sub-modal-fullscreen')">
                    <i class="fas fa-check"></i>
                </a>
            @endif
        @endif
        <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.show_note') }}"
           onclick="commonShowModal('{{ route('admin.judgment_document.show_note', ['judgment_document' => $jd->id]) }}', '#common-modal-lg')">
            <i class="fas fa-heart"></i>
        </a>
    @endif
</td>
<td>{{ $jd->note }}</td>

<td class="text-nowrap">{{ renderCodeName($jd->judgment?->language) }}</td>
<td class="text-nowrap">{{ $judgmentDocuments->sum('sheets_count') }}</td>
<td class="text-nowrap">{{ renderCodeName($jd->judgment?->physicalCondition) }}</td>
<td>{{ $jd->judgment?->description }}</td>

<td class="text-nowrap">{{ $jd->judgmentType?->name }}</td>
<td class="text-nowrap">{{ $jd->documentType?->name }}</td>
<td class="text-nowrap">{{ renderManyName($jd->languages, true) }}</td>
<td class="text-nowrap">{{ $jd->sheets_count }}</td>
<td class="text-nowrap">{{ renderCodeName($jd->physicalCondition) }}</td>
<td>{{ $jd->description }}</td>
<td class="text-nowrap text-start">{{ basename($jd->file_path) }}</td>

<td class="text-nowrap">{{ $jd->normalized_number }}</td>
<td class="text-nowrap">{{ $jd->original_symbol }}</td>
<td class="text-nowrap">{{ $jd->issued_date?->format('d/m/Y') }}</td>

<td>{{ renderCodeName(in_array($jd->judgment_type_id, [4]) ? $jd?->judgment?->batch?->oldAgency : $jd->oldAgency) }}</td>
<td>{{ renderCodeName($jd->police) }}</td>
<td>{{ renderCodeName($jd->procuracy) }}</td>
<td>{{ in_array($jd->judgment_type_id, [4]) ? '' : $jd->issuer_name }}</td>

<td class="text-nowrap">{{ $jd->effective_date?->format('d/m/Y') }}</td>

<td>{{ $jd?->documentRelations?->first()?->normalized_number }}</td>
<td>{{ $jd?->documentRelations?->first()?->issued_date?->format('d/m/Y') }}</td>
<td>{{ renderCodeName($jd?->documentRelations?->first()?->oldAgency) }}</td>
