<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.import_excel') }}</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('admin.procuracy.store_import') }}" onsubmit="commonSubmit(this); return false" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group mb-3">
                    {{ __('app.sample_file') }}: <a href="{{ route('admin.procuracy.download_import') }}">Download</a>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.file') }}<span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="text" name="file_path" class="form-control ps-3" placeholder="{{ __('app.select_file') }}" readonly>
                        <button type="button" class="input-group-text btn btn-primary fa-solid fa-folder-open" title="{{ __('app.select_file') }}"
                                onclick="openFileManager(this, 'excel')">
                        </button>
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
