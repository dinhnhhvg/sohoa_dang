<form method="POST" action="{{ route('root.config.update') }}" onsubmit="commonSubmit(this, false, false); return false" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="row">
        <div class="col-md-4">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.aws_access_key_id') }}</label>
                <input type="text" class="form-control" name="aws_access_key_id" value="{{ env('AWS_ACCESS_KEY_ID') }}" placeholder="{{ __('app.enter_data') }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.aws_secret_access_key') }}</label>
                <input type="text" class="form-control" name="aws_secret_access_key" value="{{ env('AWS_SECRET_ACCESS_KEY') }}" placeholder="{{ __('app.enter_data') }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.aws_default_region') }}</label>
                <input type="text" class="form-control" name="aws_default_region" value="{{ env('AWS_DEFAULT_REGION') }}" placeholder="{{ __('app.enter_data') }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.aws_bucket') }}</label>
                <input type="text" class="form-control" name="aws_bucket" value="{{ env('AWS_BUCKET') }}" placeholder="{{ __('app.enter_data') }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.aws_use_path_style_endpoint') }}<span class="text-danger">*</span></label>
                <select class="form-select select2" name="aws_use_path_style_endpoint" required>
                    <option value="true" {{ true === env('AWS_USE_PATH_STYLE_ENDPOINT') ? 'selected' : '' }}>true</option>
                    <option value="false" {{ false === env('AWS_USE_PATH_STYLE_ENDPOINT') ? 'selected' : '' }}>false</option>
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group mb-3">
                <button type="submit" class="btn btn-primary w-100">{{ __('app.save') }}</button>
            </div>
        </div>
    </div>
</form>
