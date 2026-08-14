<div class="table-responsive">
    <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100" data-sticky-column="2">
        <thead>
        <tr>
            <th class="w-40px">#</th>
            <th>{!! renderThSort(__('app.code'), 'ethnicities.code', $orderByName, $orderByType) !!}</th>
            <th>{!! renderThSort(__('app.name'), 'ethnicities.name', $orderByName, $orderByType) !!}</th>
            <th>{{ __('app.description') }}</th>
            <th class="min-w-100px">{{ __('app.action') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($ethnicities as $i => $ethnicity)
            <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td class="text-nowrap text-center">{{ $ethnicity->code }}</td>
                <td class="text-nowrap text-center">{{ $ethnicity->name }}</td>
                <td>{{ $ethnicity->description }}</td>
                <td class="text-center">
                    <a href="javascript:void(0)" class="btn btn-sm btn-success mb-1" title="{{ __('app.edit') }}"
                       onclick="commonShowModal('{{ route('admin.ethnicity.edit', ['ethnicity' => $ethnicity->id]) }}')">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                       onclick="commonDelete('{{ route('admin.ethnicity.destroy', ['ethnicity' => $ethnicity->id]) }}')">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{!! renderPagination($ethnicities) !!}

{!! renderSearchEmpty($ethnicities) !!}
