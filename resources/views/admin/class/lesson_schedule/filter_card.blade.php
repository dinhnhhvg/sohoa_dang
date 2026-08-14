<div class="card filter-card">
    <div class="card-header">
        <div class="d-sm-flex align-items-center justify-content-between">
            <h5 class="card-title mb-0">{{ __('app.list') }}</h5>
            <div>
                <div class="btn-group float-end">
                    <a href="javascript:void(0)" class="btn btn-primary me-2" onclick="commonShowModal('{{ route('admin.lesson_schedule.create', ['class_id' => $class_id]) }}', '#common-modal-lg')">{{ __('app.create') }}</a>
                    <button type="button" class="btn btn-primary me-2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('app.advanced') }}</button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:void(0)" data-localStorage-name="adminLessonSchedules" onclick="showHideShowColumn(this)">{{ __('app.hide_show_column') }}</a>
                        <a class="dropdown-item" href="javascript:void(0)" onclick="commonShowModal('{{ route('admin.lesson_schedule.create_lesson') }}', '#common-modal-lg', this, true)">{{ __('app.create_lesson_list') }}</a>
                        <a class="dropdown-item" href="javascript:void(0)" onclick="commonHandleMany(this, '{{ route('admin.lesson_schedule.destroy_many') }}')">{{ __('app.delete') }}</a>
                    </div>
                    <button type="button" class="btn btn-primary is-search-button" onclick="changeIsSearch(this)"></button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('admin.lesson_schedule.filter') }}" id="lesson_schedule-filter-form" class="filter-form d-none"
              onsubmit="commonFilter(1, '#lesson_schedule-filter-form', '#lesson_schedule-filter-table'); return false">
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
                <div class="col-xxl-3 col-sm-12">
                    <div class="form-group mb-3">
                        {!! renderSelectDayOfWeek() !!}
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

                {!! renderSelectPaginateAndSubmit() !!}
            </div>
        </form>

        <div id="lesson_schedule-filter-table" class="filter-table"></div>
    </div>
</div>

<script>
    commonFilter(1, '#lesson_schedule-filter-form', '#lesson_schedule-filter-table');
</script>
