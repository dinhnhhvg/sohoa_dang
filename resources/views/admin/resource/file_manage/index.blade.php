@extends(env('APP_VIEW_PATH_ADMIN').'.layout')

@section('content')
    <div class="content-title">
        <div class="pagetitle d-sm-flex align-items-center justify-content-between pb-3">
            <h1>{{ __('app.file_manage_label') }}</h1>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('app.admin') }}</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('admin.file_manage.index') }}">{{ __('app.file_manage_label') }}</a></li>
                </ol>
            </nav>
        </div>
        <hr class="dropdown-divider mb-3">
    </div>

    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h5 class="card-title mb-0">{{ __('app.list') }}</h5>
                            <div></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <iframe class="file-manager-frame" style="min-height: 650px" src="{{ url('file-manager?type='.session('account')) }}"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
