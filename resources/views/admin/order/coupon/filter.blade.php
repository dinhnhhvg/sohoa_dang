<div class="table-responsive">
    <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100" data-sticky-column="3">
        <thead>
        <tr>
            <th class="w-40px">
                <input type="checkbox" class="form-check-input" onchange="checkAll(this)">
            </th>
            <th class="w-40px">#</th>
            <th>{!! renderThSort(__('app.code'), 'coupons.name', $orderByName, $orderByType) !!}</th>
            <th class="min-w-220px">{!! renderThSort(__('app.name'), 'coupons.name', $orderByName, $orderByType) !!}</th>
            <th>{{ __('app.type') }}</th>
            <th>{!! renderThSort(__('app.value'), 'coupons.value', $orderByName, $orderByType) !!}</th>
            <th>{!! renderThSort(__('app.min_amount'), 'coupons.min_amount', $orderByName, $orderByType) !!}</th>
            <th>{!! renderThSort(__('app.max_amount'), 'coupons.max_amount', $orderByName, $orderByType) !!}</th>
            <th>{!! renderThSort(__('app.start_date'), 'coupons.start_date', $orderByName, $orderByType) !!}</th>
            <th>{!! renderThSort(__('app.end_date'), 'coupons.end_date', $orderByName, $orderByType) !!}</th>
            <th>{!! renderThSort(__('app.limit'), 'coupons.limit', $orderByName, $orderByType) !!}</th>
            <th>{{ __('app.is_active') }}</th>
            <th class="min-w-100px">{{ __('app.action') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($coupons as $i => $coupon)
            <tr class="{{ $coupon->is_active ? '' : 'bg-inactive' }}">
                <td class="text-center">
                    <input type="checkbox" class="form-check-input id" name="id[]" value="{{ $coupon->id }}">
                </td>
                <td class="text-center">{{ $i + 1 }}</td>
                <td class="text-center">{{ $coupon->code }}</td>
                <td>{{ $coupon->name }}</td>
                <td class="text-center">{{ __('app.'.$coupon->type) }}</td>
                <td class="text-center">{{ numberFormat($coupon->value) }}</td>
                <td class="text-center">{{ $coupon->min_amount ? numberFormat($coupon->min_amount) : '' }}</td>
                <td class="text-center">{{ $coupon->max_amount ? numberFormat($coupon->max_amount) : '' }}</td>
                <td class="text-center text-nowrap">{{ $coupon->start_date?->format('d-m-Y') }}</td>
                <td class="text-center text-nowrap">{{ $coupon->end_date?->format('d-m-Y') }}</td>
                <td class="text-center">
                    @if($coupon->limit)
                        {{ $coupon->orders_count ?: 0 }}/{{ $coupon->limit }}
                    @else
                        {{ $coupon->orders_count ?: 0 }}
                    @endif
                </td>
                <td class="text-center">{!! renderIsActive($coupon->is_active) !!}</td>
                <td class="text-center">
                    @if(!$coupon->orders_count)
                        <a href="javascript:void(0)" class="btn btn-sm btn-success mb-1" title="{{ __('app.edit') }}"
                           onclick="commonShowModal('{{ route('admin.coupon.edit', ['coupon' => $coupon->id]) }}', '#common-modal-xl')">
                            <i class="fa fa-edit"></i>
                        </a>
                    @else
                        <a href="javascript:void(0)" class="btn btn-sm btn-primary mb-1" title="{{ __('app.history') }}"
                           onclick="commonShowModal('{{ route('admin.coupon.history.filter_modal', ['coupon' => $coupon->id]) }}', '#common-modal-xl')">
                            <i class="fa fa-eye"></i>
                        </a>
                    @endif
                    <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.toggle_active') }}"
                       onclick="commonToggleActive('{{ route('admin.coupon.update', ['coupon' => $coupon->id]) }}', {{ $coupon->is_active }})">
                        <i class="fa-solid fa-power-off"></i>
                    </a>
                    @if(!$coupon->orders_count)
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                           onclick="commonDelete('{{ route('admin.coupon.destroy', ['coupon' => $coupon->id]) }}')">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{!! renderPagination($coupons) !!}

{!! renderSearchEmpty($coupons) !!}
