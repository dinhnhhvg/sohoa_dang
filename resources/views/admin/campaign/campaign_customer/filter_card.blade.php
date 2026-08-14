<div class="card filter-card">
    <div class="card-header">
        <div class="d-sm-flex align-items-center justify-content-between">
            <h5 class="card-title mb-0">{{ __('app.list') }}</h5>
            <div>
                <div class="btn-group float-end">
                    <button type="button" class="btn btn-primary me-2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('app.advanced') }}</button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:void(0)" data-localStorage-name="adminCampaignCustomers" onclick="showHideShowColumn(this)">
                            {{ __('app.hide_show_column') }}
                        </a>
                        <a class="dropdown-item" href="javascript:void(0)"
                           onclick="commonShowModal('{{ route('admin.campaign_customer.edit_sale_many', ['campaign_id' => $campaign_id]) }}', '#common-modal-md', this, true)">
                            {{ __('app.message.change_sale') }}
                        </a>
                        <a class="dropdown-item" href="javascript:void(0)" onclick="commonHandleMany(this, '{{ route('admin.campaign_customer.destroy_many') }}')">
                            {{ __('app.delete') }}
                        </a>
                        <a class="dropdown-item" href="javascript:void(0)"
                           onclick="commonShowModal('{{ route('admin.campaign_customer.create_import', ['campaign_id' => $campaign_id]) }}', '#common-modal-lg')">
                            {{ __('app.import_excel') }}
                        </a>
                        <a class="dropdown-item" href="javascript:void(0)" onclick="commonExport('{{ route('admin.campaign_customer.export') }}', this)">
                            {{ __('app.export_excel') }}
                        </a>
                    </div>
                    <button type="button" class="btn btn-primary is-search-button" onclick="changeIsSearch(this)"></button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('admin.campaign_customer.filter') }}" id="campaign_customer-filter-form" class="filter-form d-none"
              onsubmit="commonFilter(1, '#campaign_customer-filter-form', '#campaign_customer-filter-table'); return false">
            <input type="hidden" name="orderByName">
            <input type="hidden" name="orderByType">
            <input type="hidden" name="viewType">
            <input type="hidden" name="campaign_id" value="{{ $campaign_id }}">
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

                <div class="col-xxl-3 col-sm-12">
                    <div class="form-group mb-3">
                        <select class="form-select select2" name="sale_id[]" data-placeholder="{{ __('app.select_sale') }}" multiple>
                            <option value=""></option>
                            @foreach($sales as $sale)
                                <option value="{{ $sale->id }}">{{ $sale->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {!! renderSelectPaginateAndSubmit() !!}
            </div>
        </form>

        <div id="campaign_customer-filter-table" class="filter-table"></div>
    </div>
</div>

<script>
    commonFilter(1, '#campaign_customer-filter-form', '#campaign_customer-filter-table');
</script>


