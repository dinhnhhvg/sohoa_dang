<div class="table-responsive">
    <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100" data-sticky-column="3">
        <thead>
        <tr>
            <th class="w-40px">
                <input type="checkbox" class="form-check-input" onchange="checkAll(this)">
            </th>
            <th class="w-40px">#</th>
            <th>{!! renderThSort(__('app.code'), 'campaign_customers.code', $orderByName, $orderByType) !!}</th>
            <th>{!! renderThSort(__('app.name'), 'customers.name', $orderByName, $orderByType) !!}</th>
            <th class="min-w-220px">{{ __('app.content') }}</th>
            <th>{!! renderThSort(__('app.schedule_at'), 'campaign_customers.schedule_at', $orderByName, $orderByType) !!}</th>
            <th>{{ __('app.status') }}</th>
            <th class="min-w-220px">{{ __('app.note') }}</th>
            <th>{{ __('app.sale') }}</th>
            <th class="min-w-100px">{{ __('app.action') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($campaignCustomers as $i => $campaignCustomer)
            @php $customer = $campaignCustomer->customer @endphp
            <tr style="background-color: {{ $campaignCustomer->status->bg_color }}">
                <td class="text-center">
                    <input type="checkbox" class="form-check-input id" name="id[]" value="{{ $campaignCustomer->id }}">
                </td>
                <td class="text-center">{{ $i + 1 }}</td>
                <td class="text-center text-nowrap">{{ $campaignCustomer->id }}</td>
                <td class="text-nowrap">
                    {!! renderProfile($customer, route('admin.customer.show', ['customer' => $customer->id])) !!}
                </td>
                <td>{{ $campaignCustomer->content }}</td>
                <td class="text-center text-nowrap">
                    @if($campaignCustomer->schedule_at)
                        {{ $campaignCustomer->schedule_at->format('d-m-Y H:i') }}
                    @endif
                </td>
                <td class="text-center">
                    <span class="badge bg-primary">{{ __('app.'.$campaignCustomer->status->name) }}</span>
                </td>
                <td>
                    {{ $campaignCustomer->note }}
                </td>
                <td class="text-nowrap">{{ $campaignCustomer->sale->name }}</td>
                <td class="text-center">
                    <a href="javascript:void(0)" class="btn btn-sm btn-success mb-1" title="{{ __('app.edit') }}"
                       onclick="commonShowModal('{{ route('admin.campaign_customer.edit', ['campaign_customer' => $campaignCustomer->id]) }}', '#common-modal-lg')">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-primary mb-1" title="{{ __('app.call') }}"
                       onclick="showAlohubCallModal('{{ $customer->phone }}')">
                        <i class="fa-solid fa-phone"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.show_note') }}"
                       onclick="commonShowModal('{{ route('admin.campaign_customer.show_note', ['campaign_customer' => $campaignCustomer->id]) }}', '#common-modal-lg')">
                        <i class="fas fa-heart"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                       onclick="commonDelete('{{ route('admin.campaign_customer.destroy', ['campaign_customer' => $campaignCustomer->id]) }}')">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{!! renderPagination($campaignCustomers) !!}

{!! renderSearchEmpty($campaignCustomers) !!}
