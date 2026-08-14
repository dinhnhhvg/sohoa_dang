<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.edit') }}</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('admin.item_media.update', ['item_media' => $itemMedia->id]) }}" onsubmit="commonSubmit(this); return false" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.title') }}<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="title" value="{{ $itemMedia->title }}" required placeholder="{{ __('app.enter_title') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.video_type') }}<span class="text-danger">*</span></label>
                    <select class="form-select select2" name="type" required onchange="commonChangeType('item_media', this)">
                        <option value="image" {{ $itemMedia->type === 'image' ? 'selected' : '' }}>image</option>
                        <option value="video" {{ $itemMedia->type === 'video' ? 'selected' : '' }}>video</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.order_number') }}<span class="text-danger">*</span></label>
                    <input class="form-control" type="number" name="order_number" value="{{ $itemMedia->order_number }}" required>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.file') }}<span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="text" name="file_path" value="{{ $itemMedia->file_path }}" class="form-control ps-3" placeholder="{{ __('app.select_file') }}" readonly>
                        <button type="button" class="input-group-text btn btn-primary fa-solid fa-folder-open item_media" title="{{ __('app.select_file') }}"
                                onclick="openFileManager(this, {{ $itemMedia->type }})">
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
