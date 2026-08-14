<div class="table-responsive">
    <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100" data-sticky-column="2">
        <thead>
        <tr>
            <th class="w-40px">#</th>
            <th>{!! renderThSort(__('app.code'), 'wards.code', $orderByName, $orderByType) !!}</th>
            <th>{!! renderThSort(__('app.prefix'), 'wards.prefix', $orderByName, $orderByType) !!}</th>
            <th>{!! renderThSort(__('app.name'), 'wards.name', $orderByName, $orderByType) !!}</th>
            <th>{{ __('app.province') }}</th>
            <th class="min-w-100px">{{ __('app.action') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($wards as $i => $ward)
            <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td class="text-center text-nowrap">{{ $ward->code }}</td>
                <td class="text-center text-nowrap">{{ $ward->prefix }}</td>
                <td class="text-center text-nowrap">{{ $ward->name }}</td>
                <td class="text-center text-nowrap">{{ $ward->province->full_name }}</td>
                <td class="text-center">
                    <a href="javascript:void(0)" class="btn btn-sm btn-success mb-1" title="{{ __('app.edit') }}"
                       onclick="commonShowModal('{{ route('admin.ward.edit', ['ward' => $ward->id]) }}')">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                       onclick="commonDelete('{{ route('admin.ward.destroy', ['ward' => $ward->id]) }}')">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{!! renderPagination($wards) !!}

{!! renderSearchEmpty($wards) !!}
