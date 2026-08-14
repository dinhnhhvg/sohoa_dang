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
                    <li class="breadcrumb-item active"><a href="{{ route('root.menu.index') }}">{{ __('app.menu') }}</a></li>
                </ol>
            </nav>
        </div>
        <hr class="dropdown-divider mb-3">
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-0">
                        <ul class="nav nav-tabs nav-tabs-bordered" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a href="javascript:void(0)" class="nav-link p-3 active" data-bs-toggle="tab" data-bs-target="#tab-config" aria-selected="true" role="tab">
                                    <h5 class="mb-0">{{ __('app.config') }}</h5>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="javascript:void(0)" class="nav-link p-3" data-bs-toggle="tab" data-bs-target="#tab-password" aria-selected="false" role="tab" tabindex="-1">
                                    <h5 class="mb-0">{{ __('app.password') }}</h5>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="javascript:void(0)" class="nav-link p-3" data-bs-toggle="tab" data-bs-target="#tab-mail" aria-selected="false" role="tab" tabindex="-1">
                                    <h5 class="mb-0">{{ __('app.mail') }}</h5>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="javascript:void(0)" class="nav-link p-3" data-bs-toggle="tab" data-bs-target="#tab-aws" aria-selected="false" role="tab" tabindex="-1">
                                    <h5 class="mb-0">{{ __('app.aws') }}</h5>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="javascript:void(0)" class="nav-link p-3" data-bs-toggle="tab" data-bs-target="#tab-vdocipher" aria-selected="false" role="tab" tabindex="-1">
                                    <h5 class="mb-0">{{ __('app.vdocipher') }}</h5>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="javascript:void(0)" class="nav-link p-3" data-bs-toggle="tab" data-bs-target="#tab-bunny" aria-selected="false" role="tab" tabindex="-1">
                                    <h5 class="mb-0">{{ __('app.bunny') }}</h5>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade p-3 active show" id="tab-config" role="tabpanel">
                                @include(env('APP_VIEW_PATH_ROOT').'.config.tab.config')
                            </div>
                            <div class="tab-pane fade p-3" id="tab-password" role="tabpanel">
                                @include(env('APP_VIEW_PATH_ROOT').'.config.tab.password')
                            </div>
                            <div class="tab-pane fade p-3" id="tab-mail" role="tabpanel">
                                @include(env('APP_VIEW_PATH_ROOT').'.config.tab.mail')
                            </div>
                            <div class="tab-pane fade p-3" id="tab-aws" role="tabpanel">
                                @include(env('APP_VIEW_PATH_ROOT').'.config.tab.aws')
                            </div>
                            <div class="tab-pane fade p-3" id="tab-vdocipher" role="tabpanel">
                                @include(env('APP_VIEW_PATH_ROOT').'.config.tab.vdocipher')
                            </div>
                            <div class="tab-pane fade p-3" id="tab-bunny" role="tabpanel">
                                @include(env('APP_VIEW_PATH_ROOT').'.config.tab.bunny')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
