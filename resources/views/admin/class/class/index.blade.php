@extends(env('APP_VIEW_PATH_ADMIN').'.layout')

@section('content')
    <div class="content-title">
        <div class="pagetitle d-sm-flex align-items-center justify-content-between pb-3">
            <h1>{{ __('app.class') }}</h1>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('app.admin') }}</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('admin.class.index') }}">{{ __('app.class') }}</a></li>
                </ol>
            </nav>
        </div>
        <hr class="dropdown-divider mb-3">
    </div>

    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card filter-card">
                    <div class="card-header">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h5 class="card-title mb-0">{{ __('app.list') }}</h5>
                            <div>
                                <div class="btn-group float-end">
                                    <a href="javascript:void(0)" class="btn btn-primary me-2" onclick="commonShowModal('{{ route('admin.class.create') }}', '#common-modal-xl')">{{ __('app.create') }}</a>
                                    <button type="button" class="btn btn-primary me-2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('app.advanced') }}</button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0)" data-localStorage-name="adminClasses" onclick="showHideShowColumn(this)">{{ __('app.hide_show_column') }}</a>
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="commonExport('{{ route('admin.class.export') }}', this)">{{ __('app.export_excel') }}</a>
                                    </div>
                                    <button type="button" class="btn btn-primary view-type-button me-2" onclick="renderViewType(this)"></button>
                                    <button type="button" class="btn btn-primary is-search-button" onclick="changeIsSearch(this)"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.class.filter') }}" id="filter-form" class="filter-form d-none" onsubmit="commonFilter(); return false">
                            <input type="hidden" name="orderByName">
                            <input type="hidden" name="orderByType">
                            <input type="hidden" name="viewType">
                            <div class="row">
                                <div class="col-xxl-3 col-sm-12">
                                    <div class="form-group mb-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search_key" autocomplete="off" placeholder="{{ __('app.search') }}...">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-sm-12">
                                    <div class="form-group mb-3">
                                        <select class="form-select select2" name="course_id[]" data-placeholder="{{ __('app.select_course') }}" multiple>
                                            <option value=""></option>
                                            @foreach($courses as $course)
                                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-sm-12">
                                    <div class="form-group mb-3">
                                        <select class="form-select select2" name="type_id[]" data-placeholder="{{ __('app.select_type') }}" multiple>
                                            <option value=""></option>
                                            @foreach($types as $type)
                                                <option value="{{ $type->id }}">{{ __('app.').$type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-sm-12">
                                    <div class="form-group mb-3">
                                        <select class="form-select select2" name="center_id[]" data-placeholder="{{ __('app.select_center') }}" multiple>
                                            <option value=""></option>
                                            @foreach($centers as $center)
                                                <option value="{{ $center->id }}">{{ $center->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-sm-12">
                                    <div class="form-group mb-3">
                                        <select class="form-select select2" name="status_id[]" data-placeholder="{{ __('app.select_status') }}" multiple>
                                            <option value=""></option>
                                            @foreach($statuses as $status)
                                                <option value="{{ $status->id }}">{{ __('app.').$status->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {!! renderSelectPaginateAndSubmit() !!}
                            </div>
                        </form>

                        <div id="filter-table" class="filter-table"></div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js-content')
    <script>
        $(document).ready(function() {
            commonFilter();
        });
    </script>
@endsection
