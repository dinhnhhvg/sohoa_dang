@if($viewType === 'table')
    <div class="table-responsive">
        <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100" data-sticky-column="2">
            <thead>
            <tr>
                <th class="w-40px">#</th>
                <th>{!! renderThSort(__('app.code'), 'classes.code', $orderByName, $orderByType) !!}</th>
                <th class="min-w-220px">{!! renderThSort(__('app.name'), 'classes.name', $orderByName, $orderByType) !!}</th>
                <th class="min-w-220px">{{ __('app.course') }}</th>
                <th>{{ __('app.course_type') }}</th>
                <th>{!! renderThSort(__('app.start_date'), 'classes.start_date', $orderByName, $orderByType) !!}</th>
                <th>{!! renderThSort(__('app.end_date'), 'classes.end_date', $orderByName, $orderByType) !!}</th>
                <th>{{ __('app.center') }}</th>
                <th>{{ __('app.classroom') }}</th>
                <th>{{ __('app.schedule') }}</th>
                <th>{{ __('app.customer') }}</th>
                <th>{{ __('app.lesson') }}</th>
                <th>{{ __('app.status') }}</th>
                <th class="min-w-100px">{{ __('app.action') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($classes as $i => $class)
                <tr style="background-color: {{ $class->status->bg_color }}">
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td class="text-center text-nowrap">{{ $class->code }}</td>
                    <td>
                        <a href="{{ route('admin.class.detail', ['class' => $class->id]) }}"><strong>{{ $class->name }}</strong></a>
                    </td>
                    <td>{{ $class->courseType->course->name }}</td>
                    <td class="text-nowrap">{{ __('app.'.$class->courseType->type->code) }}</td>
                    <td class="text-center text-nowrap">{{ $class->start_date?->format('d-m-Y') }}</td>
                    <td class="text-center text-nowrap">{{ $class->end_date?->format('d-m-Y') }}</td>
                    <td class="text-center text-nowrap">{{ $class->center?->name }}</td>
                    <td class="text-center text-nowrap">{{ $class->classroom?->name }}</td>
                    <td class="text-center text-nowrap">{{ $class->schedule }}</td>
                    <td class="text-center text-nowrap">
                        @if($class->capacity)
                            {{ $class->class_customers_count ?: 0 }}/{{ $class->capacity }}
                        @else
                            {{ $class->class_customers_count }}
                        @endif
                    </td>
                    <td class="text-center text-nowrap">
                        @if($class->lessons_count)
                            {{ $class->lesson_done_count ?: 0 }}/{{ $class->lessons_count }}
                        @endif
                    </td>
                    <td class="text-center">
                        <span class="badge bg-primary">{{ __('app.').$class->status->name }}</span>
                    </td>
                    <td class="text-center">
                        <a href="javascript:void(0)" class="btn btn-sm btn-success mb-1" title="{{ __('app.edit') }}"
                           onclick="commonShowModal('{{ route('admin.class.edit', ['class' => $class->id]) }}', '#common-modal-xl')">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="{{ route('admin.class.detail', ['class' => $class->id]) }}" class="btn btn-sm btn-primary mb-1" title="{{ __('app.detail') }}">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                           onclick="commonDelete('{{ route('admin.class.destroy', ['class' => $class->id]) }}')">
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
        @foreach($classes as $i => $class)
            <div class="col-xxl-3 col-xl-4 col-md-6 mb-3">
                <div class="card card-profile">
                    <div class="card-body p-2">
                        <div class="mb-3">
                            @if($class->lessons_count)
                                @php
                                    $rateNumber = round($class->lesson_done_count/$class->lessons_count*100);
                                    $rateTitle =  __('app.lesson').'<br>'.$class->lesson_done_count.'/'.$class->lessons_count;
                                @endphp
                                {!! renderPercentCircle($rateNumber, $rateTitle) !!}
                            @else
                                {!! renderPercentCircle(0, $class->code) !!}
                            @endif
                            {!! renderTimeProgress($class->start_date, $class->end_date) !!}
                        </div>
                        <div class="mb-1">
                            <p class="mb-0 text-primary">{{ $class->name }} <span class="text-danger">{{ $class->code }}</span></p>
                            <p class="mb-0">{{ __('app.course') }}: {{ $class->courseType->course->name }}</p>
                            <p class="mb-0">{{ __('app.course_type') }}: {{ __('app.'.$class->courseType->type->name) }}</p>
                            <p class="mb-0">{{ __('app.status') }}: <span class="badge bg-primary">{{ __('app.'.$class->status?->name) }}</span></p>
                            <p class="mb-0">{{ __('app.center') }}: {{ $class->center?->name }}</p>
                            <p class="mb-0">{{ __('app.schedule') }}: {{ $class->schedule }}</p>
                        </div>
                        <p class="mb-0 float-end">
                            <a href="javascript:void(0)" class="btn btn-sm btn-success mb-1" title="{{ __('app.edit') }}"
                               onclick="commonShowModal('{{ route('admin.class.edit', ['class' => $class->id]) }}', '#common-modal-xl')">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="{{ route('admin.class.detail', ['class' => $class->id]) }}" class="btn btn-sm btn-primary mb-1" title="{{ __('app.detail') }}">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                               onclick="commonDelete('{{ route('admin.class.destroy', ['class' => $class->id]) }}')">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

{!! renderPagination($classes) !!}

{!! renderSearchEmpty($classes) !!}
