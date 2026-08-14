@if(isset($class_customer_id))
    <div class="modal-header">
        <h4 class="modal-title text-primary">{{ __('app.lesson') }}</h4>
        <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="card filter-card">
            <div class="card-header">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0">{{ __('app.list') }}</h5>
                    <div>
                        <div class="btn-group float-end">
                            <a href="javascript:void(0)" class="btn btn-primary me-2" onclick="commonShowModal('{{ route('admin.lesson_customer.create', ['class_id' => $class_id, 'class_customer_id' => $class_customer_id]) }}')">{{ __('app.create') }}</a>
                            <button type="button" class="btn btn-primary dropdown-toggle me-2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('app.advanced') }}</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0)" data-localStorage-name="adminLessonCustomers" onclick="showHideShowColumn(this)">{{ __('app.hide_show_column') }}</a>
                                <a class="dropdown-item" href="javascript:void(0)" onclick="commonHandleMany(this, '{{ route('admin.lesson_customer.destroy_many') }}')">{{ __('app.delete') }}</a>
                            </div>
                            <button type="button" class="btn btn-primary is-search-button" onclick="changeIsSearch(this)"></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('admin.lesson_customer.filter') }}" id="lesson_customer-filter-form" class="filter-form d-none"
                      onsubmit="commonFilter(1, '#lesson_customer-filter-form', '#lesson_customer-filter-table'); return false">
                    <input type="hidden" name="orderByName">
                    <input type="hidden" name="orderByType">
                    <input type="hidden" name="viewType">
                    <input type="hidden" name="class_customer_id" value="{{ $class_customer_id }}">
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

                <div id="lesson_customer-filter-table" class="filter-table"></div>
            </div>
        </div>
    </div>

    <script>
        commonFilter(1, '#lesson_customer-filter-form', '#lesson_customer-filter-table');
    </script>
@else
    <div class="modal-header">
        <h4 class="modal-title text-primary">{{ __('app.student') }}</h4>
        <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="card filter-card">
            <div class="card-header">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0">{{ __('app.list') }}</h5>
                    <div>
                        <div class="btn-group float-end">
                            <a href="javascript:void(0)" class="btn btn-primary me-2" onclick="commonShowModal('{{ route('admin.lesson_customer.create', ['class_id' => $class_id, 'lesson_id' => $lesson_id]) }}')">{{ __('app.create') }}</a>
                            <button type="button" class="btn btn-primary dropdown-toggle me-2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('app.advanced') }}</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0)" onclick="commonHandleMany(this, '{{ route('admin.lesson_customer.update_many') }}', '{{ __('admin_message_are-you_sure_attendance_many') }}')">
                                    {{ __('app.attendance') }}
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)" onclick="commonHandleMany(this, '{{ route('admin.lesson_customer.destroy_many') }}')">
                                    {{ __('app.delete') }}
                                </a>
                            </div>
                            <button type="button" class="btn btn-primary is-search-button" onclick="changeIsSearch(this)"></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('admin.lesson_customer.filter') }}" id="customer_lesson-filter-form" class="filter-form d-none"
                      onsubmit="commonFilter(1, '#customer_lesson-filter-form', '#customer_lesson-filter-table'); return false">
                    <input type="hidden" name="orderByName">
                    <input type="hidden" name="orderByType">
                    <input type="hidden" name="viewType">
                    <input type="hidden" name="lesson_id" value="{{ $lesson_id }}">
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

                <div id="customer_lesson-filter-table" class="filter-table"></div>
            </div>
        </div>
    </div>

    <script>
        commonFilter(1, '#customer_lesson-filter-form', '#customer_lesson-filter-table');
    </script>
@endif
