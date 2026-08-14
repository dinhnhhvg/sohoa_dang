<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.edit') }}</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('admin.order.update', ['order' => $order->id]) }}" onsubmit="commonSubmit(this); return false" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.total_amount') }}</label>
                    <input type="text" class="form-control" name="total_amount" value="{{ numberFormat($order->total_amount) }}" disabled placeholder="{{ __('total_amount') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.coupon') }}</label>
                    <input type="text" class="form-control" name="coupon_code" value="{{ $order->coupon_code }}" onchange="useCoupon(this)" placeholder="{{ __('coupon') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.coupon_amount') }}</label>
                    <input type="text" class="form-control" name="coupon_amount" value="{{ numberFormat($order->coupon_amount) }}" disabled placeholder="{{ __('coupon_amount') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.discount_amount') }}</label>
                    <input type="text" class="form-control" name="discount_amount" value="{{ numberFormat($order->discount_amount) }}"
                           onkeyup="addCommas(this)" onchange="useDiscountAmount(this)" placeholder="{{ __('discount_amount') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.final_amount') }}</label>
                    <input type="text" class="form-control" name="final_amount" value="{{ numberFormat($order->final_amount) }}" disabled placeholder="{{ __('final_amount') }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.content') }}</label>
                    <textarea class="form-control" name="content" rows="2" placeholder="{{ __('app.enter_content') }}">{{ $order->content }}</textarea>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group mb-3">
                <button type="submit" class="btn btn-primary">{{ __('app.save') }}</button>
            </div>
        </div>
    </form>
</div>
