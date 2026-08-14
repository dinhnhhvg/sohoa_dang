<div class="table-responsive">
    <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100" data-sticky-column="2">
        <thead>
        <tr>
            <th class="w-40px">
                <input type="checkbox" class="form-check-input" onchange="checkAll(this)">
            </th>
            <th class="w-40px">#</th>
            <th>{!! renderThSort(__('app.code'), 'products.code', $orderByName, $orderByType) !!}</th>
            <th>{!! renderThSort(__('app.name'), 'products.name', $orderByName, $orderByType) !!}</th>
            <th>{{ __('app.category') }}</th>
            <th class="min-w-220px">{{ __('app.topic') }}</th>
            <th>{{ __('app.product_addon') }}</th>
            <th>{!! renderThSort(__('app.price'), 'products.price', $orderByName, $orderByType) !!}</th>
            <th>{{ __('app.unit') }}</th>
            <th>{!! renderThSort(__('app.stock'), 'products.stock', $orderByName, $orderByType) !!}</th>
            <th>{!! renderThSort(__('app.view'), 'products.view', $orderByName, $orderByType) !!}</th>
            <th>{!! renderThSort(__('app.sold'), 'sold', $orderByName, $orderByType) !!}</th>
            <th>{{ __('app.is_active') }}</th>
            <th class="min-w-100px">{{ __('app.action') }}</th>
        </tr>
        </thead>
        <tbody>
            @foreach($products as $i => $product)
                <tr class="{{ $product->is_active ? '' : 'bg-inactive' }}">
                    <td class="text-center">
                        <input type="checkbox" class="form-check-input id" name="id[]" value="{{ $product->id }}">
                    </td>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td class="text-center text-nowrap">{{ $product->code }}</td>
                    <td class="text-nowrap">
                        <a href="{{ route('admin.product.detail', ['product' => $product->id]) }}">
                            <strong>{{ $product->name }}</strong>
                        </a>
                    </td>
                    <td class="text-center text-nowrap">{{ $product->category?->name }}</td>
                    <td class="text-center">
                        @foreach($product->topics as $topic)
                            <span class="badge bg-primary">{{ $topic->name }}</span>
                        @endforeach
                    </td>
                    <td class="text-nowrap">
                        @foreach($product->addons as $ia => $addon)
                            <span class="badge bg-danger">{{ $ia + 1 }}</span>
                            {{ $addon->name }}
                        @endforeach
                    </td>
                    <td class="text-center text-nowrap">
                        @if($product->old_price)
                            <del>{{ numberFormat($product->old_price) }}</del>
                            <br>
                        @endif
                        {{ numberFormat($product->price) }}
                    </td>
                    <td class="text-center">{{ $product->unit }}</td>
                    <td class="text-center">{{ numberFormat($product->stock) }}</td>
                    <td class="text-center">{{ numberFormat($product->view) }}</td>
                    <td class="text-center"></td>
                    <td class="text-center">{!! renderIsActive($product->is_active) !!}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.product.detail', ['product' => $product->id]) }}" class="btn btn-sm btn-primary mb-1" title="{{ __('app.detail') }}">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.toggle_active') }}"
                           onclick="commonToggleActive('{{ route('admin.product.update', ['product' => $product->id]) }}', {{ $product->is_active }})">
                            <i class="fa-solid fa-power-off"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                           onclick="commonDelete('{{ route('admin.product.destroy', ['product' => $product->id]) }}')">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

{!! renderPagination($products) !!}

{!! renderSearchEmpty($products) !!}
