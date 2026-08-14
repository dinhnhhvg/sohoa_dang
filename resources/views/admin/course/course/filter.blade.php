@if($viewType === 'table')
    <div class="table-responsive">
        <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100" data-sticky-column="2">
            <thead>
            <tr>
                <th class="w-40px">#</th>
                <th>{!! renderThSort(__('app.code'), 'courses.code', $orderByName, $orderByType) !!}</th>
                <th class="min-w-220px">{!! renderThSort(__('app.name'), 'courses.name', $orderByName, $orderByType) !!}</th>
                <th>{{ __('app.category') }}</th>
                <th>{{ __('app.level') }}</th>
                <th>{{ __('app.topic') }}</th>
                <th>{!! renderThSort(__('app.price'), 'courses.price', $orderByName, $orderByType) !!}</th>
                <th>{{ __('app.course_type') }}</th>
                <th>{!! renderThSort(__('app.class'), 'courses.classes_count', $orderByName, $orderByType) !!}</th>
                <th>{{ __('app.is_active') }}</th>
                <th class="min-w-100px">{{ __('app.action') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($courses as $i => $course)
                <tr class="{{ $course->is_active ? '' : 'bg-inactive' }}">
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td class="text-center text-nowrap">{{ $course->code }}</td>
                    <td>
                        <a href="{{ route('admin.course.detail', ['course' => $course->id]) }}"><strong>{{ $course->name }}</strong></a>
                    </td>
                    <td class="text-center text-nowrap">{{ $course->category?->name }}</td>
                    <td class="text-center text-nowrap">{{ $course->level?->name }}</td>
                    <td class="text-center text-nowrap"></td>
                    <td class="text-center text-nowrap">{{ numberFormat($course->price) }}</td>
                    <td>
                        @foreach($course->courseTypes as $courseType)
                            <p class="mb-0 text-nowrap"><strong>{{ __('app.'.$courseType->type->name) }}</strong> - {{ numberFormat($courseType->price) }}</p>
                        @endforeach
                    </td>
                    <td></td>
                    <td class="text-center">{!! renderIsActive($course->is_active) !!}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.course.detail', ['course' => $course->id]) }}" class="btn btn-sm btn-primary mb-1" title="{{ __('app.detail') }}">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.toggle_active') }}"
                           onclick="commonToggleActive('{{ route('admin.course.update', ['course' => $course->id]) }}', {{ $course->is_active }})">
                            <i class="fa-solid fa-power-off"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                           onclick="commonDelete('{{ route('admin.course.destroy', ['course' => $course->id]) }}')">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endif

@if($viewType === 'card')
    <div class="row">
        @foreach($courses as $i => $course)
            <div class="col-xxl-3 col-xl-4 col-md-6 mb-3">
                <div class="card card-profile">
                    <div class="card-body p-2 {{ $course->is_active ? '' : 'bg-inactive' }}">
                        <img src="{{ asset($course->image) }}" class="w-100 mb-1 aspect-ratio-11">
                        <div class="mb-1">
                            <p class="mb-0 text-primary">{{ $course->name }}</p>
                            <p class="mb-0">{{ __('app.category') }}: {{ $course->category?->name }}</p>
                            <p class="mb-0">{{ __('app.level') }}: {{ $course->level?->name }}</p>
                            <p class="mb-0">{{ __('app.price') }}: {{ numberFormat($course->price) }}</p>
                        </div>
                        <p class="mb-0 float-end">
                            <a href="{{ route('admin.course.detail', ['course' => $course->id]) }}" class="btn btn-sm btn-primary mb-1" title="{{ __('app.detail') }}">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.toggle_active') }}"
                               onclick="commonToggleActive('{{ route('admin.course.update', ['course' => $course->id]) }}', {{ $course->is_active }})">
                                <i class="fa-solid fa-power-off"></i>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                               onclick="commonDelete('{{ route('admin.course.destroy', ['course' => $course->id]) }}')">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

{!! renderPagination($courses) !!}

{!! renderSearchEmpty($courses) !!}
