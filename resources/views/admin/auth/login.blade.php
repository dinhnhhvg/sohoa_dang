@extends(env('APP_VIEW_PATH_HOME').'.account.layout')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card mt-4">
                <div class="card-body p-4">
                    <div class="text-center mt-2">
                        <h3 class="text-primary">{{ __('app.login') }}</h3>
                        <p class="text-primary">{{ __('app.sign_in_to_continue_to') }} {{ env('APP_NAME') }}.</p>
                    </div>
                    <div class="p-2 mt-4">
                        <form method="POST" action="{{ route('admin.login') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('app.email') }}<span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="{{ __('app.enter_email') }}">
                                @error('email')<li class="text-danger mt-1">{{ $message }}</li>@enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('app.password') }}<span class="text-danger">*</span></label>
                                <div class="position-relative mb-3">
                                    <input type="password" class="form-control pe-5" name="password" value="{{ old('password') }}" required placeholder="{{ __('app.enter_password') }}">
                                    <button type="button" class="btn btn-link position-absolute end-0 top-0 text-muted" onclick="togglePassword(this)">
                                        <i class="fa-regular fa-eye-slash"></i>
                                    </button>
                                    @error('password')<li class="text-danger mt-1">{{ $message }}</li>@enderror
                                </div>
                            </div>
                            <div class="form-group form-check">
                                <input class="form-check-input" type="checkbox" value="">
                                <label class="form-check-label" for="auth-remember-check">{{ __('app.remember_me') }}</label>
                            </div>
                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary w-100">{{ __('app.login') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
