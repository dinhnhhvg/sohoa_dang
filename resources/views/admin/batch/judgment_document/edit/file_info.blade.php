<form method="POST" action="{{ route('admin.judgment_document.update', ['judgment_document' => $judgmentDocument->id]) }}" onsubmit="commonSubmit(this, false, false); return false" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.document_type') }}<span class="text-danger">*</span></label>
                <select class="form-select select2" name="document_type_id" data-placeholder="{{ __('app.select') }}">
                    @foreach($documentTypes as $documentType)
                        <option value="{{ $documentType->id }}" {{ $documentType->id == $judgmentDocument->document_type_id ? 'selected' : '' }}>
                            {{ $documentType->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <label class="form-label">{{ __('app.language') }}<span class="text-danger">*</span></label>
            <div class="form-group mb-3">
                <select class="form-select select2" name="language_id[]" multiple data-placeholder="{{ __('app.select') }}">
                    @foreach($languages as $il1 => $language)
                        <option value="{{ $language->id }}" {{ $language->id == $judgmentDocument->language_id ? 'selected' : ($il1 == 0 ? 'selected' : '') }}>
                            {{ $language->code}}-{{ $language->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <label class="form-label">{{ __('app.physical_condition') }}<span class="text-danger">*</span></label>
            <div class="form-group mb-3">
                <select class="form-select select2" name="physical_condition_id" data-placeholder="{{ __('app.select_type') }}">
                    @foreach($physicalConditions as $physicalCondition)
                        <option value="{{ $physicalCondition->id }}" {{ $physicalCondition->id == $judgmentDocument->physical_condition_id ? 'selected' : '' }}>
                            {{ $physicalCondition->code }}-{{ $physicalCondition->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.renamed_file_path') }}</label>
                <br>
                <label class="form-label">{{ renderStandardPath($judgmentDocument->file_path) }}</label>
                <input type="text" class="form-control" name="renamed_file_path" value="{{ $judgmentDocument->renamed_file_path ?: renderStandardPath($judgmentDocument->file_path) }}" placeholder="{{ __('app.entry') }}">
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.description') }}</label>
                <textarea class="form-control" name="description" rows="2" placeholder="{{ __('app.enter_description') }}">{{ $judgmentDocument->description }}</textarea>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.note') }}<span class="text-danger">*</span></label>
                <textarea class="form-control" name="note" rows="2" placeholder="{{ __('app.enter_note') }}">{{ __('app.'.$action_type) }}</textarea>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <button type="submit" class="btn btn-primary">{{ __('app.save') }}</button>
            </div>
        </div>
    </div>
</form>
