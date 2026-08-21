<form method="POST" action="{{ route('admin.judgment_document.update', ['judgment_document' => $judgmentDocument->id]) }}" onsubmit="commonSubmit(this, false, false); return false" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.agency') }}</label>
                <textarea class="form-control" name="agency_name" rows="2" placeholder="{{ __('app.entry') }}">{{ $judgmentDocument->agency_name }}</textarea>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.document_number') }}</label>
                <input type="text" class="form-control" name="document_number" value="{{ $judgmentDocument->document_number }}" placeholder="{{ __('app.entry') }}">
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.document_notation') }}<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="document_notation" value="{{ $judgmentDocument->document_notation }}" placeholder="{{ __('app.entry') }}">
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.issue_date') }}</label>
                <div class="input-group">
                    <input type="text" class="form-control datepicker" name="issue_date" value="{{ $judgmentDocument->issue_date?->format('d/m/Y') }}" data-format="d/m/Y" placeholder="{{ __('app.issue_date') }}">
                    <i class="fa-solid fa-calendar-days"></i>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.document_genre') }}<span class="text-danger">*</span></label>
                <select class="form-select select2 mb-2" name="document_genre_id" data-placeholder="{{ __('app.select') }}">
                    @foreach($documentGenres as $documentGenre)
                        <option value="{{ $documentGenre->id }}" {{ $documentGenre->id == $judgmentDocument->document_genre_id ? 'selected' : '' }}>
                            {{ renderCodeName($documentGenre) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.content_summary') }}</label>
                <textarea class="form-control" rows="2" name="content_summary">{{ $judgmentDocument->content_summary }}</textarea>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.signer') }}</label>
                <input type="text" class="form-control" name="signer" value="{{ $judgmentDocument->signer }}" placeholder="{{ __('app.entry') }}">
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.confidentiality_level') }}</label>
                <select class="form-select select2 mb-2" name="confidentiality_level_id" data-placeholder="{{ __('app.select') }}">
                    @foreach($confidentialityLevels as $confidentialityLevel)
                        <option value="{{ $confidentialityLevel->id }}" {{ $confidentialityLevel->id == $judgmentDocument->confidentiality_level_id ? 'selected' : '' }}>
                            {{ $confidentialityLevel->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.copy_type') }}</label>
                <select class="form-select select2 mb-2" name="copy_type_id" data-placeholder="{{ __('app.select') }}">
                    @foreach($copyTypes as $copyType)
                        <option value="{{ $copyType->id }}" {{ $copyType->id == $judgmentDocument->copy_type_id ? 'selected' : '' }}>
                            {{ $copyType->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.keywords') }}</label>
                <input type="text" class="form-control" name="keywords" value="{{ $judgmentDocument->keywords }}" placeholder="{{ __('app.entry') }}">
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.topic') }}</label>
                <input type="text" class="form-control" name="topic" value="{{ $judgmentDocument->topic }}" placeholder="{{ __('app.entry') }}">
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.original_doc_location') }}</label>
                <input type="text" class="form-control" name="original_doc_location" value="{{ $judgmentDocument->original_doc_location }}" placeholder="{{ __('app.entry') }}">
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.data_entry_by') }}</label>
                <input type="text" class="form-control" name="data_entry_by" value="{{ $judgmentDocument->data_entry_by }}" placeholder="{{ __('app.entry') }}">
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.doc_order_in_dossier') }}</label>
                <input type="text" class="form-control" name="doc_order_in_dossier" value="{{ $judgmentDocument->doc_order_in_dossier }}" placeholder="{{ __('app.entry') }}">
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.page_number') }}</label>
                <input type="text" class="form-control" name="page_number" value="{{ $judgmentDocument->page_number }}" placeholder="{{ __('app.entry') }}">
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.info_code') }}</label>
                <input type="text" class="form-control" name="info_code" value="{{ $judgmentDocument->info_code }}" placeholder="{{ __('app.entry') }}">
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.usage_mode') }}</label>
                <select class="form-select select2 mb-2" name="usage_mode_id" data-placeholder="{{ __('app.select') }}">
                    @foreach($usageModes as $usageMode)
                        <option value="{{ $usageMode->id }}" {{ $usageMode->id == $judgmentDocument->usage_mode_id ? 'selected' : '' }}>
                            {{ $usageMode->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.handwritten_notes') }}</label>
                <input type="text" class="form-control" name="handwritten_notes" value="{{ $judgmentDocument->handwritten_notes }}" placeholder="{{ __('app.entry') }}">
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <button type="submit" class="btn btn-primary">{{ __('app.save') }}</button>
            </div>
        </div>
    </div>
</form>
