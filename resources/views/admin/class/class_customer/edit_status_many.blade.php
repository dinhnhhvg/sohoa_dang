<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.edit_status') }}</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('admin.class_customer.update_many') }}" onsubmit="commonSubmit(this); return false" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <input type="hidden" name="ids" value="{{ $ids }}">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.status') }}<span class="text-danger">*</span></label>
                    <select class="form-select select2" name="status_id" data-placeholder="{{ __('app.select_status') }}">
                        <option value=""></option>
                        @foreach($statuses as $status)
                            <option value="{{ $status->id }}">{{ __('app.'.$status->name) }}</option>
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
