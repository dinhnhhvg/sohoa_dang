@extends(env('APP_VIEW_PATH_ADMIN').'.layout')

@section('content')
    <div class="content-title">
        <div class="pagetitle d-sm-flex align-items-center justify-content-between pb-3">
            <h1>{{ __('app.entry_check') }}</h1>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('app.admin') }}</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('admin.judgment.index') }}">{{ __('app.entry_check') }}</a></li>
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
                                        <a class="dropdown-item" href="javascript:void(0)" data-localStorage-name="adminJudgments" onclick="showHideShowColumn(this)">{{ __('app.hide_show_column') }}</a>
                                    </div>
                                    <button type="button" class="btn btn-primary is-search-button" onclick="changeIsSearch(this)"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.judgment.filter') }}" id="judgment-filter-form" class="filter-form d-none"
                              onsubmit="commonFilter(1, '#judgment-filter-form', '#judgment-filter-table'); return false">
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
                                        <select class="form-select select2" name="batch_id[]" data-placeholder="{{ __('app.select_batch') }}" multiple>
                                            <option></option>
                                            @foreach($batches as $batch)
                                                <option value="{{ $batch->id }}">{{ $batch->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-sm-12">
                                    <div class="form-group mb-3">
                                        <select class="form-select select2" name="tenure_period_id[]" data-placeholder="{{ __('app.select') }} {{ __('app.tenure_period') }}" multiple>
                                            <option></option>
                                            @foreach($tenurePeriods as $tenurePeriod)
                                                <option value="{{ $tenurePeriod->id }}">{{ $tenurePeriod->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-sm-12">
                                    <div class="form-group mb-3">
                                        <select class="form-select select2" name="font_id[]" data-placeholder="{{ __('app.select') }} {{ __('app.font') }}" multiple>
                                            <option></option>
                                            @foreach($fonts as $font)
                                                <option value="{{ $font->id }}">{{ renderCodeName($font) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-sm-12">
                                    <div class="form-group mb-3">
                                        <select class="form-select select2" name="entry_id[]" data-placeholder="{{ __('app.entry') }}" multiple>
                                            <option></option>
                                            @foreach($entries as $entry)
                                                <option value="{{ $entry->id }}">{{ $entry->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-sm-12">
                                    <div class="form-group mb-3">
                                        <select class="form-select select2" name="checker_id[]" data-placeholder="{{ __('app.check') }}" multiple>
                                            <option></option>
                                            @foreach($checkers as $checker)
                                                <option value="{{ $checker->id }}" {{ session('user_id') == $checker->id ? 'selected' : '' }}>
                                                    {{ $checker->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-sm-12">
                                    <div class="form-group mb-3">
                                        <select class="form-select select2" name="description_status" data-placeholder="Trạng thái mô tả">
                                            <option></option>
                                            <option value="0">Không có thông tin</option>
                                            <option value="1">Có thông tin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-sm-12">
                                    <div class="form-group mb-3">
                                        <select class="form-select select2" name="status_id[]" data-placeholder="{{ __('app.select_status') }}" multiple>
                                            <option></option>
                                            @foreach($statuses as $is => $status)
                                                <option value="{{ $status->id }}" {{ $is == 0 ? 'selected' : '' }}>
                                                    {{ __('app.'.$status->name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {!! renderSelectPaginateAndSubmit() !!}
                            </div>
                        </form>

                        <div id="judgment-filter-table" class="filter-table"></div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js-content')
    <script>
        $(document).ready(function() {
            commonFilter(1, '#judgment-filter-form', '#judgment-filter-table');
        });
    </script>
@endsection
