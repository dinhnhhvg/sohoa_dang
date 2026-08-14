<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.message.add_student_to_the_lesson') }}</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('admin.lesson_customer.store_many') }}" onsubmit="commonSubmit(this); return false" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <input type="hidden" name="class_id" value="{{ $class_id }}">
            <input type="hidden" name="class_customer_ids" value="{{ $ids }}">
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.lesson') }}<span class="text-danger">*</span></label>
                    <select class="form-select select2" name="lesson_id[]" multiple required data-placeholder="{{ __('app.select_lesson') }}">
                        <option value=""></option>
                        <option value="0">{{ __('app.all') }}</option>
                        @foreach($lessons as $lesson)
                            <option value="{{ $lesson->id }}">{{ $lesson->name }}</option>
                        @endforeach
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
