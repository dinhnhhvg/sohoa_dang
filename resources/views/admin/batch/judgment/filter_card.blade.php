<div class="card filter-card">
    <div class="card-header">
        <div class="d-sm-flex align-items-center justify-content-between">
            <h5 class="card-title mb-0">{{ __('app.list') }}</h5>
            <div>
                <div class="btn-group float-end">
                    <button type="button" class="btn btn-primary me-2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('app.advanced') }}</button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:void(0)" data-localStorage-name="adminJudgments" onclick="showHideShowColumn(this)">
                            {{ __('app.hide_show_column') }}
                        </a>
                        @if(session('role_code') == 'admin')
                            <a class="dropdown-item" href="javascript:void(0)" onclick="commonShowModal('{{ route('admin.judgment.show_work_distribution', ['batch_id' => $batch_id]) }}', '#common-modal-lg', this, true)">
                                {{ __('app.work_distribution') }}
                            </a>
                            <a class="dropdown-item" href="javascript:void(0)" onclick="commonHandleMany(this, '{{ route('admin.judgment.destroy_many_entry') }}', '{{ __('app.destroy_entry') }}')">
                                {{ __('app.destroy_entry') }}
                            </a>
                            <a class="dropdown-item" href="javascript:void(0)" onclick="commonHandleMany(this, '{{ route('admin.judgment.destroy_many_checker') }}', '{{ __('app.destroy_checker') }}')">
                                {{ __('app.destroy_checker') }}
                            </a>
                        @endif
                    </div>
                    <button type="button" class="btn btn-primary is-search-button" onclick="changeIsSearch(this)"></button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('admin.judgment.filter') }}" id="judgment-filter-form" class="filter-form d-none"
              onsubmit="commonFilter(1, '#judgment-filter-form', '#judgment-filter-table'); return false">
            <input type="hidden" name="batch_id" value="{{ $batch_id }}">
            <input type="hidden" name="orderByName">
            <input type="hidden" name="orderByType">
            <div class="row">
                <div class="col-xxl-3 col-sm-12">
                    <div class="form-group mb-3">
                        <input type="text" class="form-control" name="search_key" placeholder="{{ __('app.search') }}">
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-12">
                    <div class="form-group mb-3">
                        <select class="form-select select2" name="is_after_merge" data-placeholder="{{ __('app.merge') }}">
                            <option value="0">{{ __('app.after_merge') }}</option>
                            <option value="1">{{ __('app.before_merge') }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-12">
                    <div class="form-group mb-3">
                        <select class="form-select select2" name="status_id[]" multiple data-placeholder="{{ __('app.select_status') }}">
                            <option></option>
                            @foreach($statuses as $status)
                                <option value="{{ $status->id }}">{{ __('app.'.$status->name) }}</option>
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
                        <select class="form-select select2" name="entry_id[]" multiple data-placeholder="{{ __('app.batch_entry') }}">
                            <option></option>
                            <option value="0">{{ __('app.no_user') }}</option>
                            @foreach($entries as $entry)
                                <option value="{{ $entry->id }}">{{ $entry->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-12">
                    <div class="form-group mb-3">
                        <select class="form-select select2" name="checker_id[]" multiple data-placeholder="{{ __('app.batch_checker') }}">
                            <option></option>
                            <option value="0">{{ __('app.no_user') }}</option>
                            @foreach($checkers as $checker)
                                <option value="{{ $checker->id }}">{{ $checker->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-12">
                    <div class="form-group mb-3">
                        <select class="form-select select2" name="check_number_rate_status" data-placeholder="{{ __('app.check') }}">
                            <option></option>
                            <option value="1">{{ __('app.success') }}</option>
                            <option value="0">{{ __('app.error') }}</option>
                        </select>
                    </div>
                </div>
                {!! renderSelectPaginateAndSubmit() !!}
            </div>
        </form>

        <div id="judgment-filter-table" class="filter-table">
            //
        </div>
    </div>
</div>

<script>
    commonFilter(1, '#judgment-filter-form', '#judgment-filter-table');
</script>
