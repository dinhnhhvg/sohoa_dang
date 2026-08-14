@if($viewType === 'table')
    <div class="table-responsive">
        <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100" data-sticky-column="2">
            <thead>
            <tr>
                <th class="w-40px">
                    <input type="checkbox" class="form-check-input" onchange="checkAll(this)">
                </th>
                <th class="w-40px">#</th>
                <th>{!! renderThSort(__('app.code'), 'customers.code', $orderByName, $orderByType) !!}</th>
                <th>{!! renderThSort(__('app.name'), 'customers.name', $orderByName, $orderByType) !!}</th>
                @if(session('role_code') !== 'sale')
                    <th>{!! renderThSort(__('app.email'), 'customers.email', $orderByName, $orderByType) !!}</th>
                    <th>{!! renderThSort(__('app.phone'), 'customers.phone', $orderByName, $orderByType) !!}</th>
                @endif
                <th>{{ __('app.gender') }}</th>
                <th>{!! renderThSort(__('app.birth_date'), 'customers.birth_date', $orderByName, $orderByType) !!}</th>
                <th>{{ __('app.center') }}</th>
                <th>{{ __('app.agency') }}</th>
                <th class="min-w-220px">{{ __('app.address') }}</th>
                <th>{{ __('app.is_active') }}</th>
                <th class="min-w-100px">{{ __('app.action') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($customers as $i => $customer)
                <tr class="{{ $customer->is_active ? '' : 'bg-inactive' }}">
                    <td class="text-center">
                        <input type="checkbox" class="form-check-input id" name="id[]" value="{{ $customer->id }}">
                    </td>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td class="text-center text-nowrap">{{ $customer->code }}</td>
                    <td class="text-nowrap">
                        <a href="javascript:void(0)" onclick="commonShowModal('{{ route('admin.customer.show', ['customer' => $customer->id]) }}', '#common-modal-fullscreen')">
                            {{ $customer->name }}
                        </a>
                        @if($customer->customerTag)
                            <span class="badge bg-danger">{{ $customer->customerTag->name }}</span>
                        @endif
                    </td>
                    @if(session('role_code') !== 'sale')
                        <td class="text-nowrap">{{ $customer->email }}</td>
                        <td class="text-center text-nowrap">{{ $customer->phone }}</td>
                    @endif
                    <td class="text-center text-nowrap">{{ renderGender($customer->gender) }}</td>
                    <td class="text-center text-nowrap">{{ $customer->birth_date?->format('d-m-Y') }}</td>
                    <td class="text-center text-nowrap">{{ $customer->center?->name }}</td>
                    <td class="text-center text-nowrap">{{ $customer->agency?->name }}</td>
                    <td>{{ formatAddress($customer) }}</td>
                    <td class="text-center">{!! renderIsActive($customer->is_active) !!}</td>
                    <td class="text-center">
                        <a href="javascript:void(0)" class="btn btn-sm btn-primary mb-1" title="{{ __('app.show') }}"
                           onclick="commonShowModal('{{ route('admin.customer.show', ['customer' => $customer->id]) }}', '#common-modal-fullscreen')">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-primary mb-1" title="{{ __('app.call') }}"
                           onclick="showAlohubCallModal('{{ $customer->phone }}')">
                            <i class="fa-solid fa-phone"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.toggle_active') }}"
                           onclick="commonToggleActive('{{ route('admin.customer.update', ['customer' => $customer->id]) }}', {{ $customer->is_active }})">
                            <i class="fa-solid fa-power-off"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                           onclick="commonDelete('{{ route('admin.customer.destroy', ['customer' => $customer->id]) }}')">
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
        @foreach($customers as $i => $customer)
            <div class="col-xxl-3 col-xl-4 col-md-6 mb-3">
                <div class="card card-profile">
                    <div class="card-body p-2 {{ $customer->is_active ? '' : 'bg-inactive' }}">
                        <img src="{{ asset($customer->avatar) }}" class="w-100 mb-1 aspect-ratio-11" alt="image">
                        <div class="mb-1">
                            <p class="mb-0 text-primary"><i class="fas fa-user"></i> {{ $customer->name }}</p>
                            <p class="mb-0 text-primary"><i class="fas fa-envelope"></i> {{ $customer->email }}</p>
                            <p class="mb-0 text-primary"><i class="fas fa-phone"></i> {{ $customer->phone }}</p>
                        </div>
                        <p class="mb-0 float-end">
                            <a href="javascript:void(0)" class="btn btn-sm btn-primary mb-1" title="{{ __('app.show') }}"
                               onclick="commonShowModal('{{ route('admin.customer.show', ['customer' => $customer->id]) }}', '#common-modal-fullscreen')">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.toggle_active') }}"
                               onclick="commonToggleActive('{{ route('admin.customer.update', ['customer' => $customer->id]) }}', {{ $customer->is_active }})">
                                <i class="fa-solid fa-power-off"></i>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                               onclick="commonDelete('{{ route('admin.customer.destroy', ['customer' => $customer->id]) }}')">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

{!! renderPagination($customers) !!}

{!! renderSearchEmpty($customers) !!}
