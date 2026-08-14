<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.history') }}</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="card filter-card">
        <div class="card-header">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h5 class="card-title mb-0">{{ __('app.list') }}</h5>
                <div></div>
            </div>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.coupon.history.filter', ['coupon' => $coupon_id]) }}" id="coupon_history-filter-form" class="filter-form d-none"
                  onsubmit="commonFilter(1, '#coupon_history-filter-form', '#coupon_history-filter-table'); return false">
                <input type="hidden" name="orderByName">
                <input type="hidden" name="orderByType">
                <input type="hidden" name="coupon_id" value="{{ $coupon_id }}">
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

            <div id="coupon_history-filter-table" class="filter-table"></div>
        </div>
    </div>
</div>

<script>
    commonFilter(1, '#coupon_history-filter-form', '#coupon_history-filter-table');
</script>
