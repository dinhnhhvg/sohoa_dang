<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.create') }}</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('admin.lesson_customer.store') }}" onsubmit="commonSubmit(this); return false" enctype="multipart/form-data">
        @csrf
        <div class="row">
            @if(isset($class_customer_id))
                <input type="hidden" name="class_customer_id" value="{{ $class_customer_id }}">
                <div class="col-md-12">
                    <div class="form-group mb-3">
                        <label class="form-label">{{ __('app.lesson') }}<span class="text-danger">*</span></label>
                        <select class="form-select select2" name="lesson_id[]" multiple data-placeholder="{{ __('app.select_lesson') }}">
                            <option value=""></option>
                            @foreach($lessons as $lesson)
                                <option value="{{ $lesson->id }}">{{ $lesson->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @else
                <input type="hidden" name="lesson_id" value="{{ $lesson_id }}">
                <div class="col-md-12">
                    <div class="form-group mb-3">
                        <label class="form-label">{{ __('app.student') }}<span class="text-danger">*</span></label>
                        <select class="form-select select2" name="class_customer_id[]" multiple data-placeholder="{{ __('app.select_student') }}">
                            <option value=""></option>
                            @foreach($classCustomers as $classCustomer)
                                <option value="{{ $classCustomer->id }}">
                                    {{ $classCustomer->customer->code }} - {{ $classCustomer->customer->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.status') }}</label>
                    <select class="form-select select2" name="status_id" data-placeholder="{{ __('app.select_status') }}">
                        <option value=""></option>
                        @foreach($statuses as $status)
                            <option value="{{ $status->id }}">{{ __('app.').$status->name }}</option>
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
