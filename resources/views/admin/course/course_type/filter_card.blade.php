<div class="card filter-card">
    <div class="card-header">
        <div class="d-sm-flex align-items-center justify-content-between">
            <h5 class="card-title mb-0">{{ __('app.list') }}</h5>
            <div>
                <div class="btn-group float-end">
                    <a href="javascript:void(0)" class="btn btn-primary me-2" onclick="commonShowModal('{{ route('admin.course_type.create', ['course_id' => $course_id]) }}')">{{ __('app.create') }}</a>
                    <button type="button" class="btn btn-primary is-search-button" onclick="changeIsSearch(this)"></button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('admin.course_type.filter') }}" id="course-type-filter-form" class="filter-form d-none"
              onsubmit="commonFilter(1, '#course-type-filter-form', '#course-type-filter-table'); return false">
            <input type="hidden" name="course_id" value="{{ $course_id }}">
            <div class="row">
                <div class="col-xxl-3 col-sm-12">
                    <div class="form-group mb-3">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search_key" autocomplete="off" placeholder="{{ __('app.search') }}...">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                    </div>
                </div>

                {!! renderSelectPaginateAndSubmit() !!}
            </div>
        </form>

        <div id="course-type-filter-table" class="filter-table"></div>
    </div>
</div>

<script>
    commonFilter(1, '#course-type-filter-form', '#course-type-filter-table');
</script>


