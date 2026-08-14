<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.create') }}</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('admin.campaign.store') }}" onsubmit="commonSubmit(this); return false" enctype="multipart/form-data">
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
                    <label class="form-label">{{ __('app.code') }}<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="code" required placeholder="{{ __('app.enter_code') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('app.start_date') }}<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control datepicker" name="start_date" data-format="d-m-Y" placeholder="{{ __('app.end_date') }}">
                                <i class="fa-solid fa-calendar-days"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('app.end_date') }}<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control datepicker" name="end_date" data-format="d-m-Y" placeholder="{{ __('app.end_date') }}">
                                <i class="fa-solid fa-calendar-days"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.sale') }}<span class="text-danger">*</span></label>
                    <select class="form-select select2" name="sale_id[]" multiple data-placeholder="{{ __('app.select_sale') }}" required>
                        <option></option>
                        @foreach($sales as $sale)
                            <option value="{{ $sale->id }}">{{ $sale->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.description') }}</label>
                    <textarea class="form-control ckeditor-render" name="description" rows="2" placeholder="{{ __('app.enter_description') }}"></textarea>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.script') }}</label>
                    <textarea class="form-control ckeditor-render" name="script" rows="2" placeholder="{{ __('app.enter_script') }}"></textarea>
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
