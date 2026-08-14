<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.payment') }}</h4>
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
                           onclick="commonShowModal('{{ route('admin.payment.create', ['order_id' => $order_id]) }}', '#common-modal-lg')">
                            {{ __('app.create') }}
                        </a>
                        <button type="button" class="btn btn-primary is-search-button" onclick="changeIsSearch(this)"></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.payment.filter') }}" id="payment-filter-form" class="filter-form d-none"
                  onsubmit="commonFilter(1, '#payment-filter-form', '#payment-filter-table'); return false">
                <input type="hidden" name="orderByName">
                <input type="hidden" name="orderByType">
                <input type="hidden" name="order_id" value="{{ $order_id ?? null }}">
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
                            <select class="form-select select2" name="payment_method_id[]" data-placeholder="{{ __('app.select_payment_method') }}" multiple>
                                <option value=""></option>
                                @foreach($paymentMethods as $paymentMethod)
                                    <option value="{{ $paymentMethod->id }}">{{ $paymentMethod->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-sm-12">
                        <div class="form-group mb-3">
                            <select class="form-select select2" name="status_id[]" data-placeholder="{{ __('app.select_status') }}" multiple>
                                <option value=""></option>
                                @foreach($statuses as $status)
                                    <option value="{{ $status->id }}">{{ __('app.'.$status->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {!! renderSelectPaginateAndSubmit(true) !!}
                </div>
            </form>

            <div id="payment-filter-table" class="filter-table"></div>
        </div>
    </div>
</div>

<script>
    commonFilter(1, '#payment-filter-form', '#payment-filter-table');
</script>
