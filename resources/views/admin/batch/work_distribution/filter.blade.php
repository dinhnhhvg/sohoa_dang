<div class="table-responsive batch-filter-table">
    <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100" data-sticky-column="2">
        <thead>
        <tr>
            <th class="w-40px">#</th>
            <th>{!! renderThSort(__('app.name'), 'name', $orderByName, $orderByType) !!}</th>
            <th>{{ __('app.old_agency') }}</th>
            <th>{{ __('app.status') }}</th>
            <th>{{ __('app.folder_path') }}</th>
            <th>{{ __('app.time') }}</th>
            <th>{{ __('app.waiting_for_distribution') }}</th>
            <th>{{ __('app.batch_entry') }}</th>
            <th>{{ __('app.batch_checker') }}</th>
            <th class="min-w-100px">{{ __('app.action') }}</th>
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
                <td class="text-nowrap">{{ $batch->oldAgency->code }}-{{ $batch->oldAgency->name }}</td>
                <td class="text-center">
                    <span class="badge bg-primary">{{ __('app.'.$batch->status->name) }}</span>
                </td>
                <td>{{ $batch->folder_path }}</td>
                <td class="text-center text-nowrap">{{ $batch->start_date?->format('d-m-Y') }} - {{ $batch->end_date?->format('d-m-Y') }}</td>
                <td class="text-center text-nowrap">{{ $batch->folders_waiting_count }} - {{ $batch->files_waiting_count }}</td>
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
                <td class="text-center">
                    <a href="javascript:void(0)" class="btn btn-sm btn-success mb-1" title="{{ __('app.work_distribution') }}"
                       onclick="commonHandleAction(this, '{{ route('admin.work_distribution.handle', ['work_distribution' => $batch->id]) }}', '{{ __('app.message.are_you_work_distribution') }}')">
                        <i class="fas fa-tasks"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{!! renderPagination($batches) !!}

{!! renderSearchEmpty($batches) !!}

<script>
    select2Render('.batch-filter-table');
</script>
