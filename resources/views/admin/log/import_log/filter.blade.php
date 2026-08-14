<div class="table-responsive">
    <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100" data-sticky-column="2">
        <thead>
        <tr>
            <th class="w-40px">#</th>
            <th>{{ __('app.module') }}</th>
            <th>{{ __('app.quantity') }}</th>
            <th>{{ __('app.user') }}</th>
            <th>{!! renderThSort(__('app.created_at'), 'import_excel.created_at', $orderByName, $orderByType) !!}</th>
            <th class="min-w-100px">{{ __('app.action') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($importLogs as $i => $importLog)
            @php
                $value = isset($importLog->value) ? json_decode($importLog->value, true) : [];
                $count = count($value);
                $doneCount = $value ? count(array_filter($value, fn($item) => $item['status'] === true)) : 0;
            @endphp
            <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td class="text-center text-nowrap">{{ __('app.'.$importLog->module) }}</td>
                <td class="text-center text-nowrap">
                    <span class="text-success">{{ $doneCount }}</span>/{{ $count }}
                </td>
                <td class="text-nowrap">{{ $importLog->user->name }}</td>
                <td class="text-center text-nowrap">{{ $importLog->created_at->format('d-m-Y H:i:s') }}</td>
                <td class="text-center">
                    <a href="javascript:void(0)" class="btn btn-sm btn-primary mb-1" title="{{ __('app.show') }}"
                       onclick="commonShowModal('{{ route('admin.import_log.show', ['import_log' => $importLog->id]) }}', '#common-modal-lg')">
                        <i class="fa fa-eye"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{!! renderPagination($importLogs) !!}

{!! renderSearchEmpty($importLogs) !!}
