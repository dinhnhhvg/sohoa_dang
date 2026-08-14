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
                    <li class="breadcrumb-item"><a href="{{ route('root') }}">{{ __('app.root') }}</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('root') }}">{{ __('app.dashboard') }}</a></li>
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
                            <div class="col-xl-8 col-md-10 col-sm-12">
                                <div class="row">
                                    <div class="col-xl-3 col-md-4 col-sm-6">
                                        <div class="card">
                                            <div class="card-body d-flex justify-content-center align-items-center aspect-ratio-11">
                                                <a href="{{ route('root.account.index') }}">
                                                    <h4>{{ __('app.account') }}</h4>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-4 col-sm-6">
                                        <div class="card">
                                            <div class="card-body d-flex justify-content-center align-items-center aspect-ratio-11">
                                                <a href="{{ route('root.menu.index') }}">
                                                    <h4>{{ __('app.menu') }}</h4>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-4 col-sm-6">
                                        <div class="card">
                                            <div class="card-body d-flex justify-content-center align-items-center aspect-ratio-11">
                                                <a href="{{ route('root.action.index') }}">
                                                    <h4>{{ __('app.action') }}</h4>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-4 col-sm-6">
                                        <div class="card">
                                            <div class="card-body d-flex justify-content-center align-items-center aspect-ratio-11">
                                                <a href="{{ route('root.type.index') }}">
                                                    <h4>{{ __('app.type') }}</h4>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-4 col-sm-6">
                                        <div class="card">
                                            <div class="card-body d-flex justify-content-center align-items-center aspect-ratio-11">
                                                <a href="{{ route('root.status.index') }}">
                                                    <h4>{{ __('app.status') }}</h4>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-4 col-sm-6">
                                        <div class="card">
                                            <div class="card-body d-flex justify-content-center align-items-center aspect-ratio-11">
                                                <a href="{{ route('root.config.index') }}">
                                                    <h4>{{ __('app.config') }}</h4>
                                                </a>
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
    </div>
@endsection
