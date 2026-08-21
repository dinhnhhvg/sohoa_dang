@if(!$judgmentDocument?->judgment?->batch?->end_date?->gte(now()->startOfDay()))
    <div class="text-center">Hết thời hạn nhập liệu - kiểm duyệt</div>
@elseif($action_type === 'entry' && (session('role_code') === 'admin' || session('user_id') == $judgmentDocument->judgment->entry_id) && $judgmentDocument->judgment->status_id == env('APP_JUDGMENT_STATUS_NEW_ID'))
    <div class="overflow-y-auto" style="height: calc(100vh - 155px);">
        <div class="form-group mb-3">
            <select class="form-select select2" name="jd_id" onchange="onchangeJd(this)">
                @foreach($jds as $jd)
                    <option value="{{ $jd->href }}" {{ $jd->id == $judgmentDocument->id ? 'selected' : '' }}>
                        {{ getEndName($jd->file_path) }}
                        @if($jd->document_genre_id)
                            (v)
                        @endif
                    </option>
                @endforeach
            </select>
        </div>
        <div class="accordion" id="accordionJD">
            <div class="accordion-item mb-2">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionJD-folderInfo">
                        <span class="title m-0">THÔNG TIN HỒ SƠ (BÌA)</span>
                    </button>
                </h2>
                <div id="accordionJD-folderInfo" class="accordion-collapse collapse" data-bs-parent="#accordionJD">
                    <div class="accordion-body">
                        @include(env('APP_VIEW_PATH_ADMIN').'.batch.judgment_document.edit.folder_info')
                    </div>
                    <div class="accordion-footer border-top mt-2">
                        <button class="accordion-button collapsed p-3" style="min-height: auto;" type="button" data-bs-toggle="collapse" data-bs-target="#accordionJD-folderInfo" aria-expanded="true"></button>
                    </div>
                </div>
            </div>

            <div class="accordion-item mb-2">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionJD-fileInfo">
                        <span class="title m-0">{{ __('app.information') }} {{ __('app.file') }}</span>
                    </button>
                </h2>
                <div id="accordionJD-fileInfo" class="accordion-collapse collapse" data-bs-parent="#accordionJD">
                    <div class="accordion-body">
                        @include(env('APP_VIEW_PATH_ADMIN').'.batch.judgment_document.edit.file_info')
                    </div>
                    <div class="accordion-footer border-top mt-2">
                        <button class="accordion-button collapsed p-3" style="min-height: auto;" type="button" data-bs-toggle="collapse" data-bs-target="#accordionJD-fileInfo" aria-expanded="true"></button>
                    </div>
                </div>
            </div>

            <div class="accordion-item mb-2">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionJD-info">
                        <span class="title m-0">{{ __('app.information') }} {{ __('app.judgment_document') }}</span>
                    </button>
                </h2>
                <div id="accordionJD-info" class="accordion-collapse collapse" data-bs-parent="#accordionJD">
                    <div class="accordion-body">
                        @include(env('APP_VIEW_PATH_ADMIN').'.batch.judgment_document.edit.judgment')
                    </div>
                    <div class="accordion-footer border-top mt-2">
                        <button class="accordion-button collapsed p-3" style="min-height: auto;" type="button" data-bs-toggle="collapse" data-bs-target="#accordionJD-info" aria-expanded="true"></button>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <button type="button" class="btn btn-primary w-100 mt-2" onclick="saveAll(this)">{{ __('app.save_all') }}</button>
                </div>
                <div class="col-6">
                    <button type="button" class="btn btn-warning w-100 mt-2" onclick="selectNextOption(this)">{{ __('app.next') }}</button>
                </div>
            </div>
        </div>
    </div>
@elseif($action_type === 'check' && (session('role_code') === 'admin' || session('user_id') == $judgmentDocument->judgment->checker_id) && $judgmentDocument->judgment->status_id == env('APP_JUDGMENT_STATUS_ENTRIED_ID'))
    <div class="overflow-y-auto" style="height: calc(100vh - 155px);">
        <div class="form-group mb-3">
            <select class="form-select select2" name="jd_id" onchange="onchangeJd(this)">
                @foreach($jds as $jd)
                    <option value="{{ $jd->href }}" {{ $jd->id == $judgmentDocument->id ? 'selected' : '' }}>
                        {{ getEndName($jd->file_path) }}
                        @if($jd->document_genre_id)
                            (v)
                        @endif
                    </option>
                @endforeach
            </select>
        </div>

        <div class="accordion" id="accordionJD">
            <div class="accordion-item mb-2">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionJD-folderInfo">
                        <span class="title m-0">THÔNG TIN HỒ SƠ (BÌA)</span>
                    </button>
                </h2>
                <div id="accordionJD-folderInfo" class="accordion-collapse collapse" data-bs-parent="#accordionJD">
                    <div class="accordion-body">
                        @include(env('APP_VIEW_PATH_ADMIN').'.batch.judgment_document.edit.folder_info')
                    </div>
                    <div class="accordion-footer border-top mt-2">
                        <button class="accordion-button collapsed p-3" style="min-height: auto;" type="button" data-bs-toggle="collapse" data-bs-target="#accordionJD-folderInfo" aria-expanded="true"></button>
                    </div>
                </div>
            </div>

            <div class="accordion-item mb-2">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionJD-fileInfo">
                        <span class="title m-0">{{ __('app.information') }} {{ __('app.file') }}</span>
                    </button>
                </h2>
                <div id="accordionJD-fileInfo" class="accordion-collapse collapse" data-bs-parent="#accordionJD">
                    <div class="accordion-body">
                        @include(env('APP_VIEW_PATH_ADMIN').'.batch.judgment_document.edit.file_info')
                    </div>
                    <div class="accordion-footer border-top mt-2">
                        <button class="accordion-button collapsed p-3" style="min-height: auto;" type="button" data-bs-toggle="collapse" data-bs-target="#accordionJD-fileInfo" aria-expanded="true"></button>
                    </div>
                </div>
            </div>

            <div class="accordion-item mb-2">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionJD-info">
                        <span class="title m-0">{{ __('app.information') }} {{ __('app.judgment_document') }}</span>
                    </button>
                </h2>
                <div id="accordionJD-info" class="accordion-collapse collapse" data-bs-parent="#accordionJD">
                    <div class="accordion-body">
                        @include(env('APP_VIEW_PATH_ADMIN').'.batch.judgment_document.edit.judgment')
                    </div>
                    <div class="accordion-footer border-top mt-2">
                        <button class="accordion-button collapsed p-3" style="min-height: auto;" type="button" data-bs-toggle="collapse" data-bs-target="#accordionJD-info" aria-expanded="true"></button>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <button type="button" class="btn btn-primary w-100 mt-2" onclick="saveAll(this)">{{ __('app.save_all') }}</button>
                </div>
                <div class="col-6">
                    <button type="button" class="btn btn-warning w-100 mt-2" onclick="selectNextOption(this)">{{ __('app.next') }}</button>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="text-center">Bạn không có quyền nhập liệu - kiểm duyệt</div>
@endif
