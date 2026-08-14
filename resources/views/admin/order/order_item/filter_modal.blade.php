<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.show') }}</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="card filter-card">
        <div class="card-header">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h5 class="card-title mb-0">{{ __('app.list') }}</h5>
                <div>
                    <div class="btn-group float-end">
                        <a href="javascript:void(0)" class="btn btn-primary me-2"
                           onclick="commonShowModal('{{ route('admin.order_item.create', ['order_id' => $order_id, 'type_code' => $type_code]) }}', '#common-modal-lg')">
                            {{ __('app.create') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="d-none">
                <form method="GET" action="{{ route('admin.order_item.filter') }}" id="order_item-filter-form" class="filter-form d-none"
                      onsubmit="commonFilter(1, '#order_item-filter-form', '#order_item-filter-table'); return false">
                    <input type="hidden" name="order_id" value="{{ $order_id ?? null }}">
                    <input type="hidden" name="type_code" value="{{ $type_code ?? null }}">
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
            </div>

            <div id="order_item-filter-table" class="filter-table"></div>
        </div>
    </div>
</div>

<script>
    commonFilter(1, '#order_item-filter-form', '#order_item-filter-table');
</script>
