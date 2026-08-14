@extends(env('APP_VIEW_PATH_ADMIN').'.layout')

@section('content')
    <div class="content-title">
        <div class="pagetitle d-sm-flex align-items-center justify-content-between pb-3">
            <h1>{{ __('app.import_log') }}</h1>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('app.admin') }}</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('admin.import_log.index') }}">{{ __('app.import_log') }}</a></li>
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
                                    <button type="button" class="btn btn-primary me-2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('app.advanced') }}</button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0)" data-localStorage-name="adminImportLogs" onclick="showHideShowColumn(this)">{{ __('app.hide_show_column') }}</a>
                                    </div>
                                    <button type="button" class="btn btn-primary is-search-button" onclick="changeIsSearch(this)"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.import_log.filter') }}" id="filter-form" class="filter-form d-none" onsubmit="commonFilter(); return false">
                            <input type="hidden" name="orderByName">
                            <input type="hidden" name="orderByType">
                            <input type="hidden" name="viewType">
                            <div class="row">
                                <div class="col-xxl-3 col-sm-12">
                                    <div class="form-group mb-3">
                                        <select class="form-select select2" name="module[]" data-placeholder="{{ __('app.select_module') }}" multiple>
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-sm-12">
                                    <div class="form-group mb-3">
                                        <select class="form-select select2" name="user_id[]" data-placeholder="{{ __('app.select_user') }}" multiple>
                                            <option value=""></option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-sm-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group mb-3">
                                                <div class="input-group">
                                                    <input type="text" class="form-control datepicker" name="start_date" placeholder="{{ __('app.start_date') }}" data-format="d-m-Y" required>
                                                    <i class="fa-solid fa-calendar-days"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group mb-3">
                                                <div class="input-group">
                                                    <input type="text" class="form-control datepicker" name="end_date" placeholder="{{ __('app.end_date') }}" data-format="d-m-Y" required>
                                                    <i class="fa-solid fa-calendar-days"></i>
                                                </div>
                                            </div>
                                        </div>
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
