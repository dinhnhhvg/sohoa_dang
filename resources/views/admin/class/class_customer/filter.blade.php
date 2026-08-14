<div class="table-responsive">
    <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100" data-sticky-column="3">
        <thead>
        <tr>
            <th class="w-40px">
                <input type="checkbox" class="form-check-input" onchange="checkAll(this)">
            </th>
            <th class="w-40px">#</th>
            <th>{!! renderThSort(__('app.name'), 'customers.name', $orderByName, $orderByType) !!}</th>
            <th>{{ __('app.status') }}</th>
            <th>{!! renderThSort(__('app.start_date'), 'class_customer.start_date', $orderByName, $orderByType) !!}</th>
            <th>{!! renderThSort(__('app.end_date'), 'class_customer.end_date', $orderByName, $orderByType) !!}</th>
            <th>{!! renderThSort(__('app.lesson'), 'class_customers.lesson_customers_count', $orderByName, $orderByType) !!}</th>
            <th class="min-w-100px">{{ __('app.action') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($classCustomers as $i => $classCustomer)
            @php $customer = $classCustomer->customer @endphp
            <tr>
                <td class="text-center">
                    <input type="checkbox" class="form-check-input id" name="id[]" value="{{ $classCustomer->id }}">
                </td>
                <td class="text-center">{{ $i + 1 }}</td>
                <td class="text-nowrap">
                    {!! renderProfile($customer, route('admin.customer.show', ['customer' => $customer->id])) !!}
                </td>
                <td class="text-center"><span class="badge bg-primary">{{ __('app.').$classCustomer->status->name }}</span></td>
                <td class="text-center text-nowrap">{{ $classCustomer->start_date?->format('d-m-Y') }}</td>
                <td class="text-center text-nowrap">{{ $classCustomer->end_date?->format('d-m-Y') }}</td>
                <td class="text-center">
                    @if($classCustomer->lesson_customers_count)
                        {{ $classCustomer->lesson_customer_done_count ?: 0 }}/{{ $classCustomer->lesson_customers_count }}
                    @endif
                </td>
                <td class="text-center">
                    <a href="javascript:void(0)" class="btn btn-sm btn-primary mb-1" title="{{ __('app.lesson') }}"
                       onclick="commonShowModal('{{ route('admin.lesson_customer.filter_modal', ['class_id' => $classCustomer->class_id, 'class_customer_id' => $classCustomer->id]) }}', '#common-modal-fullscreen')">
                        <i class="fa-solid fa-calendar-days"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                       onclick="commonDelete('{{ route('admin.class_customer.destroy', ['class_customer' => $classCustomer->id]) }}')">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{!! renderPagination($classCustomers) !!}

{!! renderSearchEmpty($classCustomers) !!}
