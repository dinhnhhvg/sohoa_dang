<form method="POST" action="{{ route('root.config.update') }}" onsubmit="commonSubmit(this, false, false); return false" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="row">
        <div class="col-xl-6">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.bunny_library_id') }}</label>
                <input type="text" class="form-control" name="bunny_library_id" value="{{ env('BUNNY_LIBRARY_ID') }}" placeholder="{{ __('app.enter_data') }}">
            </div>
        </div>
        <div class="col-xl-6">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.bunny_api_key') }}</label>
                <input type="text" class="form-control" name="bunny_api_key" value="{{ env('BUNNY_API_KEY') }}" placeholder="{{ __('app.enter_data') }}">
            </div>
        </div>
        <div class="col-xl-6">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.bunny_api_url') }}</label>
                <input type="text" class="form-control" name="bunny_api_url" value="{{ env('BUNNY_API_URL') }}" placeholder="{{ __('app.enter_data') }}">
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group mb-3">
                <button type="submit" class="btn btn-primary w-100">{{ __('app.save') }}</button>
            </div>
        </div>
    </div>
</form>
