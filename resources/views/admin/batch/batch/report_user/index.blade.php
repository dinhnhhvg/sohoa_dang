@extends(env('APP_VIEW_PATH_ADMIN').'.layout')

@section('content')
    <div class="content-title">
        <div class="pagetitle d-sm-flex align-items-center justify-content-between pb-3">
            <h1>{{ __('app.report_user') }}</h1>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('app.admin') }}</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('admin.batch.report_user') }}">{{ __('app.report_user') }}</a></li>
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
                            <h5 class="card-title mb-0">{{ __('app.report') }}</h5>
                            <div>
                                <div class="btn-group float-end">
                                    <button type="button" class="btn btn-primary me-2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('app.advanced') }}</button>
                                    <div class="dropdown-menu"></div>
                                    <button type="button" class="btn btn-primary is-search-button" onclick="changeIsSearch(this)"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.batch.report_user_filter') }}" id="filter-form" class="filter-form d-none" onsubmit="commonFilter(); return false">
                            <input type="hidden" name="orderByName">
                            <input type="hidden" name="orderByType">
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
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group mb-3">
                                                <div class="input-group">
                                                    <input type="text" class="form-control datepicker" name="start_date" value="{{ date('d-m-Y') }}" placeholder="{{ __('app.start_date') }}" data-format="d-m-Y">
                                                    <i class="fa-solid fa-calendar-days"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group mb-3">
                                                <div class="input-group">
                                                    <input type="text" class="form-control datepicker" name="end_date" value="{{ date('d-m-Y') }}" placeholder="{{ __('app.end_date') }}" data-format="d-m-Y">
                                                    <i class="fa-solid fa-calendar-days"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {!! renderSelectPaginateAndSubmit(true) !!}
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
