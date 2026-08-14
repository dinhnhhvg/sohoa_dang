<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.copy') }} {{ __('app.defendant') }}</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('admin.judgment_document.copy_defendant', ['judgment_document' => $judgmentDocument->id]) }}"
          onsubmit="copyDefendant(this, '{{ route('admin.judgment_document.edit', ['judgment_document' => $judgmentDocument->id, 'action_type' => $action_type]) }}'); return false" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.defendant') }}<span class="text-danger">*</span></label>
                    <select class="form-select select2" name="defendant_id[]" multiple data-placeholder="{{ __('app.defendant') }}" required>
                        <option value=""></option>
                        @if($defendants)
                            @foreach($defendants as $defendant)
                                <option value="{{ $defendant->id }}">
                                    {{ $defendant->full_name }} ({{ getEndName($defendant->judgmentDocument->file_path) }})
                                </option>
                            @endforeach
                        @endif
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
