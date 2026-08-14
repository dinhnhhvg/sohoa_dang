@if(!(isset($view_type) && $view_type === 'dashboard'))
    <div class="table-responsive batch-filter-table">
        <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100" data-sticky-column="3">
            <thead>
            <tr>
                <th class="w-40px">#</th>
                <th>{!! renderThSort(__('app.name'), 'name', $orderByName, $orderByType) !!}</th>
                <th class="min-w-100px">{{ __('app.action') }}</th>
                <th>{{ __('app.old_agency') }}</th>
                <th>{{ __('app.status') }}</th>
                <th>{{ __('app.type') }}</th>
                <th>{{ __('app.folder_path') }}</th>
                <th>{!! renderThSort(__('app.time'), 'end_date', $orderByName, $orderByType) !!}</th>
                <th>{!! renderThSort(__('app.judgment'), 'judgments_count', $orderByName, $orderByType) !!}</th>
                <th>{{ __('app.file') }}</th>
                <th>{{ __('app.sheet') }}</th>
                <th>{{ __('app.page') }}</th>
                <th>{{ __('app.size') }}</th>
                <th>{{ __('app.entry') }}</th>
                <th>{{ __('app.check') }}</th>
                <th>{{ __('app.batch_entry') }}</th>
                <th>{{ __('app.batch_checker') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($batches as $i => $batch)
                <tr style="background-color: {{ $batch->status->bg_color }}">
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td class="text-nowrap">
                        <a href="{{ route('admin.batch.detail', ['batch' => $batch->id]) }}">
                            {{ $batch->name }}
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="javascript:void(0)" class="btn btn-sm btn-success mb-1" title="{{ __('app.edit') }}"
                           onclick="commonShowModal('{{ route('admin.batch.edit', ['batch' => $batch->id]) }}', '#common-modal-lg')">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="{{ route('admin.batch.detail', ['batch' => $batch->id]) }}" class="btn btn-sm btn-primary mb-1" title="{{ __('app.detail') }}">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                           onclick="commonDelete('{{ route('admin.batch.destroy', ['batch' => $batch->id]) }}')">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                        @if(session('role_code') == 'admin')
                            <a href="{{ route('admin.batch.export_detail', ['batch' => $batch->id]) }}" class="btn btn-sm btn-primary mb-1" title="{{ __('app.export') }}">
                                <i class="fa fa-download"></i>
                            </a>
                        @endif
                    </td>
                    <td class="text-nowrap">{{ $batch->oldAgency->code }}-{{ $batch->oldAgency->name }}</td>
                    <td class="text-center">
                        <span class="badge bg-primary">{{ __('app.'.$batch?->status?->name) }}</span>
                    </td>
                    <td class="text-center">
                        <span class="badge bg-primary">{{ __('app.'.$batch?->type?->name) }}</span>
                    </td>
                    <td class="text-nowrap">{{ renderStandardPath($batch->folder_path) }}</td>
                    <td class="text-center text-nowrap">{{ $batch->start_date?->format('d/m/Y') }} - {{ $batch->end_date?->format('d/m/Y') }}</td>
                    <td class="text-center">{{ numberFormat($batch->judgments_count ?? 0) }}</td>
                    <td class="text-center">{{ numberFormat($batch->judgment_documents_count ?? 0) }}</td>
                    <td class="text-center">{{ numberFormat($batch->sheets_sum ?? 0) }}</td>
                    <td class="text-center">{{ numberFormat($batch->pages_sum ?? 0) }}</td>
                    <td class="text-center">{{ formatSizeUnit($batch->file_size_sum ?? 0) }}</td>
                    <td class="text-center">{{ $batch->entry_rate ?? 0 }}%</td>
                    <td class="text-center">{{ $batch->check_rate ?? 0 }}%</td>
                    <td>
                        @foreach($batch->entries as $ie => $entry)
                            <p class="mb-0 text-nowrap"><span class="badge bg-danger">{{ $ie + 1 }}</span> {{ $entry->name }}</p>
                        @endforeach
                    </td>
                    <td>
                        @foreach($batch->checkers as $ic => $checker)
                            <p class="mb-0 text-nowrap"><span class="badge bg-danger">{{ $ic + 1 }}</span> {{ $checker->name }}</p>
                        @endforeach
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="table-responsive batch-filter-table">
        <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100" data-sticky-column="2">
            <thead>
            <tr>
                <th class="w-40px">#</th>
                <th>{!! renderThSort(__('app.name'), 'name', $orderByName, $orderByType) !!}</th>
                <th>{!! renderThSort(__('app.time'), 'end_date', $orderByName, $orderByType) !!}</th>
                <th>{!! renderThSort(__('app.judgment'), 'judgments_count', $orderByName, $orderByType) !!}</th>
                <th>{{ __('app.entry') }}</th>
                <th>{{ __('app.check') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($batches as $i => $batch)
                <tr style="background-color: {{ $batch->status->bg_color }}">
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td class="text-nowrap">
                        <a href="{{ route('admin.batch.detail', ['batch' => $batch->id]) }}">
                            {{ $batch->name }}
                        </a>
                    </td>
                    <td class="text-center text-nowrap">{{ $batch->start_date?->format('d/m/Y') }} - {{ $batch->end_date?->format('d/m/Y') }}</td>
                    <td class="text-center">{{ numberFormat($batch->judgments_count ?? 0) }}</td>
                    <td class="text-center">{{ $batch->entry_rate ?? 0 }}%</td>
                    <td class="text-center">{{ $batch->check_rate ?? 0 }}%</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endif

{!! renderPagination($batches) !!}

{!! renderSearchEmpty($batches) !!}

<script>
    select2Render('.batch-filter-table');
</script>
