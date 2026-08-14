<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.create') }}</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('admin.class_customer.store') }}" onsubmit="commonSubmit(this); return false" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="class_id" value="{{ $class_id }}">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.customer') }}<span class="text-danger">*</span></label>
                    <select class="form-select select2" name="customer_id" data-placeholder="{{ __('app.select_customer') }}">
                        <option value=""></option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->code }} - {{ $customer->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.status') }}<span class="text-danger">*</span></label>
                    <select class="form-select select2" name="status_id" data-placeholder="{{ __('app.select_status') }}">
                        @foreach($statuses as $status)
                            <option value="{{ $status->id }}">{{ __('app.').$status->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('app.start_date') }}</label>
                            <div class="input-group">
                                <input type="text" class="form-control datepicker" name="start_date" data-format="d-m-Y" value="{{ $class->end_date ? date('d-m-Y') : '' }}">
                                <i class="fa-solid fa-calendar-days"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('app.end_date') }}</label>
                            <div class="input-group">
                                <input type="text" class="form-control datepicker" name="end_date" data-format="d-m-Y" value="{{ $class->end_date?->format('d-m-Y') }}">
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
