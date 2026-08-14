<div class="table-responsive">
    <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100" data-sticky-column="2">
        <thead>
        <tr>
            <th class="w-40px">#</th>
            <th>{{ __('app.title') }}</th>
            <th>{{ __('app.type') }}</th>
            <th>{{ __('app.file_path') }}</th>
            <th class="min-w-100px">{{ __('app.action') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($itemMedias as $i => $itemMedia)
            <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td>{{ $itemMedia->title }}</td>
                <td class="text-center"><span class="badge bg-primary">{{ $itemMedia->type }}</span></td>
                <td>{{ $itemMedia->file_path }}</td>
                <td class="text-center">
                    <a href="javascript:void(0)" class="btn btn-sm btn-success mb-1" title="{{ __('app.edit') }}"
                       onclick="commonShowModal('{{ route('admin.item_media.edit', ['item_media' => $itemMedia->id]) }}', '#common-modal-lg')">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                       onclick="commonDelete('{{ route('admin.item_media.destroy', ['item_media' => $itemMedia->id]) }}')">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{!! renderPagination($itemMedias) !!}

{!! renderSearchEmpty($itemMedias) !!}
