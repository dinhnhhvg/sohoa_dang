@extends(env('APP_VIEW_PATH_ROOT').'.layout')

@section('content')
    <div class="content-title">
        <div class="pagetitle d-sm-flex align-items-center justify-content-between p-3">
            <a href="{{ route('admin') }}"><h1>{{ __('app.back') }}</h1></a>
            <a href="{{ route('root') }}">
                <img src="{{ asset(env('HVG_LOGO')) }}" alt="logo" height="auto">
            </a>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item active"><a href="{{ route('root') }}">{{ __('app.root') }}</a></li>
                </ol>
            </nav>
        </div>
        <hr class="dropdown-divider mb-3">
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-8 col-lg-6 col-xl-5">
                                <div class="card mt-4">
                                    <div class="card-body p-4">
                                        <div class="text-center mt-2">
                                            <h3 class="text-primary">{{ env('HVG_TITLE') }}</h3>
                                        </div>
                                        <div class="p-2 mt-4">
                                            <form method="POST" action="{{ route('root.login') }}" enctype="multipart/form-data">
                                                @csrf
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
                                                <div class="form-group mt-4">
                                                    <button type="submit" class="btn btn-primary w-100">{{ __('app.login') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
