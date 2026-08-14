<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.create') }}</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('admin.coupon.store') }}" onsubmit="commonSubmit(this); return false" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.name') }}<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" required placeholder="{{ __('app.enter_name') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.type') }}<span class="text-danger">*</span></label>
                    <select class="form-select select2" name="type" required>
                        <option value="amount">{{ __('app.amount') }}</option>
                        <option value="percent">{{ __('app.percent') }}</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.value') }}<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="value" onkeyup="addCommas(this)" placeholder="{{ __('app.enter_value') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.limit') }}</label>
                    <input type="number" class="form-control" name="limit" placeholder="{{ __('app.enter_limit') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.quantity') }}<span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="quantity" value="1" required placeholder="{{ __('app.enter_quantity') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('app.min_amount') }}</label>
                            <input type="text" class="form-control" name="min_amount" onkeyup="addCommas(this)" placeholder="{{ __('app.enter_min_amount') }}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('app.max_amount') }}</label>
                            <input type="text" class="form-control" name="max_amount" onkeyup="addCommas(this)" placeholder="{{ __('app.enter_max_amount') }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('app.start_date') }}</label>
                            <div class="input-group">
                                <input type="text" class="form-control datepicker" name="start_date" data-format="d-m-Y" placeholder="{{ __('app.start_date') }}">
                                <i class="fa-solid fa-calendar-days"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('app.end_date') }}</label>
                            <div class="input-group">
                                <input type="text" class="form-control datepicker" name="end_date" data-format="d-m-Y" placeholder="{{ __('app.end_date') }}">
                                <i class="fa-solid fa-calendar-days"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <button type="submit" class="btn btn-primary">{{ __('app.save') }}</button>
                </div>
            </div>
        </div>
    </form>
</div>
