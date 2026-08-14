<div class="table-responsive">
    <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100" data-sticky-column="2">
        <thead>
        <tr>
            <th class="w-40px">#</th>
            <th>{!! renderThSort(__('app.code'), 'code', $orderByName, $orderByType) !!}</th>
            <th>{!! renderThSort(__('app.name'), 'name', $orderByName, $orderByType) !!}</th>
            <th>{!! renderThSort(__('app.batch'), 'batches_count', $orderByName, $orderByType) !!}</th>
            <th class="min-w-100px">{{ __('app.action') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($oldAgencies as $i => $olAgency)
            <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td class="text-center text-nowrap">{{ $olAgency->code }}</td>
                <td class="text-center text-nowrap">{{ $olAgency->name }}</td>
                <td class="text-center text-nowrap">{{ $olAgency->batches_count }}</td>
                <td class="text-center">
                    <a href="javascript:void(0)" class="btn btn-sm btn-primary mb-1" title="{{ __('app.edit') }}"
                       onclick="commonShowModal('{{ route('admin.old_agency.edit', ['old_agency' => $olAgency->id]) }}', '#common-modal-lg')">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                       onclick="commonDelete('{{ route('admin.old_agency.destroy', ['old_agency' => $olAgency->id]) }}')">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{!! renderPagination($oldAgencies) !!}

{!! renderSearchEmpty($oldAgencies) !!}
