@extends(env('APP_VIEW_PATH_ADMIN').'.layout')

<style>
    .dashboard .sales-card .card-icon {
        color: #4154f1;
        background: #f6f6fe;
    }
    .dashboard .card-icon {
        font-size: 32px;
        line-height: 0;
        width: 64px;
        height: 64px;
        flex-shrink: 0;
        flex-grow: 0;
    }
    .dashboard .info-card h6 {
        font-size: 28px;
        color: #012970;
        font-weight: 700;
        margin: 0;
        padding: 0;
    }
</style>

@section('content')
    <div class="content-title">
        <div class="pagetitle d-sm-flex align-items-center justify-content-between pb-3">
            <h1>{{ __('app.dashboard') }}</h1>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}"><strong>{{ __('app.admin') }}</strong></a></li>
                    <li class="breadcrumb-item active"><strong>{{ __('app.dashboard') }}</strong></li>
                </ol>
            </nav>
        </div>
        <hr class="dropdown-divider mb-3">
    </div>

    <section class="section dashboard">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    @foreach($batchStatuses as $batchStatus)
                        <div class="col-xxl-3 col-md-6">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ __('app.'.$batchStatus->name) }}</h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fas fa-tags"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $batchStatus->batches_count }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Nhân sự online</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="fas fa-tags"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $onlineCount }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card filter-card">
                    <div class="card-header">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h5 class="card-title mb-0">Báo cáo tổng</h5>
                            <div>
                                <div class="btn-group float-end">
                                    <button type="button" class="btn btn-primary is-search-button" onclick="changeIsSearch(this)"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.type.report_batch') }}" id="type-report-batch-filter-form" class="filter-form d-none"
                              onsubmit="commonFilter(1, '#type-report-batch-filter-form', '#type-report-batch-filter-table'); return false">
                            <input type="hidden" name="orderByName">
                            <input type="hidden" name="orderByType">
                            <div class="row">
                                <div class="col-xxl-3 col-sm-12 d-none">
                                    <div class="form-group mb-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control datepicker" name="year" data-format="Y" placeholder="{{ __('app.year') }}">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-sm-12">
                                    <div class="form-group mb-3">
                                        <select class="form-select select2" name="old_agency_id[]" data-placeholder="{{ __('app.select_agency') }}" multiple>
                                            <option></option>
                                            @foreach($oldAgencies as $agency)
                                                <option value="{{ $agency->id }}">{{ renderCodeName($agency) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-sm-12">
                                    <div class="form-group mb-3">
                                        <select class="form-select select2" name="status_id[]" data-placeholder="{{ __('app.select_status') }}" multiple>
                                            <option></option>
                                            @foreach($statuses as $status)
                                                <option value="{{ $status->id }}">{{ __('app.'.$status->name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {!! renderSelectPaginateAndSubmit(true) !!}
                            </div>
                        </form>

                        <div id="type-report-batch-filter-table" class="filter-table"></div>
                    </div>
                </div>

                <div class="card filter-card">
                    <div class="card-header">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h5 class="card-title mb-0">Sản lượng số hóa</h5>
                            <div>
                                <div class="btn-group float-end">
                                    <button type="button" class="btn btn-primary is-search-button" onclick="changeIsSearch(this)"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.judgment.report_filter') }}" id="judgment-report-filter-form" class="filter-form d-none"
                              onsubmit="commonFilter(1, '#judgment-report-filter-form', '#judgment-report-filter-table'); return false">
                            <div class="row">
                                <div class="col-xxl-6 col-sm-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group mb-3">
                                                <div class="input-group">
                                                    <input type="text" class="form-control datepicker" name="start_date" value="{{ $lastToday->format('d-m-Y') }}" placeholder="{{ __('app.start_date') }}" data-format="d-m-Y">
                                                    <i class="fa-solid fa-calendar-days"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group mb-3">
                                                <div class="input-group">
                                                    <input type="text" class="form-control datepicker" name="end_date" value="{{ $today->format('d-m-Y') }}" placeholder="{{ __('app.end_date') }}" data-format="d-m-Y">
                                                    <i class="fa-solid fa-calendar-days"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {!! renderSelectPaginateAndSubmit(true) !!}
                            </div>
                        </form>

                        <div id="judgment-report-filter-table" class="filter-table"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js-content')
    <script>
        $(document).ready(function() {
            commonFilter(1, '#judgment-report-filter-form', '#judgment-report-filter-table');
            commonFilter(1, '#type-report-batch-filter-form', '#type-report-batch-filter-table');
        });
    </script>
@endsection

