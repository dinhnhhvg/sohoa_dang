<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.judgment_document') }}</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="card filter-card">
        <div class="card-header">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h5 class="card-title mb-0">{{ __('app.list') }}</h5>
                <div>
                    <div class="btn-group float-end">
                        <button type="button" class="btn btn-primary dropdown-toggle me-2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('app.advanced') }}</button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="javascript:void(0)" data-localStorage-name="adminJudgmentDocuments" onclick="showHideShowColumn(this)">{{ __('app.hide_show_column') }}</a>
                        </div>
                        <button type="button" class="btn btn-primary is-search-button" onclick="changeIsSearch(this)"></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.judgment_document.filter') }}" id="judgment_document-filter-form" class="filter-form d-none"
                  onsubmit="commonFilter(1, '#judgment_document-filter-form', '#judgment_document-filter-table'); return false">
                <input type="hidden" name="orderByName">
                <input type="hidden" name="orderByType">
                <input type="hidden" name="viewType">
                <input type="hidden" name="judgment_id" value="{{ $judgment->id }}">
                <div class="row">
                    <div class="col-xxl-3 col-sm-12">
                        <div class="form-group mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search_key" autocomplete="off" placeholder="{{ __('app.search') }}...">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </div>
                        </div>
                    </div>

                    {!! renderSelectPaginateAndSubmit(true) !!}
                </div>
            </form>

            <div id="judgment_document-filter-table" class="filter-table"></div>
        </div>
    </div>
</div>

<script>
    commonFilter(1, '#judgment_document-filter-form', '#judgment_document-filter-table');
</script>
