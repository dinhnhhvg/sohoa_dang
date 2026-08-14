@extends(env('APP_VIEW_PATH_ADMIN').'.layout')

@section('content')
    <div class="content-title">
        <div class="pagetitle d-sm-flex align-items-center justify-content-between pb-3">
            <h1>{{ __('app.class') }}: {{ $class->name }} <span class="text-danger">{{ $class->code }}</span></h1>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('app.admin') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.class.index') }}">{{ __('app.class') }}</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('admin.class.detail', ['class' => $class->id]) }}">{{ __('app.detail') }}</a></li>
                </ol>
            </nav>
        </div>
        <hr class="dropdown-divider mb-3">
    </div>

    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-0">
                        <ul class="nav nav-tabs nav-tabs-bordered nav-class" role="tablist">
                            <li class="nav-item nav-item-tab-show" role="presentation" onclick="commonShowTab('{{ route('admin.class.show', ['class' => $class->id]) }}', this)">
                                <a href="javascript:void(0)" class="nav-link p-3 active" data-bs-toggle="tab" data-bs-target="#tab-show" aria-selected="true" role="tab">
                                    <h5 class="mb-0">{{ __('app.show') }}</h5>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation" onclick="commonShowTab('{{ route('admin.class_customer.filter_card', ['class_id' => $class->id]) }}', this)">
                                <a href="javascript:void(0)" class="nav-link p-3" data-bs-toggle="tab" data-bs-target="#tab-class-customer" aria-selected="false" role="tab" tabindex="-1">
                                    <h5 class="mb-0">{{ __('app.student') }}</h5>
                                </a>
                            </li>
                            @if($class->courseType->type->code !== 'course_video')
                                <li class="nav-item" role="presentation" onclick="commonShowTab('{{ route('admin.lesson.filter_card', ['class_id' => $class->id]) }}', this)">
                                    <a href="javascript:void(0)" class="nav-link p-3" data-bs-toggle="tab" data-bs-target="#tab-lesson" aria-selected="false" role="tab" tabindex="-1">
                                        <h5 class="mb-0">{{ __('app.lesson') }}</h5>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation" onclick="commonShowTab('{{ route('admin.lesson_schedule.filter_card', ['class_id' => $class->id]) }}', this)">
                                    <a href="javascript:void(0)" class="nav-link p-3" data-bs-toggle="tab" data-bs-target="#tab-lesson-schedule" aria-selected="false" role="tab" tabindex="-1">
                                        <h5 class="mb-0">{{ __('app.lesson_schedule') }} ({{ __('app.week') }})</h5>
                                    </a>
                                </li>
                            @endif
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade p-3 active show" id="tab-show" role="tabpanel"></div>
                            <div class="tab-pane fade p-3" id="tab-edit" role="tabpanel"></div>
                            <div class="tab-pane fade p-3" id="tab-class-customer" role="tabpanel"></div>
                            @if($class->courseType->type->code !== 'course_video')
                                <div class="tab-pane fade p-3" id="tab-lesson" role="tabpanel"></div>
                                <div class="tab-pane fade p-3" id="tab-lesson-schedule" role="tabpanel"></div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js-content')
    <script>
        $(document).ready(function() {
            $('ul.nav-class a[data-bs-target="#tab-show"]').trigger('click');
        });
    </script>
@endsection
