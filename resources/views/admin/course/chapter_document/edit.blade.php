<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.edit') }}</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('admin.chapter_document.update', ['chapter_document' => $chapterDocument->id]) }}" onsubmit="commonSubmit(this); return false" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.name') }}<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" value="{{ $chapterDocument->name }}" required placeholder="{{ __('app.enter_name') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.video_type') }}<span class="text-danger">*</span></label>
                    <select class="form-select select2" name="type_id" required onchange="commonChangeType('document_type', this)">
                        @foreach($types as $type):
                            <option value="{{ $type->id }}" data-code="{{ $type->code }}" {{ $type->id == $chapterDocument->type_id ? 'selected' : '' }}>
                                {{ __('app.'.$type->code) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.file') }}<span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="text" name="file_path" class="form-control ps-3" value="{{ $chapterDocument->file_path }}" placeholder="{{ __('app.select_file') }}" readonly>
                        <button type="button" class="input-group-text btn btn-primary fa-solid fa-folder-open document_type" title="{{ __('app.select_file') }}"
                                onclick="openFileManager(this, 'word')">
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.is_free') }}<span class="text-danger">*</span></label>
                    <select class="form-select select2" name="is_free">
                        <option value="0" {{ $chapterDocument->is_free == 0 ? 'selected' : '' }}>{{ __('app.no') }}</option>
                        <option value="1" {{ $chapterDocument->is_free == 1 ? 'selected' : '' }}>{{ __('app.yes') }}</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.order_number') }}<span class="text-danger">*</span></label>
                    <input class="form-control" type="number" name="order_number" value="{{ $chapterDocument->order_number }}" required>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.content') }}</label>
                    <textarea class="form-control ckeditor-render" name="content">{{ $chapterDocument->content }}</textarea>
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

<script>
    $('select[name="type_id"]').trigger('change');
</script>
