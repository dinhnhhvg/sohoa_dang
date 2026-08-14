@extends(env('APP_VIEW_PATH_ADMIN').'.layout')

@section('content')
    <div class="content-title">
        <div class="pagetitle d-sm-flex align-items-center justify-content-between pb-3">
            <h1>{{ __('app.customer') }}</h1>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('app.admin') }}</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('admin.customer.index') }}">{{ __('app.customer') }}</a></li>
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
                            <h5 class="card-title mb-0">{{ __('app.list') }}</h5>
                            <div>
                                <div class="btn-group float-end">
                                    <a href="javascript:void(0)" class="btn btn-primary me-2" onclick="commonShowModal('{{ route('admin.customer.create') }}', '#common-modal-xl')">{{ __('app.create') }}</a>
                                    <button type="button" class="btn btn-primary me-2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('app.advanced') }}</button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0)" data-localStorage-name="adminCustomers" onclick="showHideShowColumn(this)">
                                            {{ __('app.hide_show_column') }}
                                        </a>
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="commonShowModal('{{ route('admin.campaign_customer.create_many') }}', modal='#common-modal-lg', this, true)">
                                            {{ __('app.add_campaign') }}
                                        </a>
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="commonHandleMany(this, '{{ route('admin.customer.destroy_many') }}')">
                                            {{ __('app.delete') }}
                                        </a>
                                        <a class="dropdown-item" href="javascript:void(0)"
                                           onclick="commonShowModal('{{ route('admin.customer.create_import') }}', '#common-modal-lg')">
                                            {{ __('app.import_excel') }}
                                        </a>
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="commonExport('{{ route('admin.customer.export') }}', this)">
                                            {{ __('app.export_excel') }}
                                        </a>
                                    </div>
                                    <button type="button" class="btn btn-primary view-type-button me-2" onclick="renderViewType(this)"></button>
                                    <button type="button" class="btn btn-primary is-search-button" onclick="changeIsSearch(this)"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.customer.filter') }}" id="filter-form" class="filter-form" onsubmit="commonFilter(); return false">
                            <input type="hidden" name="orderByName">
                            <input type="hidden" name="orderByType">
                            <input type="hidden" name="viewType">
                            <div class="row">
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
                                        <select class="form-select select2" name="center_id[]" data-placeholder="{{ __('app.select_center') }}" multiple>
                                            <option value=""></option>
                                            @foreach($centers as $center)
                                                <option value="{{ $center->id }}">{{ $center->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-sm-12">
                                    <div class="form-group mb-3">
                                        <select class="form-select select2" name="agency_id[]" data-placeholder="{{ __('app.select_agency') }}" multiple>
                                            <option value=""></option>
                                            @foreach($agencies as $agency)
                                                <option value="{{ $agency->id }}">{{ $agency->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-sm-12">
                                    <div class="form-group mb-3">
                                        <select class="form-select select2" name="customer_tag_id[]" data-placeholder="{{ __('app.select_customer_tag') }}" multiple>
                                            <option value=""></option>
                                            @foreach($customerTags as $customerTag)
                                                <option value="{{ $customerTag->id }}">{{ $customerTag->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {!! renderSelectIsActive() !!}

                                {!! renderSelectPaginateAndSubmit() !!}
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
