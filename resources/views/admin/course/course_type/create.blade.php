<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.create') }}</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('admin.course_type.store') }}" onsubmit="commonSubmit(this); return false" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="course_id" value="{{ $course_id }}">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.course_type') }}<span class="text-danger">*</span></label>
                    <select class="form-select select2" name="type_id" required data-placeholder="{{ __('app.select_course_type') }}">
                        <option value=""></option>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}">{{ __('app.'.$type->name) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.price') }}<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="price" value="0" onkeyup="addCommas(this)" required placeholder="{{ __('app.enter_price') }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.duration') }}<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="duration" required placeholder="{{ __('app.enter_duration') }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.lesson_count') }}</label>
                    <input type="number" class="form-control" name="lesson_count" placeholder="{{ __('app.enter_lesson_count') }}">
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
