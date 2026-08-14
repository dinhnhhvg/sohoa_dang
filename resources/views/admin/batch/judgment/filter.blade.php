<div class="table-responsive judgment-filter-table">
    <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100" data-sticky-column="3">
        <thead>
        <tr>
            <th class="w-40px">
                <input type="checkbox" class="form-check-input" onchange="checkAll(this)">
            </th>
            <th class="w-40px">#</th>
            <th class="min-w-100px">{{ __('app.action') }}</th>
            <th>{{ __('app.batch') }}</th>
            <th>{!! renderThSort(__('app.folder_path'), 'folder_path', $orderByName, $orderByType) !!}</th>
            <th>{{ __('app.status') }}</th>
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
            <th>{{ __('app.attribute') }}</th>
            <th>{{ __('app.rate') }} {{ __('app.entry') }} {{ __('app.true') }}</th>
            <th class="min-w-220px">{{ __('app.description') }}</th>
            <th>{{ __('app.language') }}</th>
            <th>{{ __('app.physical_condition') }}</th>
            <th>{{ __('app.batch_entry') }}</th>
            <th>{{ __('app.batch_checker') }}</th>
            <th>{!! renderThSort(__('app.created_at'), 'created_at', $orderByName, $orderByType) !!}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($judgments as $i => $judgment)
            <tr style="background-color: {{ $judgment?->status?->bg_color }}">
                <td class="text-center">
                    <input type="checkbox" class="form-check-input id" name="id[]" value="{{ $judgment->id }}">
                </td>
                <td class="text-center">{{ $i + 1 }}</td>
                <td class="text-center">
                    <a href="javascript:void(0)" class="btn btn-sm btn-success mb-1" title="{{ __('app.edit') }}"
                       onclick="commonShowModal('{{ route('admin.judgment.edit', ['judgment' => $judgment->id]) }}', '#common-modal-xl')">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="javascript:void(0)" onclick="commonShowModal('{{ route('admin.judgment_document.filter_modal', ['judgment_id' => $judgment->id]) }}', '#common-modal-fullscreen')"
                       class="btn btn-sm btn-primary mb-1" title="{{ __('app.detail') }}">
                        <i class="fa fa-eye"></i>
                    </a>
                </td>
                <td>{{ $judgment->batch->name }}</td>
                <td class="text-center text-nowrap">
                    <a href="javascript:void(0)" onclick="commonShowModal('{{ route('admin.judgment_document.filter_modal', ['judgment_id' => $judgment->id]) }}', '#common-modal-fullscreen')">
                        {{ getEndName($judgment->folder_path) }}
                    </a>
                </td>
                <td class="text-center">
                    <span class="badge bg-primary">{{ __('app.'.$judgment->status->name) }}</span>
                </td>
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
                <td class="text-center">{{ numberFormat($judgment->sheets_sum) }}</td>
                <td class="text-center">{{ numberFormat($judgment->pages_sum) }}</td>
                <td class="text-center">
                    @if($judgment->status_id == env('APP_JUDGMENT_STATUS_CHECKED_ID'))
                        {{ $judgment->entry_number - $judgment->check_number }}/{{ $judgment->entry_number }}
                    @else
                        {{ $judgment->entry_number }}
                    @endif
                </td>
                <td class="text-center">
                    @if($judgment->status_id == env('APP_JUDGMENT_STATUS_CHECKED_ID'))
                        {{ 100 - $judgment->check_number_rate }}%
                    @endif
                </td>
                <td>{{ $judgment->description }}</td>
                <td class="text-center text-nowrap">{{ renderManyName($judgment?->languages, true) }}</td>
                <td class="text-center text-nowrap">{{ renderCodeName($judgment?->physicalCondition) }}</td>
                <td class="text-nowrap">{{ $judgment->entry?->name }}</td>
                <td class="text-nowrap">{{ $judgment->checker?->name }}</td>
                <td class="text-nowrap">{{ $judgment?->created_at?->format('d-m-Y H:i') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{!! renderPagination($judgments) !!}

{!! renderSearchEmpty($judgments) !!}

<script>
    select2Render('.judgment-filter-table');
</script>
