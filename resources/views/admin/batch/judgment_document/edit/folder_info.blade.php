@php
    $judgment = $judgmentDocument->judgment;
    $folderPathArray = explode('/', $judgment->folder_path);
    $folderPathArray = array_reverse($folderPathArray);
@endphp

<form method="POST" action="{{ route('admin.judgment.update', ['judgment' => $judgment->id]) }}"
      onsubmit="commonSubmit(this, false, false); return false" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="row">
        <div class="col-md-12">
            <label class="form-label">{{ __('app.font') }}<span class="text-danger">*</span></label>
            <div class="form-group mb-3">
                <select class="form-select select2" name="font_id" data-placeholder="{{ __('app.select') }} {{ __('app.font') }}">
                    @foreach($fonts as $font)
                        <option value="{{ $font->id }}" {{ $font->id == $judgment->font_id ? 'selected' : '' }}>
                            {{ renderCodeName($font) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.table_of_contents_number') }}</label>
                <input type="text" class="form-control" name="table_of_contents_number" value="{{ $judgment->table_of_contents_number }}" placeholder="{{ __('app.enter_value') }}">
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.box_number') }}</label>
                <input type="text" class="form-control" name="box_number" value="{{ $judgment->box_number ?: ($folderPathArray[1] ?? '') }}" placeholder="{{ __('app.enter_value') }}">
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.dossier_number') }}</label>
                <input type="text" class="form-control" name="dossier_number" value="{{ $judgment->dossier_number ?? ($folderPathArray[0] ?? '') }}" placeholder="{{ __('app.enter_value') }}">
            </div>
        </div>

        <div class="col-md-12">
            <label class="form-label">{{ __('app.retention_period') }}<span class="text-danger">*</span></label>
            <div class="form-group mb-3">
                <select class="form-select select2" name="retention_period_id" data-placeholder="{{ __('app.select_type') }}">
                    @foreach($retentionPeriods as $retentionPeriod)
                        <option value="{{ $retentionPeriod->id }}" {{ $retentionPeriod->id == $judgment->retention_period_id ? 'selected' : '' }}>
                            {{ $retentionPeriod->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-12">
            <label class="form-label">{{ __('app.tenure_period') }}<span class="text-danger">*</span></label>
            <div class="form-group mb-3">
                <select class="form-select select2" name="tenure_period_id" data-placeholder="{{ __('app.select_type') }}">
                    @foreach($tenurePeriods as $tenurePeriod)
                        <option value="{{ $tenurePeriod->id }}" {{ $tenurePeriod->id == $judgment->tenure_period_id ? 'selected' : '' }}>
                            {{ $tenurePeriod->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.dossier_title') }}<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="dossier_title" value="{{ $judgment->dossier_title }}" placeholder="{{ __('app.enter_value') }}">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.start_date') }}<span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="text" class="form-control datepicker" name="start_date" data-format="d/m/Y"
                           value="{{ $judgment->start_date?->format('d/m/Y') }}" required placeholder="{{ __('app.start_date') }}">
                    <i class="fa-solid fa-calendar-days"></i>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.end_date') }}<span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="text" class="form-control datepicker" name="end_date" data-format="d/m/Y"
                           value="{{ $judgment->end_date?->format('d/m/Y') }}" required placeholder="{{ __('app.end_date') }}">
                    <i class="fa-solid fa-calendar-days"></i>
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
