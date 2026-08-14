<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.work_distribution') }}</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('admin.judgment.work_distribution') }}" onsubmit="commonSubmit(this); return false" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="ids" value="{{ $ids }}">
        <div class="row">
            <p>Vui lòng chọn các nhân sự nhập liệu và kiểm duyệt để phân phối công việc cho các bản ghi đã chọn.</p>
            <div class="col-md-12">
                <label class="form-label">{{ __('app.batch_entry') }}<span class="text-danger">*</span></label>
                <div class="form-group mb-3">
                    <select class="form-select select2" name="entry_id[]" multiple required data-placeholder="{{ __('app.batch_entry') }}">
                        <option></option>
                        @foreach($batch->entries as $entry)
                            <option value="{{ $entry->id }}" selected>{{ $entry->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <label class="form-label">{{ __('app.batch_checker') }}<span class="text-danger">*</span></label>
                <div class="form-group mb-3">
                    <select class="form-select select2" name="checker_id[]" multiple required data-placeholder="{{ __('app.batch_checker') }}">
                        <option></option>
                        @foreach($batch->checkers as $checker)
                            <option value="{{ $checker->id }}" selected>{{ $checker->name }}</option>
                        @endforeach
                    </select>
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
