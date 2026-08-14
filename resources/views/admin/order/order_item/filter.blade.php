<div class="table-responsive">
    <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100">
        <thead>
        <tr>
            <th class="w-40px">#</th>
            <th>{{ __('app.course') }}</th>
            <th>{{ __('app.course_type') }}</th>
            <th>{{ __('app.price') }}</th>
            <th>{{ __('app.lesson_count') }}</th>
            <th>{{ __('app.content') }}</th>
            <th class="min-w-100px">{{ __('app.action') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orderItems as $i => $orderItem)
            <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td>{{ $orderItem->item->course->name }}</td>
                <td>{{ __('app.'.$orderItem->item->type->name) }}</td>
                <td class="text-center">{{ numberFormat($orderItem->price) }}</td>
                <td class="text-center">{{ $orderItem->item->lesson_count }}</td>
                <td>{{ $orderItem->content }}</td>
                <td class="text-center">
                    <a href="javascript:void(0)" class="btn btn-sm btn-success mb-1" title="{{ __('app.edit') }}"
                       onclick="commonShowModal('{{ route('admin.order_item.edit', ['order_item' => $orderItem->id]) }}', '#common-modal-lg')">
                        <i class="fa-solid fa-edit"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                       onclick="commonDelete('{{ route('admin.order_item.destroy', ['order_item' => $orderItem->id]) }}')">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{!! renderPagination($orderItems) !!}

{!! renderSearchEmpty($orderItems) !!}
