@extends(env('APP_VIEW_PATH_ADMIN').'.layout')

@section('content')
    <div class="content-title">
        <div class="pagetitle d-sm-flex align-items-center justify-content-between pb-3">
            <h1>{{ __('app.language') }}</h1>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('app.admin') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.language.index') }}">{{ __('app.language') }}</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('admin.language.show', ['locale' => $locale]) }}">{{ $languages[$locale] }}</a></li>
                </ol>
            </nav>
        </div>
        <hr class="dropdown-divider mb-3">
    </div>

    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card filter-card">
                    <div class="card-header">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h5 class="card-title mb-0">{{ __('app.show') }}</h5>
                            <div></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.language.filter_message', ['locale' => $locale]) }}" id="filter-form" class="filter-form" onsubmit="commonFilter(); return false">
                            <div class="row">
                                <div class="col-xxl-6 col-sm-12">
                                    <div class="form-group mb-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search_key" autocomplete="off" placeholder="{{ __('app.search') }}...">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </div>
                                    </div>
                                </div>

                                {!! renderSelectPaginateAndSubmit(true) !!}
                            </div>
                        </form>

                        <div id="filter-table" class="filter-table"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js-content')
    <script>
        $(document).ready(function() {
            commonFilter();
        });
    </script>
@endsection
