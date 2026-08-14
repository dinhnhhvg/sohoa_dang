<div class="table-responsive">
    <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100" data-sticky-column="3">
        <thead>
        <tr>
            <th class="w-40px">
                <input type="checkbox" class="form-check-input" onchange="checkAll(this)">
            </th>
            <th class="w-40px">#</th>
            <th>{!! renderThSort(__('app.name'), 'lesson_schedules.name', $orderByName, $orderByType) !!}</th>
            <th>{!! renderThSort(__('app.day_of_week'), 'lesson_schedules.day_of_week', $orderByName, $orderByType) !!}</th>
            <th>{{ __('app.type') }}</th>
            <th>{{ __('app.classroom') }}</th>
            <th class="min-w-100px">{{ __('app.action') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($lessonSchedules as $i => $lessonSchedule)
            <tr>
                <td class="text-center">
                    <input type="checkbox" class="form-check-input id" name="id[]" value="{{ $lessonSchedule->id }}">
                </td>
                <td class="text-center">{{ $i + 1 }}</td>
                <td class="text-nowrap">{{ $lessonSchedule->name }}</td>
                <td class="text-center text-nowrap">
                    {{ renderDayOfWeek($lessonSchedule->day_of_week) }} ({{ $lessonSchedule->start_time?->format('H:i') }} - {{ $lessonSchedule->end_time?->format('H:i') }})
                </td>
                <td class="text-center"><span class="badge bg-primary">{{ __('app.'.$lessonSchedule->type?->name) }}</span></td>
                <td class="text-nowrap">
                    @if($lessonSchedule->classroom)
                        {{ $lessonSchedule->classroom?->name }} - {{ $lessonSchedule->center?->name }}
                    @endif
                </td>
                <td class="text-center">
                    <a href="javascript:void(0)" class="btn btn-sm btn-success mb-1" title="{{ __('app.edit') }}"
                       onclick="commonShowModal('{{ route('admin.lesson_schedule.edit', ['lesson_schedule' => $lessonSchedule->id]) }}', '#common-modal-lg')">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                       onclick="commonDelete('{{ route('admin.lesson_schedule.destroy', ['lesson_schedule' => $lessonSchedule->id]) }}')">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{!! renderPagination($lessonSchedules) !!}

{!! renderSearchEmpty($lessonSchedules) !!}
