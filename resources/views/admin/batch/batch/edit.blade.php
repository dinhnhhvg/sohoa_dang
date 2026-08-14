<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.edit') }}</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('admin.batch.update', ['batch' => $batch->id]) }}" onsubmit="commonSubmit(this, true, true); return false" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.folder') }}<span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="text" name="folder_path" value="{{ $batch->folder_path }}" class="form-control ps-3" placeholder="{{ __('app.select_file') }}" readonly>
                        <button type="button" class="input-group-text btn btn-primary fa-solid fa-folder-open" title="{{ __('app.select_file') }}"
                                onclick="openFileManager(this)">
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.name') }}<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" value="{{ $batch->name }}" required placeholder="{{ __('app.enter_name') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.status') }}<span class="text-danger">*</span></label>
                    <select class="form-select select2" name="status_id" data-placeholder="{{ __('app.select_status') }}">
                        <option></option>
                        @foreach($statuses as $status)
                            <option value="{{ $status->id }}" {{ $status->id == $batch->status_id ? 'selected' : '' }}>
                                {{ __('app.'.$status->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6 d-none">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.year') }}<span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="text" class="form-control datepicker" name="year" value="{{ $batch->year }}" data-format="Y" placeholder="{{ __('app.year') }}">
                        <i class="fa-solid fa-calendar-days"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.type') }}<span class="text-danger">*</span></label>
                    <select class="form-select select2" name="type_id" required data-placeholder="{{ __('app.select_type') }}">
                        <option></option>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}" {{ $type->id == $batch->type_id ? 'selected' : '' }}>
                                {{ __('app.'.$type->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.start_date') }}<span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="text" class="form-control datepicker" name="start_date" data-format="d/m/Y"
                               value="{{ $batch->start_date?->format('d/m/Y') }}" required placeholder="{{ __('app.start_date') }}">
                        <i class="fa-solid fa-calendar-days"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.end_date') }}<span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="text" class="form-control datepicker" name="end_date" data-format="d/m/Y"
                               value="{{ $batch->end_date?->format('d/m/Y') }}" required placeholder="{{ __('app.end_date') }}">
                        <i class="fa-solid fa-calendar-days"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <label class="form-label">{{ __('app.batch_entry') }}<span class="text-danger">*</span></label>
                <div class="form-group mb-3">
                    <select class="form-select select2" name="entry_id[]" multiple data-placeholder="{{ __('app.batch_entry') }}">
                        <option></option>
                        @foreach($entries as $entry)
                            <option value="{{ $entry->id }}" {{ in_array($entry->id, $batch->entries->pluck('id')->toArray()) ? 'selected' : '' }}>
                                {{ $entry->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <label class="form-label">{{ __('app.batch_checker') }}<span class="text-danger">*</span></label>
                <div class="form-group mb-3">
                    <select class="form-select select2" name="checker_id[]" multiple data-placeholder="{{ __('app.batch_checker') }}">
                        <option></option>
                        @foreach($checkers as $checker)
                            <option value="{{ $checker->id }}" {{ in_array($checker->id, $batch->checkers->pluck('id')->toArray()) ? 'selected' : '' }}>
                                {{ $checker->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.description') }}</label>
                    <textarea class="form-control" name="description" rows="2" placeholder="{{ __('app.enter_description') }}">{{ $batch->description }}</textarea>
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
