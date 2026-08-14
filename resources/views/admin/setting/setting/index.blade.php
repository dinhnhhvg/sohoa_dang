@extends(env('APP_VIEW_PATH_ADMIN').'.layout')

@section('content')
<div class="content-title">
    <div class="pagetitle d-sm-flex align-items-center justify-content-between pb-3">
        <h1>{{ __('app.config_web') }}</h1>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('app.admin') }}</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('admin.setting.index') }}">{{ __('app.config_web') }}</a></li>
            </ol>
        </nav>
    </div>
    <hr class="dropdown-divider mb-3">
</div>

<section class="section">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <ul class="nav nav-tabs nav-tabs-bordered" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a href="javascript:void(0)" class="nav-link p-3 active" data-bs-toggle="tab" data-bs-target="#tab-config" aria-selected="true" role="tab">
                                <h5 class="mb-0">{{ __('app.config_web') }}</h5>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="javascript:void(0)" class="nav-link p-3" data-bs-toggle="tab" data-bs-target="#tab-image" aria-selected="false" role="tab" tabindex="-1">
                                <h5 class="mb-0">{{ __('app.image') }}</h5>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="javascript:void(0)" class="nav-link p-3" data-bs-toggle="tab" data-bs-target="#tab-default" aria-selected="false" role="tab" tabindex="-1">
                                <h5 class="mb-0">{{ __('app.default') }}</h5>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation" onclick="commonFilter(1, '#alohub_extension-filter-form', '#alohub_extension-filter-table');">
                            <a href="javascript:void(0)" class="nav-link p-3" data-bs-toggle="tab" data-bs-target="#tab-alohub" aria-selected="false" role="tab" tabindex="-1">
                                <h5 class="mb-0">{{ __('app.alohub') }}</h5>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade p-3 active show" id="tab-config" role="tabpanel">
                            @include(env('APP_VIEW_PATH_ADMIN').'.setting.setting.tab.config')
                        </div>
                        <div class="tab-pane fade p-3" id="tab-image" role="tabpanel">
                            @include(env('APP_VIEW_PATH_ADMIN').'.setting.setting.tab.image')
                        </div>
                        <div class="tab-pane fade p-3" id="tab-default" role="tabpanel">
                            @include(env('APP_VIEW_PATH_ADMIN').'.setting.setting.tab.default')
                        </div>
                        <div class="tab-pane fade p-3" id="tab-alohub" role="tabpanel">
                            @include(env('APP_VIEW_PATH_ADMIN').'.setting.setting.tab.alohub')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
