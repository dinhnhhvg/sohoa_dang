@extends(env('APP_VIEW_PATH_ADMIN').'.layout')

@section('content')
    <div class="content-title">
        <div class="pagetitle d-sm-flex align-items-center justify-content-between pb-3">
            <h1>{{ __('app.order') }}</h1>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('app.admin') }}</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('admin.order.index') }}">{{ __('app.order') }}</a></li>
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
                                    <button type="button" class="btn btn-primary me-2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('app.create') }}</button>
                                    <div class="dropdown-menu">
                                        @foreach($types as $type)
                                            <a class="dropdown-item" href="javascript:void(0)" onclick="commonShowModal('{{ route('admin.order.create', ['type_id' => $type->id]) }}', '#common-modal-fullscreen')">
                                                {{ __('app.add') }} {{ __('app.'.$type->name) }}
                                            </a>
                                        @endforeach
                                    </div>
                                    <button type="button" class="btn btn-primary me-2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('app.advanced') }}</button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0)" data-localStorage-name="adminOrders" onclick="showHideShowColumn(this)">{{ __('app.hide_show_column') }}</a>
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="commonHandleMany(this, '{{ route('admin.order.destroy_many') }}')">{{ __('app.delete') }}</a>
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="commonExport('{{ route('admin.order.export') }}', this)">{{ __('app.export_excel') }}</a>
                                    </div>
                                    <button type="button" class="btn btn-primary is-search-button" onclick="changeIsSearch(this)"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.order.filter') }}" id="filter-form" class="filter-form d-none" onsubmit="commonFilter(); return false">
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
                                        <select class="form-select select2" name="type_id[]" data-placeholder="{{ __('app.select_type') }}" multiple>
                                            <option value=""></option>
                                            @foreach($types as $type)
                                                <option value="{{ $type->id }}">{{ __('app'.$type->name) }}</option>
                                            @endforeach
                                        </select>
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
                                        <select class="form-select select2" name="status_id[]" data-placeholder="{{ __('app.select_status') }}" multiple>
                                            <option value=""></option>
                                            @foreach($statuses as $status)
                                                <option value="{{ $status->id }}">{{ __('app'.$status->name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-sm-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group mb-3">
                                                <div class="input-group">
                                                    <input type="text" class="form-control datepicker" name="start_date" placeholder="{{ __('app.start_date') }}" data-format="d-m-Y">
                                                    <i class="fa-solid fa-calendar-days"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group mb-3">
                                                <div class="input-group">
                                                    <input type="text" class="form-control datepicker" name="end_date" placeholder="{{ __('app.end_date') }}" data-format="d-m-Y">
                                                    <i class="fa-solid fa-calendar-days"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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

        function searchCustomer(e) {
            let form = $(e).closest('.card-body');
            let phone = form.find('input[name="phone"]').val();
            let name = form.find('input[name="name"]').val();

            if (!phone || !name) {
                return;
            }

            $.ajax({
                url: '{{ route('admin.customer.find_by_phone_and_name') }}',
                type: 'GET',
                data: {
                    phone: phone,
                    name: name
                },
                success: function(response) {
                    if (response) {
                        form.html(response);
                        formRender(form);
                    }
                },
                error: function(xhr) {
                    let response = JSON.parse(xhr.responseText);
                    showNotification(response.type, response.message);
                }
            });
        }
    </script>
@endsection
