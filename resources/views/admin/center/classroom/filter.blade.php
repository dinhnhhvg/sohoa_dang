<div class="table-responsive">
    <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100" data-sticky-column="2">
        <thead>
        <tr>
            <th class="w-40px">#</th>
            <th>{!! renderThSort(__('app.name'), 'classrooms.name', $orderByName, $orderByType) !!}</th>
            <th>{{ __('app.locale') }}</th>
            <th>{{ __('app.center') }}</th>
            <th>{!! renderThSort(__('app.capacity'), 'classrooms.capacity', $orderByName, $orderByType) !!}</th>
            <th class="min-w-100px">{{ __('app.action') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($classrooms as $i => $classroom)
            <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td class="text-center text-nowrap">{{ $classroom->name }}</td>
                <td>{{ $classroom->locale }}</td>
                <td class="text-center text-nowrap">{{ $classroom->center->name }}</td>
                <td class="text-center">{{ $classroom->capacity }}</td>
                <td class="text-center">
                    <a href="javascript:void(0)" class="btn btn-sm btn-success mb-1" title="{{ __('app.edit') }}"
                       onclick="commonShowModal('{{ route('admin.classroom.edit', ['classroom' => $classroom->id]) }}')">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                       onclick="commonDelete('{{ route('admin.classroom.destroy', ['classroom' => $classroom->id]) }}')">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{!! renderPagination($classrooms) !!}

{!! renderSearchEmpty($classrooms) !!}
