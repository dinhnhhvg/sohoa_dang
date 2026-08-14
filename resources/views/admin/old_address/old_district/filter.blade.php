<div class="table-responsive">
    <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100" data-sticky-column="2">
        <thead>
        <tr>
            <th class="w-40px">#</th>
            <th>{!! renderThSort(__('app.code'), 'old_districts.code', $orderByName, $orderByType) !!}</th>
            <th>{!! renderThSort(__('app.prefix'), 'old_districts.prefix', $orderByName, $orderByType) !!}</th>
            <th>{!! renderThSort(__('app.name'), 'old_districts.name', $orderByName, $orderByType) !!}</th>
            <th>{{ __('app.old_province') }}</th>
            <th>{!! renderThSort(__('app.old_ward'), 'old_wards_count', $orderByName, $orderByType) !!}</th>
            <th class="min-w-100px">{{ __('app.action') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($oldDistricts as $i => $district)
            <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td class="text-center text-nowrap">{{ $district->code }}</td>
                <td class="text-center text-nowrap">{{ $district->prefix }}</td>
                <td class="text-center text-nowrap">{{ $district->name }}</td>
                <td class="text-center text-nowrap">{{ $district->oldProvince->full_name }}</td>
                <td class="text-center text-nowrap">{{ $district->old_wards_count }}</td>
                <td class="text-center">
                    <a href="javascript:void(0)" class="btn btn-sm btn-success mb-1" title="{{ __('app.edit') }}"
                       onclick="commonShowModal('{{ route('admin.old_district.edit', ['old_district' => $district->id]) }}')">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                       onclick="commonDelete('{{ route('admin.old_district.destroy', ['old_district' => $district->id]) }}')">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{!! renderPagination($oldDistricts) !!}

{!! renderSearchEmpty($oldDistricts) !!}
