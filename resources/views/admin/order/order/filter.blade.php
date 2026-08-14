<div class="table-responsive">
    <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100" data-sticky-column="3">
        <thead>
        <tr>
            <th class="w-40px">
                <input type="checkbox" class="form-check-input" onchange="checkAll(this)">
            </th>
            <th class="w-40px">#</th>
            <th>{!! renderThSort(__('app.code'), 'orders.id', $orderByName, $orderByType) !!}</th>
            <th>{!! renderThSort(__('app.name'), 'customers.name', $orderByName, $orderByType) !!}</th>
            <th>{{ __('app.type') }}</th>
            <th>{{ __('app.show') }}</th>
            <th class="min-w-220px">{{ __('app.content') }}</th>
            <th>{!! renderThSort(__('app.price'), 'orders.price', $orderByName, $orderByType) !!}</th>
            <th>{{ __('app.status') }}</th>
            <th class="min-w-220px">{{ __('app.note') }}</th>
            <th>{{ __('app.payment') }}</th>
            <th>{!! renderThSort(__('app.created_at'), 'orders.created_at', $orderByName, $orderByType) !!}</th>
            <th>{{ __('app.sale') }}</th>
            <th class="min-w-100px">{{ __('app.action') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $i => $order)
            @php $customer = $order->customer @endphp
            <tr style="background-color: {{ $order->status->bg_color }}">
                <td class="text-center">
                    <input type="checkbox" class="form-check-input id" name="id[]" value="{{ $order->id }}">
                </td>
                <td class="text-center">{{ $i + 1 }}</td>
                <td class="text-center text-nowrap">{{ $order->id }}</td>
                <td class="text-nowrap">
                    {!! renderProfile($customer, route('admin.customer.show', ['customer' => $customer->id])) !!}
                    <p class="mb-0"><i class="fas fa-envelope"></i> {{ $customer->email }}</p>
                    <p class="mb-0"><i class="fas fa-phone"></i> {{ $customer->phone }}</p>
                </td>
                <td class="text-center">
                    <span class="badge bg-primary">{{ __('app.'.$order->type->name) }}</span>
                </td>
                <td class="text-nowrap">
                    @foreach($order->orderItems as $it => $orderItem)
                        <p class="mb-0">
                            <span class="badge bg-danger">{{ $it + 1 }}</span>
                            <span>{{ $orderItem->item->course->name }}</span>
                            <span class="badge bg-primary">{{ __('app.'.$orderItem->item->type->name) }}</span>
                            <span>{{ numberFormat($orderItem->price) }}</span>
                        </p>
                    @endforeach
                    <a href="javascript:void(0)" class="btn btn-sm btn-success my-1" title="{{ __('app.edit') }}"
                       onclick="commonShowModal('{{ route('admin.order_item.filter_modal', ['order_id' => $order->id, 'type_code' => $order->type->code]) }}', '#common-modal-fullscreen')">
                        <i class="fa-solid fa-edit"></i>
                    </a>
                </td>
                <td>{{ $order->content }}</td>
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
                <td class="text-center">
                    <span class="badge bg-primary">{{ __('app.'.$order->status->name) }}</span>
                </td>
                <td>{{ $order->note }}</td>
                <td class="text-nowrap">
                    @foreach($order->payments as $ip => $payment)
                        <p class="mb-0">
                            <span class="badge bg-danger">{{ $ip + 1 }}</span>
                            <span>{{ numberFormat($payment->amount) }}</span>
                            @if($payment->status->code == 'paid')
                                <i class="fa-solid fa-check text-success"></i>
                            @endif
                        </p>
                    @endforeach
                </td>
                <td class="text-center text-nowrap">{{ $order->created_at->format('d-m-Y H:i') }}</td>
                <td class="text-nowrap">{{ $customer->sale?->name }}</td>
                <td class="text-center">
                    <a href="javascript:void(0)" class="btn btn-sm btn-success mb-1" title="{{ __('app.edit') }}"
                       onclick="commonShowModal('{{ route('admin.order.edit', ['order' => $order->id]) }}', '#common-modal-lg')">
                        <i class="fa-solid fa-edit"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-primary mb-1" title="{{ __('app.call') }}"
                       onclick="showAlohubCallModal('{{ $customer->phone }}')">
                        <i class="fa-solid fa-phone"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-primary mb-1" title="{{ __('app.payment') }}"
                       onclick="commonShowModal('{{ route('admin.payment.filter_modal', ['order_id' => $order->id]) }}', '#common-modal-fullscreen')">
                        <i class="fa-solid fa-coins"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.show_note') }}"
                       onclick="commonShowModal('{{ route('admin.order.show_note', ['order' => $order->id]) }}', '#common-modal-lg')">
                        <i class="fas fa-heart"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                       onclick="commonDelete('{{ route('admin.order.destroy', ['order' => $order->id]) }}')">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{!! renderPagination($orders) !!}

{!! renderSearchEmpty($orders) !!}
