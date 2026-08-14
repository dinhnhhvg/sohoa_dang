<form method="POST" action="{{ route('root.config.update') }}" onsubmit="commonSubmit(this, false, false); return false" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="row">
        <div class="col-md-4">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.mail_mailer') }}<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="mail_mailer" value="{{ env('MAIL_MAILER') }}" required placeholder="{{ __('app.enter_data') }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.mail_host') }}<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="mail_host" value="{{ env('MAIL_HOST') }}" required placeholder="{{ __('app.enter_data') }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.mail_port') }}<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="mail_port" value="{{ env('MAIL_PORT') }}" required placeholder="{{ __('app.enter_data') }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.mail_username') }}</label>
                <input type="text" class="form-control" name="mail_username" value="{{ env('MAIL_USERNAME') }}" placeholder="{{ __('app.enter_data') }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.mail_password') }}</label>
                <input type="text" class="form-control" name="mail_password" value="{{ env('MAIL_PASSWORD') }}" placeholder="{{ __('app.enter_data') }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.mail_encryption') }}</label>
                <input type="text" class="form-control" name="mail_encryption" value="{{ env('MAIL_ENCRYPTION') }}" placeholder="{{ __('app.enter_data') }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.mail_form_address') }}<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="mail_form_address" value="{{ env('MAIL_FROM_ADDRESS') }}" required placeholder="{{ __('app.enter_data') }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.mail_form_name') }}<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="mail_form_name" value="{{ env('MAIL_FROM_NAME') }}" required placeholder="{{ __('app.enter_data') }}">
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group mb-3">
                <button type="submit" class="btn btn-primary w-100">{{ __('app.save') }}</button>
            </div>
        </div>
    </div>
</form>
