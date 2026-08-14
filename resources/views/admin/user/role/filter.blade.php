<div class="table-responsive">
    <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100" data-sticky-column="2">
        <thead>
        <tr>
            <th class="w-40px">#</th>
            <th>{!! renderThSort(__('app.code'), 'roles.code', $orderByName, $orderByType) !!}</th>
            <th>{!! renderThSort(__('app.name'), 'roles.name', $orderByName, $orderByType) !!}</th>
            <th>{{ __('app.description') }}</th>
            <th>{!! renderThSort(__('app.user'), 'users_count', $orderByName, $orderByType) !!}</th>
            <th>{{ __('app.is_active') }}</th>
            <th class="min-w-100px">{{ __('app.action') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($roles as $i => $role)
            <tr class="{{ $role->is_active ? '' : 'bg-inactive' }}">
                <td class="text-center">{{ $i + 1 }}</td>
                <td class="text-center text-nowrap">{{ $role->code }}</td>
                <td class="text-center text-nowrap">{{ $role->name }}</td>
                <td>{{ $role->description }}</td>
                <td class="text-center text-nowrap">{{ $role->users_count }}</td>
                <td class="text-center">{!! renderIsActive($role->is_active) !!}</td>
                <td class="text-center">
                    <a href="javascript:void(0)" class="btn btn-sm btn-success mb-1" title="{{ __('app.edit') }}"
                       onclick="commonShowModal('{{ route('admin.role.edit', ['role' => $role->id]) }}')">
                        <i class="fa fa-edit"></i>
                    </a>
                    @if($role->code !== 'admin')
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.toggle_active') }}"
                           onclick="commonToggleActive('{{ route('admin.role.update', ['role' => $role->id]) }}', {{ $role->is_active }})">
                            <i class="fa-solid fa-power-off"></i>
                        </a>
                        <a href="{{ route('admin.role.permission', ['role' => $role->id]) }}" class="btn btn-sm btn-primary mb-1" title="{{ __('app.permission') }}">
                            <i class="fa-solid fa-gear"></i>
                        </a>
                    @endif
                    @if(!$role->is_default)
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                           onclick="commonDelete('{{ route('admin.role.destroy', ['role' => $role->id]) }}')">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{!! renderPagination($roles) !!}

{!! renderSearchEmpty($roles) !!}
