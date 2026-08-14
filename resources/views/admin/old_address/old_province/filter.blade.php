<div class="table-responsive">
    <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100" data-sticky-column="2">
        <thead>
        <tr>
            <th class="w-40px">#</th>
            <th>{!! renderThSort(__('app.code'), 'old_provinces.code', $orderByName, $orderByType) !!}</th>
            <th>{!! renderThSort(__('app.prefix'), 'old_provinces.prefix', $orderByName, $orderByType) !!}</th>
            <th>{!! renderThSort(__('app.name'), 'old_provinces.name', $orderByName, $orderByType) !!}</th>
            <th>{!! renderThSort(__('app.old_district'), 'old_districts_count', $orderByName, $orderByType) !!}</th>
            <th class="min-w-100px">{{ __('app.action') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($oldProvinces as $i => $province)
            <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td class="text-center text-nowrap">{{ $province->code }}</td>
                <td class="text-center text-nowrap">{{ $province->prefix }}</td>
                <td class="text-center text-nowrap">{{ $province->name }}</td>
                <td class="text-center text-nowrap">{{ $province->old_districts_count }}</td>
                <td class="text-center">
                    <a href="javascript:void(0)" class="btn btn-sm btn-success mb-1" title="{{ __('app.edit') }}"
                       onclick="commonShowModal('{{ route('admin.old_province.edit', ['old_province' => $province->id]) }}')">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                       onclick="commonDelete('{{ route('admin.old_province.destroy', ['old_province' => $province->id]) }}')">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{!! renderPagination($oldProvinces) !!}

{!! renderSearchEmpty($oldProvinces) !!}
