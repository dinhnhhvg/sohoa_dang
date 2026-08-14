<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.create') }}</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('admin.order_item.store') }}" onsubmit="commonSubmit(this); return false" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="order_id" value="{{ $order_id }}">
        <input type="hidden" name="type_code" value="{{ $type_code }}">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.course') }}<span class="text-danger">*</span></label>
                    <select class="form-select2 select2" name="course_type_id" required data-placeholder="{{ __('app.select_course') }}">
                        <option></option>
                        @foreach($courseTypes as $courseType)
                            <option value="{{ $courseType->id }}">
                                {{ $courseType->course->name }} - {{ __('app.'.$courseType->type->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.content') }}</label>
                    <textarea class="form-control" name="content" rows="2" placeholder="{{ __('app.enter_content') }}"></textarea>
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
