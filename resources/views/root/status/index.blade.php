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
                    <li class="breadcrumb-item active"><a href="{{ route('root.status.index') }}">{{ __('app.status') }}</a></li>
                </ol>
            </nav>
        </div>
        <hr class="dropdown-divider mb-3">
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card filter-card">
                    <div class="card-header">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h5 class="card-title mb-0">{{ __('app.list') }}</h5>
                            <div>
                                <div class="btn-group float-end">
                                    <a href="javascript:void(0)" class="btn btn-primary me-2" onclick="commonShowModal('{{ route('root.status.create') }}')">{{ __('app.create') }}</a>
                                    <button type="button" class="btn btn-primary is-search-button" onclick="changeIsSearch(this)"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('root.status.filter') }}" id="filter-form" class="filter-form d-none" onsubmit="commonFilter(); return false">
                            <div class="row">
                                <input type="hidden" name="viewType">
                                <div class="col-xxl-3 col-sm-12">
                                    <div class="form-group mb-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search_key" autocomplete="off" placeholder="{{ __('app.search') }}...">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-sm-12">
                                    <div class="form-group mb-3">
                                        <select class="form-select select2" name="module" data-placeholder="{{ __('app.select_module') }}">
                                            <option value="contact">contact</option>
                                            <option value="order">order</option>
                                            <option value="class">class</option>
                                            <option value="lesson">lesson</option>
                                            <option value="payment">payment</option>
                                            <option value="class_customer">class_customer</option>
                                            <option value="lesson_customer">lesson_customer</option>
                                            <option value="campaign_customer">campaign_customer</option>
                                            <option value="batch">batch</option>
                                            <option value="judgment">judgment</option>
                                        </select>
                                    </div>
                                </div>

                                {!! renderSelectIsActive() !!}

                                {!! renderSelectPaginateAndSubmit(true) !!}
                            </div>
                        </form>

                        <div id="filter-table" class="filter-table"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js-content')
    <script>
        $(document).ready(function() {
            commonFilter();
        });
    </script>
@endsection


