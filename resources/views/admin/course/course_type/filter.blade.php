<div class="table-responsive">
    <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100" data-sticky-column="2">
        <thead>
        <tr>
            <th class="w-40px">#</th>
            <th>{{ __('app.name') }}</th>
            <th>{{ __('app.price') }}</th>
            <th>{{ __('app.duration') }}</th>
            <th>{{ __('app.lesson_count') }}</th>
            <th class="min-w-100px">{{ __('app.action') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($courseTypes as $i => $courseType)
            <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td class="text-center text-nowrap">{{ __('app.'.$courseType->type?->name) }}</td>
                <td class="text-center text-nowrap">{{ numberFormat($courseType->price) }}</td>
                <td class="text-center text-nowrap">{{ $courseType->duration }}</td>
                <td class="text-center text-nowrap">{{ $courseType->lesson_count }}</td>
                <td class="text-center">
                    <a href="javascript:void(0)" class="btn btn-sm btn-success mb-1" title="{{ __('app.edit') }}"
                       onclick="commonShowModal('{{ route('admin.course_type.edit', ['course_type' => $courseType->id]) }}')">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                       onclick="commonDelete('{{ route('admin.course_type.destroy', ['course_type' => $courseType->id]) }}')">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{!! renderPagination($courseTypes) !!}

{!! renderSearchEmpty($courseTypes) !!}
