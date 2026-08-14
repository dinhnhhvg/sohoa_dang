<div class="row">
    <div class="col-md-6">
        <div class="card filter-card">
            <div class="card-header">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0">{{ __('app.config') }}</h5>
                    <div></div>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.setting.update') }}" onsubmit="commonSubmit(this, false, false); return false" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('app.alohub_websocket_server_url') }}<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="alohub_websocket_server_url" value="{{ env('ALOHUB_WEBSOCKET_SERVER_URL') }}" required placeholder="{{ __('app.enter_value') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('app.alohub_public_identity') }}<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="alohub_public_identity" value="{{ env('ALOHUB_PUBLIC_IDENTITY') }}" required placeholder="{{ __('app.enter_value') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('app.alohub_record_url') }}<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="alohub_record_url" value="{{ env('ALOHUB_RECORD_URL') }}" required placeholder="{{ __('app.enter_value') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary w-100">{{ __('app.save') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card filter-card">
            <div class="card-header">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0">{{ __('app.alohub_extension') }}</h5>
                    <div>
                        <div class="btn-group float-end">
                            <a href="javascript:void(0)" class="btn btn-primary me-2" onclick="commonShowModal('{{ route('admin.alohub_extension.create') }}')">{{ __('app.create') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('admin.alohub_extension.filter') }}" id="alohub_extension-filter-form" class="filter-form d-none"
                      onsubmit="commonFilter(1, '#alohub_extension-filter-form', '#alohub_extension-filter-table'); return false">
                    <div class="row d-none">
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

                <div id="alohub_extension-filter-table" class="filter-table"></div>
            </div>
        </div>
    </div>
</div>
