<div class="table-responsive">
    <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100">
        <thead>
        <tr>
            <th class="w-40px">#</th>
            <th>{!! renderThSort(__('app.code'), 'payments.code', $orderByName, $orderByType) !!}</th>
            @if(!isset($order_id) || !$order_id)
                <th>{!! renderThSort(__('app.customer'), 'customers.name', $orderByName, $orderByType) !!}</th>
                <th>{{ __('app.order') }}</th>
                <th>{{ __('app.total_amount') }}</th>
            @endif
            <th>{{ __('app.name') }}</th>
            <th>{{ __('app.payment_method') }}</th>
            <th>{!! renderThSort(__('app.amount'), 'payments.amount', $orderByName, $orderByType) !!}</th>
            <th>{!! renderThSort(__('app.expiry_date'), 'payments.expiry_date', $orderByName, $orderByType) !!}</th>
            <th class="min-w-220px">{{ __('app.content') }}</th>
            <th>{{ __('app.status') }}</th>
            <th>{!! renderThSort(__('app.payment_time'), 'payments.payment_time', $orderByName, $orderByType) !!}</th>
            <th class="min-w-220px">{{ __('app.note') }}</th>
            <th class="min-w-100px">{{ __('app.action') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($payments as $i => $payment)
            @php $order = $payment->order @endphp
            @php $customer = $order->customer @endphp
            <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td class="text-center">{{ $payment->id }}</td>
                @if(!isset($order_id) || !$order_id)
                    <td class="text-nowrap">
                        {!! renderProfile($customer, route('admin.customer.show', ['customer' => $customer->id])) !!}
                        <p class="mb-0"><i class="fas fa-envelope"></i> {{ $customer->email }}</p>
                        <p class="mb-0"><i class="fas fa-phone"></i> {{ $customer->phone }}</p>
                    </td>
                    <td class="text-nowrap">
                        <strong>#</strong> {{ $customer->code }}
                        @foreach($payment->order->orderItems as $it => $orderItem)
                            <p class="mb-0">
                                <span class="badge bg-danger">{{ $it + 1 }}</span>
                                <span>{{ $orderItem->item->course->name }}</span>
                                <span class="badge bg-primary">{{ __('app.'.$orderItem->item->type->name) }}</span>
                                <span>{{ numberFormat($orderItem->price) }}</span>
                            </p>
                        @endforeach
                    </td>
                    <td class="text-center">
                        {{ numberFormat($order->total_amount) }}
                        @if($order->coupon_amount)
                            <p class="badge bg-danger mb-1">
                                {{ __('app.discount') }}<br>
                                {{ numberFormat($order->coupon_amount) }}
                            </p>
                        @endif
                        @if($order->discount_amount)
                            <p class="badge bg-danger mb-1">
                                {{ __('app.deduction') }}<br>
                                {{ numberFormat($order->discount_amount) }}
                            </p>
                        @endif
                        {{ numberFormat($order->final_amount) }}
                    </td>
                @endif
                <td class="text-nowrap">{{ $payment->name }}</td>
                <td class="text-center text-nowrap">{{ $payment->paymentMethod->name }}</td>
                <td class="text-center">{{ numberFormat($payment->amount) }}</td>
                <td class="text-center text-nowrap">{{ $payment->expiry_date?->format('d-m-Y') }}</td>
                <td>{{ $payment->content }}</td>
                <td class="text-center">
                    <span class="badge bg-primary">{{ __('app.'.$payment->status->name) }}</span>
                </td>
                <td class="text-center text-nowrap">{{ $payment->payment_time?->format('d-m-Y H:i') }}</td>
                <td>{{ $payment->note }}</td>
                <td class="text-center">
                    <a href="javascript:void(0)" class="btn btn-sm btn-success mb-1" title="{{ __('app.edit') }}"
                       onclick="commonShowModal('{{ route('admin.payment.edit', ['payment' => $payment->id]) }}', '#common-modal-lg')">
                        <i class="fa-solid fa-edit"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.show_note') }}"
                       onclick="commonShowModal('{{ route('admin.payment.show_note', ['payment' => $payment->id]) }}', '#common-modal-lg')">
                        <i class="fas fa-heart"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                       onclick="commonDelete('{{ route('admin.payment.destroy', ['payment' => $payment->id]) }}')">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{!! renderPagination($payments) !!}

{!! renderSearchEmpty($payments) !!}
