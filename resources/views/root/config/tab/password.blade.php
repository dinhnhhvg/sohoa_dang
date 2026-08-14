<form method="POST" action="{{ route('root.setting.update_by_key') }}" onsubmit="commonSubmit(this, false, false); return false" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="row">
        <div class="col-md-4">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.root_password') }}<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="root_password" value="{{ $root_password->value }}" required placeholder="{{ __('app.enter_password') }}">
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group mb-3">
                <button type="submit" class="btn btn-primary w-100">{{ __('app.save') }}</button>
            </div>
        </div>
    </div>
</form>
