<div class="row">
    <div class="col-xxl-8 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5 class="modal-title text-primary">{{ __('app.show') }}</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-4 text-primary mb-2">{{ __('app.name') }}</div>
                    <div class="col-8">{{ $class->name }} <span class="text-danger">{{ $class->code }}</span></div>

                    <div class="col-4 text-primary mb-2">{{ __('app.course') }}</div>
                    <div class="col-8">{{ $class->coursetype->course->name }} <span class="text-danger">{{ $class->coursetype->course->code }}</span></div>

                    <div class="col-4 text-primary mb-2">{{ __('app.course_type') }}</div>
                    <div class="col-8">{{ __('app.'.$class->coursetype->type->name) }}</div>

                    @if($class->start_date && $class->end_date)
                        <div class="col-4 text-primary mb-2">{{ __('app.time') }}</div>
                        <div class="col-8">{{ $class->start_date->format('d-m-Y') }} - {{ $class->end_date->format('d-m-Y') }}</div>
                    @endif

                    <div class="col-4 text-primary mb-2">{{ __('app.status') }}</div>
                    <div class="col-8"><span class="badge bg-primary">{{ __('app.'.$class->status?->name) }}</span></div>

                    @if($class->center)
                        <div class="col-4 text-primary mb-2">{{ __('app.center') }}</div>
                        <div class="col-8">{{ $class->center?->name }}</div>
                    @endif

                    @if($class->classroom)
                        <div class="col-4 text-primary mb-2">{{ __('app.classroom') }}</div>
                        <div class="col-8">{{ $class->classroom?->name }}</div>
                    @endif

                    <div class="col-4 text-primary mb-2">{{ __('app.schedule') }}</div>
                    <div class="col-8">{{ $class->schedule }}</div>

                    <div class="col-4 text-primary mb-2">{{ __('app.description') }}</div>
                    <div class="col-8">{!! $class->description !!}</div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-5 text-primary mb-2">{{ __('app.student') }}</div>
                            <div class="col-7">
                                @if($class->capacity)
                                    {{ $class->class_customers_count ?: 0 }}/{{ $class->capacity }}
                                @else
                                    {{ $class->class_customers_count }}
                                @endif
                            </div>

                            @if($class->lessons_count)
                                <div class="col-5 text-primary mb-2">{{ __('app.lesson') }}</div>
                                <div class="col-7">{{ $class->lesson_done_count ?: 0 }}/{{ $class->lessons_count }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-6">
                        @if($class->lessons_count)
                            @php
                                $rateNumber = round($class->lesson_done_count/$class->lessons_count*100);
                                $rateTitle =  __('app.lesson').'<br>'.$class->lesson_done_count.'/'.$class->lessons_count;
                            @endphp
                            {!! renderPercentCircle($rateNumber, $rateTitle) !!}
                        @endif

                        @if($class->start_date && $class->end_date)
                            {!! renderTimeProgress($class->start_date, $class->end_date) !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xxl-4 col-sm-12">
        <div class="card h-100">
            <div class="card-body">

            </div>
        </div>
    </div>
</div>
