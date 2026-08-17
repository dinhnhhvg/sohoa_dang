<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.edit') }}: THÔNG TIN HỒ SƠ (BÌA)</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('admin.judgment.update', ['judgment' => $judgment->id]) }}"
          onsubmit="judgmentUpdate(this); return false" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-md-6">
                <label class="form-label">{{ __('app.language') }}<span class="text-danger">*</span></label>
                <div class="form-group mb-3">
                    <select class="form-select select2" name="language_id[]" multiple data-placeholder="{{ __('app.select') }}">
                        @foreach($languages as $language)
                            <option value="{{ $language->id }}" {{ in_array($language->id, $judgment->languages->pluck('id')->toArray()) ? 'selected' : '' }}>
                                {{ renderCodeName($language) }}
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
                            <option value="{{ $physicalCondition->id }}" {{ $physicalCondition->id == $judgment->physical_condition_id ? 'selected' : '' }}>
                                {{ renderCodeName($physicalCondition) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-12">
                @if(session('role_code') === 'admin')
                    <label class="form-label">{{ __('app.status') }}<span class="text-danger">*</span></label>
                    <div class="form-group mb-3">
                        <select class="form-select select2" name="status_id" data-placeholder="{{ __('app.select_status') }}">
                            @foreach($statuses as $status)
                                <option value="{{ $status->id }}" {{ $status->id == $judgment->status_id ? 'selected' : '' }}>
                                    {{ __('app.'.$status->name) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @else
                    @if($judgment->status_id == env('APP_JUDGMENT_STATUS_NEW_ID') && $judgment->entry_id == session('user_id'))
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="status_id" value="{{ env('APP_JUDGMENT_STATUS_ENTRIED_ID') }}">
                            <label class="form-check-label">Xác nhận đã hoàn thành phần nhập liệu</label>
                        </div>
                    @endif
                    @if($judgment->status_id == env('APP_JUDGMENT_STATUS_ENTRIED_ID') && $judgment->checker_id == session('user_id'))
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="status_id" value="{{ env('APP_JUDGMENT_STATUS_CHECKED_ID') }}">
                            <label class="form-check-label">Xác nhận đã hoàn thành phần kiểm duyệt</label>
                        </div>
                    @endif
                @endif
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.description') }}</label>
                    <textarea class="form-control" name="description" rows="2" placeholder="{{ __('app.enter_description') }}">{{ $judgment->description }}</textarea>
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
