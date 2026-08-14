<div class="table-responsive">
    <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100" data-sticky-column="2">
        <thead>
        <tr>
            <th class="w-40px">#</th>
            <th>{!! renderThSort(__('app.code'), 'agencies.code', $orderByName, $orderByType) !!}</th>
            <th>{!! renderThSort(__('app.name'), 'agencies.name', $orderByName, $orderByType) !!}</th>
            <th>{!! renderThSort(__('app.email'), 'agencies.email', $orderByName, $orderByType) !!}</th>
            <th>{!! renderThSort(__('app.phone'), 'agencies.phone', $orderByName, $orderByType) !!}</th>
            <th class="min-w-220px">{{ __('app.description') }}</th>
            <th class="min-w-220px">{{ __('app.address') }}</th>
            <th class="min-w-100px">{{ __('app.action') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($agencies as $i => $agency)
            <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td class="text-center text-nowrap">{{ $agency->code }}</td>
                <td class="text-center text-nowrap">{{ $agency->name }}</td>
                <td class="text-center text-nowrap">{{ $agency->email }}</td>
                <td class="text-center text-nowrap">{{ $agency->phone }}</td>
                <td>{{ $agency->description }}</td>
                <td>{{ formatAddress($agency) }}</td>
                <td class="text-center">
                    <a href="javascript:void(0)" class="btn btn-sm btn-primary mb-1" title="{{ __('app.edit') }}"
                       onclick="commonShowModal('{{ route('admin.agency.edit', ['agency' => $agency->id]) }}', '#common-modal-lg')">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                       onclick="commonDelete('{{ route('admin.agency.destroy', ['agency' => $agency->id]) }}')">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{!! renderPagination($agencies) !!}

{!! renderSearchEmpty($agencies) !!}
