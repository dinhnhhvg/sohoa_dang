<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.create_lesson_list') }}</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form method="POST" action="" onsubmit="commonSubmit(this, false, false); return false" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="ids" value="{{ $ids }}">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('app.start_date') }}<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control datepicker" name="start_date" placeholder="{{ __('app.start_date') }}" data-format="d-m-Y" required>
                                <i class="fa-solid fa-calendar-days"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('app.end_date') }}<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control datepicker" name="end_date" placeholder="{{ __('app.end_date') }}" data-format="d-m-Y" required>
                                <i class="fa-solid fa-calendar-days"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <button type="button" class="btn btn-primary" onclick="changeActionForForm(this, '{{ route('admin.lesson_schedule.expected_schedule') }}')">
                        {{ __('app.expected_schedule') }}
                    </button>
                    <button type="button" class="btn btn-primary" onclick="changeActionForForm(this, '{{ route('admin.lesson_schedule.store_lesson') }}')">
                        {{ __('app.save') }}
                    </button>
                </div>
            </div>
            <div class="col-md-12">
                <div class="show-log-message"></div>
            </div>
        </div>
    </form>
</div>
