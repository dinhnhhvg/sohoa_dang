<div class="table-responsive">
    <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100" data-sticky-column="3">
        <thead>
        <tr>
            <th class="w-40px">
                <input type="checkbox" class="form-check-input" onchange="checkAll(this)">
            </th>
            <th class="w-40px">#</th>
            <th>{!! renderThSort(__('app.name'), 'lessons.name', $orderByName, $orderByType) !!}</th>
            <th>{!! renderThSort(__('app.time'), 'lessons.date', $orderByName, $orderByType) !!}</th>
            <th>{{ __('app.status') }}</th>
            <th>{{ __('app.type') }}</th>
            <th>{{ __('app.classroom') }}</th>
            <th class="min-w-220px">{{ __('app.content') }}</th>
            <th>{{ __('app.student') }}</th>
            <th class="min-w-100px">{{ __('app.action') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($lessons as $i => $lesson)
            <tr>
                <td class="text-center">
                    <input type="checkbox" class="form-check-input id" name="id[]" value="{{ $lesson->id }}">
                </td>
                <td class="text-center">{{ $i + 1 }}</td>
                <td class="text-nowrap">{{ $lesson->name }}</td>
                <td class="text-center text-nowrap">
                    {{ ucfirst($lesson->date?->translatedFormat('l')) }} ({{ $lesson->start_time?->format('H:i') }} - {{ $lesson->end_time?->format('H:i') }})
                    <br>
                    {{ $lesson->date?->format('d-m-Y') }}
                </td>
                <td class="text-center"><span class="badge bg-primary">{{ __('app.'.$lesson->status?->name) }}</span></td>
                <td class="text-center"><span class="badge bg-primary">{{ __('app.'.$lesson->type?->name) }}</span></td>
                <td class="text-nowrap">
                    @if($lesson->classroom)
                        {{ $lesson->classroom->name }} - {{ $lesson->center?->name }}
                    @endif
                </td>
                <td>{{ $lesson->content }}</td>
                <td class="text-center">{{ $lesson->lesson_customers_count ?: 0 }}</td>
                <td class="text-center">
                    <a href="javascript:void(0)" class="btn btn-sm btn-success mb-1" title="{{ __('app.edit') }}"
                       onclick="commonShowModal('{{ route('admin.lesson.edit', ['lesson' => $lesson->id]) }}', '#common-modal-lg')">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-primary mb-1" title="{{ __('app.student') }}"
                       onclick="commonShowModal('{{ route('admin.lesson_customer.filter_modal', ['class_id' => $lesson->id, 'lesson_id' => $lesson->id]) }}', '#common-modal-fullscreen')">
                        <i class="fa-solid fa-users"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                       onclick="commonDelete('{{ route('admin.lesson.destroy', ['lesson' => $lesson->id]) }}')">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{!! renderPagination($lessons) !!}

{!! renderSearchEmpty($lessons) !!}
