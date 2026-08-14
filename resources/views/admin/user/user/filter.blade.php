@if($viewType === 'table')
    <div class="table-responsive">
        <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100" data-sticky-column="2">
            <thead>
            <tr>
                <th class="w-40px">#</th>
                <th>{!! renderThSort(__('app.code'), 'users.code', $orderByName, $orderByType) !!}</th>
                <th>{!! renderThSort(__('app.name'), 'users.name', $orderByName, $orderByType) !!}</th>
                <th>{!! renderThSort(__('app.email'), 'users.email', $orderByName, $orderByType) !!}</th>
                <th>{!! renderThSort(__('app.phone'), 'users.phone', $orderByName, $orderByType) !!}</th>
                <th>{{ __('app.gender') }}</th>
                <th>{!! renderThSort(__('app.birth_date'), 'users.birth_date', $orderByName, $orderByType) !!}</th>
                <th>{{ __('app.role') }}</th>
                <th>{{ __('app.center') }}</th>
                <th class="min-w-220px">{{ __('app.address') }}</th>
                <th>{{ __('app.is_active') }}</th>
                <th class="min-w-100px">{{ __('app.action') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $i => $user)
                <tr class="{{ $user->is_active ? '' : 'bg-inactive' }}">
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td class="text-center text-nowrap">{{ $user->code }}</td>
                    <td class="text-nowrap">
                        <a href="javascript:void(0)" onclick="commonShowModal('{{ route('admin.user.show', ['user' => $user->id]) }}', '#common-modal-fullscreen')">
                            {{ $user->name }}
                        </a>
                    </td>
                    <td class="text-nowrap">{{ $user->email }}</td>
                    <td class="text-center text-nowrap">{{ $user->phone }}</td>
                    <td class="text-center text-nowrap">{{ renderGender($user->gender) }}</td>
                    <td class="text-center text-nowrap">{{ $user->birth_date?->format('d-m-Y') }}</td>
                    <td class="text-center text-nowrap">{{ $user->role?->name }}</td>
                    <td class="text-center text-nowrap">{{ $user->center?->name }}</td>
                    <td>{{ formatAddress($user) }}</td>
                    <td class="text-center">{!! renderIsActive($user->is_active) !!}</td>
                    <td class="text-center">
                        <a href="javascript:void(0)" class="btn btn-sm btn-primary mb-1" title="{{ __('app.show') }}"
                           onclick="commonShowModal('{{ route('admin.user.show', ['user' => $user->id]) }}', '#common-modal-fullscreen')">
                            <i class="fa fa-eye"></i>
                        </a>
                        @if($user->role->code !== 'admin')
                            <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.toggle_active') }}"
                               onclick="commonToggleActive('{{ route('admin.user.update', ['user' => $user->id]) }}', {{ $user->is_active }})">
                                <i class="fa-solid fa-power-off"></i>
                            </a>
                        @endif
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                           onclick="commonDelete('{{ route('admin.user.destroy', ['user' => $user->id]) }}')">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endif

@if($viewType === 'card')
    <div class="row">
        @foreach($users as $i => $user)
            <div class="col-xxl-3 col-xl-4 col-md-6 mb-3">
                <div class="card card-profile">
                    <div class="card-body h-100 p-2 {{ $user->is_active ? '' : 'bg-inactive' }}">
                        <img src="{{ asset($user->avatar) }}" class="w-100 mb-1 aspect-ratio-11">
                        <div class="mb-1">
                            <p class="mb-0 text-primary"># {{ $user->code }}</p>
                            <p class="mb-0 text-primary"><i class="fas fa-user"></i> {{ $user->name }}</p>
                            <p class="mb-0 text-primary"><i class="fas fa-envelope"></i> {{ $user->email }}</p>
                            <p class="mb-0 text-primary"><i class="fas fa-phone"></i> {{ $user->phone }}</p>
                        </div>
                        <p class="mb-0 float-end">
                            <a href="javascript:void(0)" class="btn btn-sm btn-primary mb-1" title="{{ __('app.show') }}"
                               onclick="commonShowModal('{{ route('admin.user.show', ['user' => $user->id]) }}', '#common-modal-fullscreen')">
                                <i class="fa fa-eye"></i>
                            </a>
                            @if($user->role->code !== 'admin')
                                <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.toggle_active') }}"
                                   onclick="commonToggleActive('{{ route('admin.user.update', ['user' => $user->id]) }}', {{ $user->is_active }})">
                                    <i class="fa-solid fa-power-off"></i>
                                </a>
                            @endif
                            <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                               onclick="commonDelete('{{ route('admin.user.destroy', ['user' => $user->id]) }}')">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

{!! renderPagination($users) !!}

{!! renderSearchEmpty($users) !!}
