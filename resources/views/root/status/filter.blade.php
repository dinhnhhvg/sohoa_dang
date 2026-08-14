<div class="table-responsive">
    <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100" data-sticky-column="2">
        <thead>
        <tr>
            <th class="w-40px">#</th>
            <th>{{ __('app.code') }}</th>
            <th>{{ __('app.name') }}</th>
            <th>{{ __('app.module') }}</th>
            <th>{{ __('app.bg_color') }}</th>
            <th>{{ __('app.action') }}</th>
            <th class="min-w-220px">{{ __('app.description') }}</th>
            <th>{{ __('app.is_active') }}</th>
            <th class="min-w-100px">{{ __('app.action') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($statuses as $i => $status)
            <tr class="{{ $status->is_active ? '' : 'bg-inactive' }}">
                <td class="text-center">{{ $i + 1 }}</td>
                <td class="text-center text-nowrap">{{ $status->code }}</td>
                <td class="text-center text-nowrap">{{ $status->name }}</td>
                <td class="text-center text-nowrap">{{ $status->module }}</td>
                <td class="text-center text-nowrap">
                    <input type="color" class="form-control" value="{{ $status->bg_color }}" disabled>
                </td>
                <td>{{ $status->actions }}</td>
                <td>{{ $status->description }}</td>
                <td class="text-center">{!! renderIsActive($status->is_active) !!}</td>
                <td class="text-center">
                    <a href="javascript:void(0)" class="btn btn-sm btn-success mb-1" title="{{ __('app.edit') }}"
                       onclick="commonShowModal('{{ route('root.status.edit', ['status' => $status->id]) }}')">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.toggle_active') }}"
                       onclick="commonToggleActive('{{ route('root.status.update', ['status' => $status->id]) }}', {{ $status->is_active }})">
                        <i class="fa-solid fa-power-off"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                       onclick="commonDelete('{{ route('root.status.destroy', ['status' => $status->id]) }}')">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{!! renderPagination($statuses) !!}

{!! renderSearchEmpty($statuses) !!}
