<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.edit') }}</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('admin.payment.update', ['payment' => $payment->id]) }}" onsubmit="commonSubmit(this); return false" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <input type="hidden" name="order_id" value="{{ $payment->order_id }}">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.name') }}<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" required value="{{ $payment->name }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.payment_method') }}<span class="text-danger">*</span></label>
                    <select class="form-select2 select2" name="payment_method_id" required data-placeholder="{{ __('app.select_payment_method') }}">
                        @foreach($paymentMethods as $paymentMethod)
                            <option value="{{ $paymentMethod->id }}" {{ $paymentMethod->id == $payment->payment_method_id ? 'selected' : '' }}>
                                {{ $paymentMethod->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.amount') }}<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="amount" value="{{ numberFormat($payment->amount) }}" onkeyup="addCommas(this)" required placeholder="{{ __('app.enter_amount') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.expiry_date') }}</label>
                    <div class="input-group">
                        <input type="text" class="form-control datepicker" name="expiry_date" data-format="d-m-Y" value="{{ $payment->expiry_date?->format('d-m-Y') }}" placeholder="{{ __('app.end_expiry_date') }}">
                        <i class="fa-solid fa-calendar-days"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.content') }}</label>
                    <textarea class="form-control" name="content" rows="2" placeholder="{{ __('app.enter_content') }}">{{ $payment->content }}</textarea>
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
