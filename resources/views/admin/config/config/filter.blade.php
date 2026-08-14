<div class="table-responsive">
    @php $prefix = str_replace('-', '_', request()->segment(2)); @endphp
    <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100" data-sticky-column="2">
        <thead>
        <tr>
            <th class="w-40px">
                <input type="checkbox" class="form-check-input" onchange="checkAll(this)">
            </th>
            <th class="w-40px">#</th>
            <th>{!! renderThSort(__('app.code'), 'configs.code', $orderByName, $orderByType) !!}</th>
            <th>{!! renderThSort(__('app.name'), 'configs.name', $orderByName, $orderByType) !!}</th>
            <th>{{ __('app.description') }}</th>
            <th class="min-w-100px">{{ __('app.action') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($configs as $i => $config)
            <tr>
                <td class="text-center">
                    <input type="checkbox" class="form-check-input id" name="id[]" value="{{ $config->id }}">
                </td>
                <td class="text-center">{{ $i + 1 }}</td>
                <td class="text-nowrap text-center">{{ $config->code }}</td>
                <td class="text-nowrap text-center">{{ $config->name }}</td>
                <td>{{ $config->description }}</td>
                <td class="text-center">
                    <a href="javascript:void(0)" class="btn btn-sm btn-success mb-1" title="{{ __('app.edit') }}"
                       onclick="commonShowModal('{{ route('admin.'.$prefix.'.edit', ['config' => $config->id]) }}')">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                       onclick="commonDelete('{{ route('admin.'.$prefix.'.destroy', ['config' => $config->id]) }}')">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{!! renderPagination($configs) !!}

{!! renderSearchEmpty($configs) !!}
