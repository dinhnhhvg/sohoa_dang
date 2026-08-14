<div class="table-responsive">
    <table class="table table-list table-scroll table-bordered table-striped table-condensed no-nowrap w-100">
        <thead>
        <tr class="text-center">
            <th></th>
            <th colspan="14">THÔNG TIN HỒ SƠ (BÌA)</th>
            <th></th>
            <th colspan="26">THÔNG TIN VĂN BẢN</th>
        </tr>
        <tr class="text-center">
            <th></th>
            <th>1</th>
            @for($int = 2; $int <= 14; $int++)
                <th>{{ $int }}</th>
            @endfor
            <th></th>
            @for($int = 15; $int <= 40; $int++)
                <th>{{ $int }}</th>
            @endfor
        </tr>
        <tr class="text-nowrap">
            <th class="w-40px">
                <input type="checkbox" class="form-check-input" onchange="checkAll(this)">
            </th>
            <th class="w-40px">#</th>
            <th>{{ __('app.font_name') }}</th>
            <th>{{ __('app.font_number') }}</th>
            <th>{{ __('app.tenure_period') }}</th>
            <th>{{ __('app.table_of_contents_number') }}</th>
            <th>{{ __('app.box_number') }}</th>
            <th>{{ __('app.dossier_number') }}</th>
            <th>{{ __('app.retention_period') }}</th>
            <th>{{ __('app.dossier_title') }}</th>
            <th>{{ __('app.start_date') }}</th>
            <th>{{ __('app.end_date') }}</th>
            <th>{{ __('app.judgment_document') }}</th>
            <th>{{ __('app.sheet') }}</th>
            <th>{{ __('app.page') }}</th>

            <th class="min-w-100px">{{ __('app.action') }}</th>

            <th>{{ __('app.agency') }}</th>
            <th>{{ __('app.document_number') }}</th>
            <th>{{ __('app.document_notation') }}</th>
            <th>{{ __('app.issue_date') }}</th>
            <th>{{ __('app.document_genre') }}</th>
            <th>{{ __('app.document_genre_code') }}</th>
            <th class="min-w-220px">{{ __('app.content_summary') }}</th>
            <th>{{ __('app.signer') }}</th>
            <th>{{ __('app.confidentiality_level') }}</th>
            <th>{{ __('app.copy_type') }}</th>
            <th>{{ __('app.page') }}</th>
            <th>{{ __('app.keywords') }}</th>
            <th>{{ __('app.topic') }}</th>
            <th>{{ __('app.original_doc_location') }}</th>
            <th>{{ __('app.data_entry_by') }}</th>
            <th>{{ __('app.doc_order_in_dossier') }}</th>
            <th>{{ __('app.language') }}</th>
            <th class="min-w-220px">{{ __('app.note') }}</th>
            <th>{{ __('app.page_number') }}</th>
            <th>{{ __('app.info_code') }}</th>
            <th>{{ __('app.usage_mode') }}</th>
            <th>{{ __('app.handwritten_notes') }}</th>
            <th>{{ __('app.physical_condition') }}</th>
            <th>{{ __('app.document_type') }}</th>
            <th>{{ __('app.file_path') }}</th>
            <th>{{ __('app.renamed_file_path') }}</th>
        </tr>
        </thead>
        <tbody class="text-center">
        @foreach($judgmentDocuments as $i => $jd)
            <tr>
                <td class="text-center">
                    <input type="checkbox" class="form-check-input id" name="id[]" value="{{ $judgment->id }}">
                </td>
                <td class="text-center">{{ $i + 1 }}</td>
                <td class="text-center text-nowrap">{{ $judgment->font?->name }}</td>
                <td class="text-center text-nowrap">{{ $judgment->font?->code }}</td>
                <td class="text-center text-nowrap">{{ $judgment->tenurePeriod?->name }}</td>
                <td class="text-center text-nowrap">{{ $judgment->table_of_contents_number }}</td>
                <td class="text-center text-nowrap">{{ $judgment->box_number }}</td>
                <td class="text-center text-nowrap">{{ $judgment->dossier_number }}</td>
                <td class="text-center text-nowrap">{{ $judgment->retentionPeriod?->name }}</td>
                <td class="text-center text-nowrap">{{ $judgment->dossier_title }}</td>
                <td class="text-center text-nowrap">{{ $judgment->start_date?->format('d/m/Y') }}</td>
                <td class="text-center text-nowrap">{{ $judgment->end_date?->format('d/m/Y') }}</td>
                <td class="text-center text-nowrap">{{ $judgment->judgment_documents_count }}</td>
                <td class="text-center text-nowrap">{{ numberFormat($judgment->sheets_sum) }}</td>
                <td class="text-center text-nowrap">{{ numberFormat($judgment->pages_sum) }}</td>
                <td class="text-center">
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
                </td>
                <td class="text-nowrap">{{ renderCodeName($jd->oldAgency) }}</td>
                <td class="text-center">{{ $jd->document_number }}</td>
                <td class="text-center">{{ $jd->document_notation }}</td>
                <td class="text-center text-nowrap">{{ $jd->issue_date?->format('d-m-Y') }}</td>
                <td class="text-center">{{ $jd->documentGenre?->name }}</td>
                <td class="text-center">{{ $jd->documentGenre?->code }}</td>
                <td class="text-center">{{ $jd->content_summary }}</td>
                <td class="text-center">{{ $jd->signer }}</td>
                <td class="text-center">{{ $jd->confidentialityLevel?->name }}</td>
                <td class="text-center">{{ $jd->copyType?->name }}</td>
                <td class="text-center">{{ $jd->pages_count }}</td>
                <td class="text-center">{{ $jd->keywords }}</td>
                <td class="text-center">{{ $jd->topic }}</td>
                <td class="text-center">{{ $jd->original_doc_location }}</td>
                <td class="text-center">{{ $jd->data_entry_by }}</td>
                <td class="text-center">{{ $jd->doc_order_in_dossier }}</td>
                <td class="text-center text-nowrap">{{ renderManyName($jd?->languages, true) }}</td>
                <td class="text-center">{{ $jd->note }}</td>
                <td class="text-center">{{ $jd->page_number }}</td>
                <td class="text-center">{{ $jd->info_code }}</td>
                <td class="text-center">{{ $jd->usageMode?->name }}</td>
                <td class="text-center">{{ $jd->handwritten_notes }}</td>
                <td class="text-center">{{ $jd->physicalCondition?->name }}</td>
                <td class="text-center">{{ $jd->documentType?->name }}</td>
                <td class="text-nowrap text-start">{{ renderStandardPath($jd->file_path) }}</td>
                <td class="text-nowrap text-start">{{ renderStandardPath($jd->renamed_file_path) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{!! renderPagination($judgmentDocuments) !!}

{!! renderSearchEmpty($judgmentDocuments) !!}
