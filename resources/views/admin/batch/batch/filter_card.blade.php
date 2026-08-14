<div class="card filter-card">
    <div class="card-header">
        <div class="d-sm-flex align-items-center justify-content-between">
            <h5 class="card-title mb-0">{{ __('app.list') }}</h5>
            <div>
                <div class="btn-group float-end">
                    <a href="javascript:void(0)" class="btn btn-primary me-2" onclick="commonShowModal('{{ route('admin.project_batch.create', ['project_id' => $project_id]) }}', '#common-modal-lg')">{{ __('app.create') }}</a>
                    <button type="button" class="btn btn-primary me-2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('app.advanced') }}</button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:void(0)" data-localStorage-name="adminProjectBatches" onclick="showHideShowColumn(this)">{{ __('app.hide_show_column') }}</a>
                        <a class="dropdown-item" href="javascript:void(0)" onclick="commonExport('{{ route('admin.project_batch.export') }}', this)">{{ __('app.export_excel') }}</a>
                    </div>
                    <button type="button" class="btn btn-primary is-search-button" onclick="changeIsSearch(this)"></button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('admin.project_batch.filter') }}" id="project_batch-filter-form" class="filter-form d-none"
              onsubmit="commonFilter(1, '#project_batch-filter-form', '#project_batch-filter-table'); return false">
            <input type="hidden" name="project_id" value="{{ $project_id }}">
            <input type="hidden" name="orderByName">
            <input type="hidden" name="orderByType">
            <div class="row">
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

                {!! renderSelectPaginateAndSubmit() !!}
            </div>
        </form>

        <div id="project_batch-filter-table" class="filter-table">
            //
        </div>
    </div>
</div>

<script>
    commonFilter(1, '#project_batch-filter-form', '#project_batch-filter-table');
</script>
