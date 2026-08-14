@if($viewType === 'table')
    <div class="table-responsive">
        <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100" data-sticky-column="2">
            <thead>
            <tr>
                <th class="w-40px">#</th>
                <th>{{ __('app.code') }}</th>
                <th>{{ __('app.name') }}</th>
                <th>{{ __('app.router') }}</th>
                <th>{{ __('app.is_active') }}</th>
                <th class="min-w-100px">{{ __('app.action') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($accounts as $i => $account)
                <tr class="{{ $account->is_active ? '' : 'bg-inactive' }}">
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td class="text-center text-nowrap">{{ $account->code }}</td>
                    <td class="text-center text-nowrap">{{ $account->name }}</td>
                    <td class="text-center text-nowrap">{{ $account->route }}</td>
                    <td class="text-center">{!! renderIsActive($account->is_active) !!}</td>
                    <td class="text-center">
                        <a href="javascript:void(0)" class="btn btn-sm btn-success mb-1" title="{{ __('app.edit') }}"
                           onclick="commonShowModal('{{ route('root.account.edit', ['account' => $account->id]) }}', '#common-modal-lg')">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.toggle_active') }}"
                           onclick="commonToggleActive('{{ route('root.account.update', ['account' => $account->id]) }}', {{ $account->is_active }})">
                            <i class="fa-solid fa-power-off"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                           onclick="commonDelete('{{ route('root.account.destroy', ['account' => $account->id]) }}')">
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
        @foreach($accounts as $i => $account)
            <div class="col-xxl-3 col-xl-4 col-md-6 mb-3">
                <div class="card card-profile">
                    <div class="card-body p-2 {{ $account->is_active ? '' : 'bg-inactive' }}">
                        <img src="{{ asset($account->image) }}" class="w-100 mb-1 aspect-ratio-11">
                        <div class="row mb-1">
                            <div class="col-4 text-primary mb-1">{{ __('app.code') }}</div>
                            <div class="col-8 mb-1">{{ $account->code }}</div>
                            <div class="col-4 text-primary mb-1">{{ __('app.name') }}</div>
                            <div class="col-8 mb-1">{{ $account->name }}</div>
                            <div class="col-4 text-primary mb-1">{{ __('app.router') }}</div>
                            <div class="col-8 mb-1">{{ $account->route }}</div>
                        </div>
                        <p class="mb-0 float-end">
                            <a href="javascript:void(0)" class="btn btn-sm btn-success mb-1" title="{{ __('app.edit') }}"
                               onclick="commonShowModal('{{ route('root.account.edit', ['account' => $account->id]) }}', '#common-modal-lg')">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.toggle_active') }}"
                               onclick="commonToggleActive('{{ route('root.account.update', ['account' => $account->id]) }}', {{ $account->is_active }})">
                                <i class="fa-solid fa-power-off"></i>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                               onclick="commonDelete('{{ route('root.account.destroy', ['account' => $account->id]) }}')">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

{!! renderPagination($accounts) !!}

{!! renderSearchEmpty($accounts) !!}
