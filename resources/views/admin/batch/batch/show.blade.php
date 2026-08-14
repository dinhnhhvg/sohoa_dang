<div class="row">
    <div class="col-xxl-8 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-center align-items-center my-5 text-center">
                    <div>
                        <div class="d-inline-block mb-3">
                            <div class="aspect-ratio-11 rounded-circle bg-secondary p-3">
                                <i class="fa-solid fa-layer-group text-primary" style="font-size: 40px"></i>
                            </div>
                        </div>
                        <div class="text-center">
                            <h5><strong>Kiểm đếm sản lượng Lô</strong></h5>
                            <p>Chọn thư mục chứa hồ sơ đã quét để hệ thống tự động<br> bóc tách và tạo báo cáo kiểm đếm.</p>
                            <div class="form-group mb-3">
                                <div class="input-group">
                                    <input type="hidden" name="folder_path" value="{{ $batch->folder_path }}" class="form-control ps-3" placeholder="Chọn File" readonly="">
                                    <button type="button" class="input-group-text btn btn-primary text-uppercase w-100" title="Chọn File" onclick="openFileManager(this, '{{ $batch->folder_path }}')">
                                        Tải lên thư mục thực tế
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xxl-4 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">{{ __('app.report') }} {{ __('app.progress') }}</h5>
            </div>
            <div class="card-body">
                <p>{{ __('app.status') }}: <span class="float-end badge bg-primary">{{ __('app.'.$batch->status->name) }}</span></p>
                <p class="mb-1">{{ __('app.progress') }} {{ __('app.time') }}:</p>
                <div class="mb-3">{!! renderTimeProgress($batch->start_date, $batch->end_date) !!}</div>
                <p class="mb-1">{{ __('app.progress') }} {{ __('app.entry') }}: <span class="float-end">{{ $batch->entry_rate ?? 0 }}%</span></p>
                <div class="mb-3">{!! renderProgress($batch->entry_rate ?? 0) !!}</div>
                <p class="mb-1">{{ __('app.progress') }} {{ __('app.check') }}: <span class="float-end">{{ $batch->check_rate ?? 0 }}%</span></p>
                <div class="mb-3">{!! renderProgress($batch->check_rate ?? 0) !!}</div>
            </div>
        </div>
    </div>

    <div class="col-xxl-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">{{ __('app.info') }} {{ __('app.batch') }}</h5>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center text-center text-uppercase">
                    <div class="flex-fill fw-bold">
                        <div>{{ __('app.folder') }}</div>
                        <div class="fs-4 text-primary">{{ numberFormat($batch->judgments_count ?? 0) }}</div>
                    </div>
                    <div class="flex-fill fw-bold">
                        <div>{{ __('app.file') }}</div>
                        <div class="fs-4 text-primary">{{ numberFormat($batch->judgment_documents_count ?? 0) }}</div>
                    </div>
                    <div class="flex-fill fw-bold">
                        <div>{{ __('app.page') }}</div>
                        <div class="fs-4 text-primary">{{ numberFormat($batch->pages_sum ?? 0) }}</div>
                    </div>
                    <div class="flex-fill fw-bold">
                        <div>{{ __('app.sheet') }}</div>
                        <div class="fs-4 text-primary">{{ numberFormat($batch->sheets_sum ?? 0) }}</div>
                    </div>
                    <div class="flex-fill fw-bold">
                        <div>{{ __('app.size') }}</div>
                        <div class="fs-4 text-primary">{{ formatSizeUnit($batch->file_size_sum ?? 0) }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xxl-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">{{ __('app.automated_censorship_report') }}</h5>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center text-center text-uppercase">
                    <div class="flex-fill fw-bold">
                        <div>{{ __('app.judgment') }}</div>
                        <div class="fs-4">{{ numberFormat($batch->judgments_count ?? 0) }}</div>
                    </div>
                    <div class="flex-fill fw-bold text-success">
                        <div>{{ __('app.judgment') }} {{ __('app.entry') }}</div>
                        <div class="fs-4">{{ numberFormat($batch->entry_judgments_count ?? 0) }}</div>
                    </div>
                    <div class="flex-fill fw-bold text-primary">
                        <div>{{ __('app.judgment') }} {{ __('app.check') }}</div>
                        <div class="fs-4">{{ numberFormat($batch->check_judgments_count ?? 0) }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
