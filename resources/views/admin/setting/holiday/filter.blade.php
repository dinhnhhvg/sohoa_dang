<div class="table-responsive">
    <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100" data-sticky-column="2">
        <thead>
        <tr>
            <th class="w-40px">#</th>
            <th>{!! renderThSort(__('app.name'), 'holidays.name', $orderByName, $orderByType) !!}</th>
            <th>{!! renderThSort(__('app.date'), 'holidays.date', $orderByName, $orderByType) !!}</th>
            <th>{{ __('app.description') }}</th>
            <th class="min-w-100px">{{ __('app.action') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($holidays as $i => $holiday)
            <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td class="text-nowrap">{{ $holiday->name }}</td>
                <td class="text-center text-nowrap">{{ $holiday->date?->format('d-m-Y') }}</td>
                <td>{{ $holiday->description }}</td>
                <td class="text-center">
                    <a href="javascript:void(0)" class="btn btn-sm btn-success mb-1" title="{{ __('app.edit') }}"
                       onclick="commonShowModal('{{ route('admin.holiday.edit', ['holiday' => $holiday->id]) }}')">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                       onclick="commonDelete('{{ route('admin.holiday.destroy', ['holiday' => $holiday->id]) }}')">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{!! renderPagination($holidays) !!}

{!! renderSearchEmpty($holidays) !!}
