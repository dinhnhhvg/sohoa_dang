<div class="table-responsive">
    <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100" data-sticky-column="2">
        <thead>
        <tr>
            <th class="w-40px">#</th>
            <th>{!! renderThSort(__('app.code'), 'old_wards.code', $orderByName, $orderByType) !!}</th>
            <th>{!! renderThSort(__('app.prefix'), 'old_wards.prefix', $orderByName, $orderByType) !!}</th>
            <th>{!! renderThSort(__('app.name'), 'old_wards.name', $orderByName, $orderByType) !!}</th>
            <th>{{ __('app.old_district') }}</th>
            <th>{{ __('app.old_province') }}</th>
            <th class="min-w-100px">{{ __('app.action') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($oldWards as $i => $ward)
            <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td class="text-center text-nowrap">{{ $ward->code }}</td>
                <td class="text-center text-nowrap">{{ $ward->prefix }}</td>
                <td class="text-center text-nowrap">{{ $ward->name }}</td>
                <td class="text-center text-nowrap">{{ $ward->oldDistrict->full_name }}</td>
                <td class="text-center text-nowrap">{{ $ward->oldDistrict->oldProvince->full_name }}</td>
                <td class="text-center">
                    <a href="javascript:void(0)" class="btn btn-sm btn-success mb-1" title="{{ __('app.edit') }}"
                       onclick="commonShowModal('{{ route('admin.old_ward.edit', ['old_ward' => $ward->id]) }}')">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                       onclick="commonDelete('{{ route('admin.old_ward.destroy', ['old_ward' => $ward->id]) }}')">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{!! renderPagination($oldWards) !!}

{!! renderSearchEmpty($oldWards) !!}
