<div class="table-responsive">
    <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100" data-sticky-column="2">
        <thead>
        <tr>
            <th class="w-40px">#</th>
            <th>{!! renderThSort(__('app.name'), 'customer_tags.name', $orderByName, $orderByType) !!}</th>
            <th>{{ __('app.description') }}</th>
            <th>{!! renderThSort(__('app.customer'), 'customers_count', $orderByName, $orderByType) !!}</th>
            <th class="min-w-100px">{{ __('app.action') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($customerTags as $i => $customerTag)
            <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td class="text-nowrap">{{ $customerTag->name }}</td>
                <td class="text-center text-nowrap">{{ $customerTag->description }}</td>
                <td class="text-center">{{ $customerTag->customers_count ?: 0 }}</td>
                <td class="text-center">
                    <a href="javascript:void(0)" class="btn btn-sm btn-success mb-1" title="{{ __('app.edit') }}"
                       onclick="commonShowModal('{{ route('admin.customer_tag.edit', ['customer_tag' => $customerTag->id]) }}')">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                       onclick="commonDelete('{{ route('admin.customer_tag.destroy', ['customer_tag' => $customerTag->id]) }}')">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{!! renderPagination($customerTags) !!}

{!! renderSearchEmpty($customerTags) !!}
