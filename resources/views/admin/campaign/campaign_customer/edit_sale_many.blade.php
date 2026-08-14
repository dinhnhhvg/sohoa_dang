<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.change_sale') }}</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('admin.campaign_customer.update_many') }}" onsubmit="commonSubmit(this); return false" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.sale') }}<span class="text-danger">*</span></label>
                    <select class="form-select select2" name="sale_id" data-placeholder="{{ __('app.select_sale') }}" required>
                        <option></option>
                        @foreach($sales as $sale)
                            <option value="{{ $sale->id }}">{{ $sale->name }}</option>
                        @endforeach
                    </select>
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
