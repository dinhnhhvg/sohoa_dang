<form method="POST" action="{{ route('admin.setting.update') }}" onsubmit="commonSubmit(this, false, false); return false" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="row">
        <div class="col-md-4">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.name') }}<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" value="{{ env('APP_NAME') }}" required placeholder="{{ __('app.enter_name') }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.title') }}<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="title" value="{{ env('APP_TITLE') }}" required placeholder="{{ __('app.enter_title') }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.description') }}<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="description" value="{{ env('APP_DESCRIPTION') }}" required placeholder="{{ __('app.enter_description') }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.phone') }}<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="phone" value="{{ env('APP_PHONE') }}" oninput="phoneOnly(this)" required placeholder="{{ __('app.enter_phone') }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.email') }}<span class="text-danger">*</span></label>
                <input type="email" class="form-control" name="email" value="{{ env('APP_EMAIL') }}" required placeholder="{{ __('app.enter_email') }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.auth') }}<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="auth" value="{{ env('APP_AUTH') }}" required placeholder="{{ __('app.enter_auth') }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.language') }}<span class="text-danger">*</span></label>
                <select class="form-select select2" name="locale">
                    @foreach($activeLanguages as $locale => $language)
                        <option value="{{ $locale }}" {{ $locale === env('APP_LOCALE') ? 'selected' : '' }}>
                            {{ $language }}
                        </option>
                    @endforeach
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
