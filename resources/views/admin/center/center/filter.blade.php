<div class="table-responsive">
    <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100" data-sticky-column="2">
        <thead>
        <tr>
            <th class="w-40px">#</th>
            <th>{!! renderThSort(__('app.code'), 'centers.code', $orderByName, $orderByType) !!}</th>
            <th>{!! renderThSort(__('app.name'), 'centers.name', $orderByName, $orderByType) !!}</th>
            <th>{!! renderThSort(__('app.classroom'), 'classrooms_count', $orderByName, $orderByType) !!}</th>
            <th class="min-w-220px">{{ __('app.description') }}</th>
            <th class="min-w-220px">{{ __('app.address') }}</th>
            <th>{{ __('app.is_active') }}</th>
            <th class="min-w-100px">{{ __('app.action') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($centers as $i => $center)
            <tr class="{{ $center->is_active ? '' : 'bg-inactive' }}">
                <td class="text-center">{{ $i + 1 }}</td>
                <td class="text-center text-nowrap">{{ $center->code }}</td>
                <td class="text-center text-nowrap">{{ $center->name }}</td>
                <td class="text-center">{{ $center->classrooms_count }}</td>
                <td>{{ $center->description }}</td>
                <td>{{ formatAddress($center) }}</td>
                <td class="text-center">{!! renderIsActive($center->is_active) !!}</td>
                <td class="text-center">
                    <a href="javascript:void(0)" class="btn btn-sm btn-success mb-1" title="{{ __('app.edit') }}"
                       onclick="commonShowModal('{{ route('admin.center.edit', ['center' => $center->id]) }}', '#common-modal-lg')">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.toggle_active') }}"
                       onclick="commonToggleActive('{{ route('admin.center.update', ['center' => $center->id]) }}', {{ $center->is_active }})">
                        <i class="fa-solid fa-power-off"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                       onclick="commonDelete('{{ route('admin.center.destroy', ['center' => $center->id]) }}')">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{!! renderPagination($centers) !!}

{!! renderSearchEmpty($centers) !!}
