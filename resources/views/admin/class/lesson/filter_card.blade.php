<div class="card filter-card">
    <div class="card-header">
        <div class="d-sm-flex align-items-center justify-content-between">
            <h5 class="card-title mb-0">{{ __('app.list') }}</h5>
            <div>
                <div class="btn-group float-end">
                    <a href="javascript:void(0)" class="btn btn-primary me-2" onclick="commonShowModal('{{ route('admin.lesson.create', ['class_id' => $class_id]) }}', '#common-modal-lg')">{{ __('app.create') }}</a>
                    <button type="button" class="btn btn-primary me-2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('app.advanced') }}</button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:void(0)" data-localStorage-name="adminLessons" onclick="showHideShowColumn(this)">{{ __('app.hide_show_column') }}</a>
                        <a class="dropdown-item" href="javascript:void(0)" onclick="commonHandleMany(this, '{{ route('admin.lesson.destroy_many') }}')">{{ __('app.delete') }}</a>
                        <a class="dropdown-item" href="javascript:void(0)" onclick="commonExport('{{ route('admin.lesson.export') }}', this)">{{ __('app.export_excel') }}</a>
                    </div>
                    <button type="button" class="btn btn-primary is-search-button" onclick="changeIsSearch(this)"></button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('admin.lesson.filter') }}" id="lesson-filter-form" class="filter-form d-none"
              onsubmit="commonFilter(1, '#lesson-filter-form', '#lesson-filter-table'); return false">
            <input type="hidden" name="orderByName">
            <input type="hidden" name="orderByType">
            <input type="hidden" name="viewType">
            <input type="hidden" name="class_id" value="{{ $class_id }}">
            <div class="row">
                <div class="col-xxl-3 col-sm-12">
                    <div class="form-group mb-3">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search_key" autocomplete="off" placeholder="{{ __('app.search') }}...">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-12 d-none">
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
                        <select class="form-select select2" name="status_id[]" data-placeholder="{{ __('app.select_status') }}" multiple>
                            <option value=""></option>
                            @foreach($statuses as $status)
                                <option value="{{ $status->id }}">{{ __('app.').$status->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-12">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker" name="start_date" placeholder="{{ __('app.start_date') }}" data-format="d-m-Y">
                                    <i class="fa-solid fa-calendar-days"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker" name="end_date" placeholder="{{ __('app.end_date') }}" data-format="d-m-Y">
                                    <i class="fa-solid fa-calendar-days"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {!! renderSelectPaginateAndSubmit() !!}
            </div>
        </form>

        <div id="lesson-filter-table" class="filter-table"></div>
    </div>
</div>

<script>
    commonFilter(1, '#lesson-filter-form', '#lesson-filter-table');
</script>
