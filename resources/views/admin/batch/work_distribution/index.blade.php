@extends(env('APP_VIEW_PATH_ADMIN').'.layout')

@section('content')
    <div class="content-title">
        <div class="pagetitle d-sm-flex align-items-center justify-content-between pb-3">
            <h1>{{ __('app.work_distribution') }}</h1>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('app.admin') }}</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('admin.work_distribution.index') }}">{{ __('app.work_distribution') }}</a></li>
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
                                        <a class="dropdown-item" href="javascript:void(0)" data-localStorage-name="adminWorkDistributions" onclick="showHideShowColumn(this)">{{ __('app.hide_show_column') }}</a>
                                    </div>
                                    <button type="button" class="btn btn-primary is-search-button" onclick="changeIsSearch(this)"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.work_distribution.filter') }}" id="filter-form" class="filter-form d-none" onsubmit="commonFilter(); return false">
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
                                    <div class="form-group mb-3">
                                        <select class="form-select select2" name="agency_id[]" data-placeholder="{{ __('app.select_agency') }}" multiple>
                                            <option></option>
                                            @foreach($oldAgencies as $agency)
                                                <option value="{{ $agency->id }}">{{ $agency->code }}-{{ $agency->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-sm-12">
                                    <div class="form-group mb-3">
                                        <select class="form-select select2" name="status_id[]" data-placeholder="{{ __('app.select_status') }}" multiple>
                                            <option></option>
                                            @foreach($statuses as $is => $status)
                                                <option value="{{ $status->id }}" {{ $is <= 1 ? 'selected' : '' }}>
                                                    {{ __('app.'.$status->name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {!! renderSelectPaginateAndSubmit(false) !!}
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
