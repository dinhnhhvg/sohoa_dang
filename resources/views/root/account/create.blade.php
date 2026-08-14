<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.create') }}</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('root.account.store') }}" onsubmit="commonSubmit(this); return false" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card card-profile">
                    <div class="card-body p-2">
                        <div class="form-group">
                            <div class="input-group">
                                <img src="{{ asset(env('APP_LOGO')) }}" alt="Image" class="w-100 aspect-ratio-11">
                                <input type="text" name="image" class="form-control ps-3" value="{{ env('APP_LOGO') }}" placeholder="{{ __('app.select_file') }}" readonly>
                                <button type="button" class="input-group-text btn btn-primary fa-solid fa-folder-open" title="{{ __('app.select_file') }}"
                                        onclick="openFileManager(this, 'image')">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('app.name') }}<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" required placeholder="{{ __('app.enter_name') }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('app.code') }}<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="code" required placeholder="{{ __('app.enter_code') }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('app.router') }}<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="route" required placeholder="{{ __('app.enter_route') }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <button type="submit" class="btn btn-primary">{{ __('app.save') }}</button>
                </div>
            </div>
        </div>
    </form>
</div>
