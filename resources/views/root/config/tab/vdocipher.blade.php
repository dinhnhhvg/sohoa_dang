<form method="POST" action="{{ route('root.config.update') }}" onsubmit="commonSubmit(this, false, false); return false" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="row">
        <div class="col-xl-6">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.vdocipher_api_secret') }}</label>
                <input type="text" class="form-control" name="vdocipher_api_secret" value="{{ env('VDOCIPHER_API_SECRET') }}" placeholder="{{ __('app.enter_data') }}">
            </div>
        </div>
        <div class="col-xl-6">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.vdocipher_api_url') }}</label>
                <input type="text" class="form-control" name="vdocipher_api_url" value="{{ env('VDOCIPHER_API_URL') }}" placeholder="{{ __('app.enter_data') }}">
            </div>
        </div>
        <div class="col-xl-6">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.vdocipher_upload_base_url') }}</label>
                <input type="text" class="form-control" name="vdocipher_upload_base_url" value="{{ env('VDOCIPHER_UPLOAD_BASE_URL') }}" placeholder="{{ __('app.enter_data') }}">
            </div>
        </div>
        <div class="col-xl-6">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.vdocipher_webhook_secret') }}</label>
                <input type="text" class="form-control" name="vdocipher_webhook_secret" value="{{ env('VDOCIPHER_WEBHOOK_SECRET') }}" placeholder="{{ __('app.enter_data') }}">
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group mb-3">
                <button type="submit" class="btn btn-primary w-100">{{ __('app.save') }}</button>
            </div>
        </div>
    </div>
</form>
