<form method="POST" action="{{ route('admin.setting.update') }}" onsubmit="commonSubmit(this, false, false); return false" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="card card-profile">
                <div class="card-body p-2">
                    <label class="form-label">{{ __('app.logo') }}<span class="text-danger">*</span></label>
                    <div class="form-group">
                        <div class="input-group">
                            <img src="{{ asset(env('APP_LOGO')) }}" alt="Image" class="w-100 aspect-ratio-11">
                            <input type="text" name="logo" class="form-control ps-3" value="{{ env('APP_LOGO') }}" placeholder="{{ __('app.select_file') }}" readonly>
                            <button type="button" class="input-group-text btn btn-primary fa-solid fa-folder-open" title="{{ __('app.select_file') }}"
                                    onclick="openFileManager(this, 'image')">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-profile">
                <div class="card-body p-2">
                    <label class="form-label">{{ __('app.favicon') }}<span class="text-danger">*</span></label>
                    <div class="form-group">
                        <div class="input-group">
                            <img src="{{ asset(env('APP_FAVICON')) }}" alt="Image" class="w-100 aspect-ratio-11">
                            <input type="text" name="favicon" class="form-control ps-3" value="{{ env('APP_FAVICON') }}" placeholder="{{ __('app.select_file') }}" readonly>
                            <button type="button" class="input-group-text btn btn-primary fa-solid fa-folder-open" title="{{ __('app.select_file') }}"
                                    onclick="openFileManager(this, 'image')">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-profile">
                <div class="card-body p-2">
                    <label class="form-label">{{ __('app.avatar') }}<span class="text-danger">*</span></label>
                    <div class="form-group">
                        <div class="input-group">
                            <img src="{{ asset(env('APP_DEFAULT_AVATAR')) }}" alt="Image" class="w-100 aspect-ratio-11">
                            <input type="text" name="default_avatar" class="form-control ps-3" value="{{ env('APP_DEFAULT_AVATAR') }}" placeholder="{{ __('app.select_file') }}" readonly>
                            <button type="button" class="input-group-text btn btn-primary fa-solid fa-folder-open" title="{{ __('app.select_file') }}"
                                    onclick="openFileManager(this, 'image')">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-profile">
                <div class="card-body p-2">
                    <label class="form-label">{{ __('app.image') }}<span class="text-danger">*</span></label>
                    <div class="form-group">
                        <div class="input-group">
                            <img src="{{ asset(env('APP_DEFAULT_IMAGE')) }}" alt="Image" class="w-100 aspect-ratio-11">
                            <input type="text" name="default_image" class="form-control ps-3" value="{{ env('APP_DEFAULT_IMAGE') }}" placeholder="{{ __('app.select_file') }}" readonly>
                            <button type="button" class="input-group-text btn btn-primary fa-solid fa-folder-open" title="{{ __('app.select_file') }}"
                                    onclick="openFileManager(this, 'image')">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-profile">
                <div class="card-body p-2">
                    <label class="form-label">{{ __('app.empty') }}<span class="text-danger">*</span></label>
                    <div class="form-group">
                        <div class="input-group">
                            <img src="{{ asset(env('APP_DEFAULT_EMPTY')) }}" alt="Image" class="w-100 aspect-ratio-11">
                            <input type="text" name="default_empty" class="form-control ps-3" value="{{ env('APP_DEFAULT_EMPTY') }}" placeholder="{{ __('app.select_file') }}" readonly>
                            <button type="button" class="input-group-text btn btn-primary fa-solid fa-folder-open" title="{{ __('app.select_file') }}"
                                    onclick="openFileManager(this, 'image')">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group mb-3">
                <button type="submit" class="btn btn-primary w-100">{{ __('app.save') }}</button>
            </div>
        </div>
    </div>
</form>
