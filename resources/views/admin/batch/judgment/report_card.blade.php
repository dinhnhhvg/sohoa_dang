<div class="card filter-card">
    <div class="card-header">
        <div class="d-sm-flex align-items-center justify-content-between">
            <h5 class="card-title mb-0">{{ __('app.list') }}</h5>
            <div>
                <div class="btn-group float-end">
                    <button type="button" class="btn btn-primary is-search-button" onclick="changeIsSearch(this)"></button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('admin.judgment.report_filter') }}" id="report-filter-form" class="filter-form d-none"
              onsubmit="commonFilter(1, '#report-filter-form', '#report-filter-table'); return false">
            <input type="hidden" name="batch_id" value="{{ $batch_id }}">
            <div class="row">
                <div class="col-xxl-3 col-sm-12">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker" name="start_date" value="{{ $batch->start_date?->format('d-m-Y') }}" placeholder="{{ __('app.start_date') }}" data-format="d-m-Y">
                                    <i class="fa-solid fa-calendar-days"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker" name="end_date" value="{{ $batch->end_date?->format('d-m-Y') }}" placeholder="{{ __('app.end_date') }}" data-format="d-m-Y">
                                    <i class="fa-solid fa-calendar-days"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-12">
                    <div class="form-group">
                        <select class="form-select select2" name="entry_id[]" multiple data-placeholder="{{ __('app.batch_entry') }}">
                            <option></option>
                            @foreach($batch->entries as $entry)
                                <option value="{{ $entry->id }}">{{ $entry->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-12">
                    <div class="form-group">
                        <select class="form-select select2" name="checker_id[]" multiple data-placeholder="{{ __('app.batch_checker') }}">
                            <option></option>
                            @foreach($batch->checkers as $checker)
                                <option value="{{ $checker->id }}">{{ $checker->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {!! renderSelectPaginateAndSubmit(true) !!}
            </div>
        </form>

        <div id="report-filter-table" class="filter-table"></div>
    </div>
</div>

<script>
    commonFilter(1, '#report-filter-form', '#report-filter-table');
</script>
