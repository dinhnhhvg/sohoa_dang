<form method="POST" action="{{ route('root.config.update') }}" onsubmit="commonSubmit(this, false, false); return false" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="row">
        <div class="col-md-4">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.disk') }}<span class="text-danger">*</span></label>
                <select class="form-select select2" name="app_file_manage_disk" data-placeholder="{{ __('app.select_disk') }}">
                    @foreach($disks as $disk)
                        <option value="{{ $disk }}" {{ $disk === env('APP_FILE_MANAGE_DISK') ? 'selected' : '' }}>
                            {{ $disk }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group mb-3">
                <button type="submit" class="btn btn-primary w-100">{{ __('app.save') }}</button>
            </div>
        </div>
    </div>
</form>
