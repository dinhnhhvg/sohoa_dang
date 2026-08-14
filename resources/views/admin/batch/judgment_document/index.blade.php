@extends(env('APP_VIEW_PATH_ADMIN').'.layout')

@section('content')
    <div class="content-title">
        <div class="pagetitle d-sm-flex align-items-center justify-content-between pb-3">
            <h1>{{ __('app.judgment_document') }} - {{ $judgment->batch->name ?? '' }}</h1>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('app.admin') }}</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('admin.judgment_document.index') }}">{{ __('app.judgment_document') }}</a></li>
                </ol>
            </nav>
        </div>
        <hr class="dropdown-divider mb-3">
    </div>

    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card filter-card">
                    @if(isset($judgment_id) && $judgment_id)
                        <div class="card-header">
                            <div class="d-sm-flex align-items-center justify-content-between">
                                <h5 class="card-title mb-0">{{ __('app.list') }}</h5>
                                <div>
                                    <div class="btn-group float-end">
                                        <button type="button" class="btn btn-primary me-2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('app.advanced') }}</button>
                                        <div class="dropdown-menu"></div>
                                        <button type="button" class="btn btn-primary is-search-button" onclick="changeIsSearch(this)"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="{{ route('admin.judgment_document.filter') }}" id="filter-form" class="filter-form d-none" onsubmit="commonFilter(); return false">
                                <input type="hidden" name="orderByName">
                                <input type="hidden" name="orderByType">
                                <input type="hidden" name="judgment_id" value="{{ $judgment_id }}">
                                <div class="row">
                                    <div class="col-xxl-3 col-sm-12">
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
                    @else
                        //
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@if(isset($judgment_id) && $judgment_id)
    @section('js-content')
        <script>
            $(document).ready(function() {
                commonFilter();
            });
        </script>
    @endsection
@endif
