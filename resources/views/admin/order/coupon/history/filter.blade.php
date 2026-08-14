<div class="table-responsive">
    <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100">
        <thead>
        <tr>
            <th class="w-40px">#</th>
            <th>{!! renderThSort(__('app.code').' '.__('app.order'), 'orders.id', $orderByName, $orderByType) !!}</th>
            <th>{!! renderThSort(__('app.name'), 'customers.name', $orderByName, $orderByType) !!}</th>
            <th>{!! renderThSort(__('app.amount'), 'orders.total_amount', $orderByName, $orderByType) !!}</th>
            <th>{!! renderThSort(__('app.coupon_amount'), 'orders.coupon_amount', $orderByName, $orderByType) !!}</th>
            <th>{!! renderThSort(__('app.created_at'), 'orders.created_at', $orderByName, $orderByType) !!}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $i => $order)
            @php $customer = $order->customer @endphp
            <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td class="text-center">{{ $order->id }}</td>
                <td class="text-nowrap">
                    {!! renderProfile($customer) !!}
                </td>
                <td class="text-center">{{ numberFormat($order->final_amount) }}</td>
                <td class="text-center">{{ numberFormat($order->coupon_amount) }}</td>
                <td class="text-center text-nowrap">{{ $order->created_at->format('d-m-Y H:i') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{!! renderPagination($orders) !!}

{!! renderSearchEmpty($orders) !!}
