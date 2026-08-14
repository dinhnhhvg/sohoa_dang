<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.edit') }}</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('admin.class.update', ['class' => $class->id]) }}" onsubmit="commonSubmit(this); return false" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.name') }}<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" value="{{ $class->name }}" required placeholder="{{ __('app.enter_name') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.code') }}<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="code" value="{{ $class->code }}" required placeholder="{{ __('app.enter_code') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.status') }}<span class="text-danger">*</span></label>
                    <select class="form-select select2" name="status_id" data-placeholder="{{ __('app.select_status') }}">
                        @foreach($statuses as $status)
                            <option value="{{ $status->id }}" {{ $status->id == $class->status_id ? 'selected' : '' }}>
                                {{ __('app.').$status->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('app.start_date') }}</label>
                            <div class="input-group">
                                <input type="text" class="form-control datepicker" name="start_date" data-format="d-m-Y" value="{{ $class->start_date?->format('d-m-Y') }}">
                                <i class="fa-solid fa-calendar-days"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('app.end_date') }}</label>
                            <div class="input-group">
                                <input type="text" class="form-control datepicker" name="end_date" data-format="d-m-Y" value="{{ $class->end_date?->format('d-m-Y') }}">
                                <i class="fa-solid fa-calendar-days"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.center') }}</label>
                    <select class="form-select select2" name="center_id" onchange="getClassroomByCenter(this)" data-placeholder="{{ __('app.select_center') }}">
                        <option value=""></option>
                        @foreach($centers as $center)
                            <option value="{{ $center->id }}" {{ $center->id == $class->center_id ? 'selected' : '' }}>
                                {{ $center->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.classroom') }}</label>
                    <select class="form-select select2" name="classroom_id" data-placeholder="{{ __('app.select_classroom') }}">
                        <option value=""></option>
                        @foreach($classrooms as $classroom)
                            <option value="{{ $classroom->id }}" {{ $classroom->id == $class->classroom_id ? 'selected' : '' }}>
                                {{ $classroom->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.capacity') }}</label>
                    <input type="number" class="form-control" name="capacity" value="{{ $class->capacity }}" placeholder="{{ __('app.enter_capacity') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.schedule') }}</label>
                    <input type="text" class="form-control" name="schedule" value="{{ $class->schedule }}" placeholder="{{ __('app.enter_schedule') }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.description') }}</label>
                    <textarea class="form-control ckeditor-render" name="description">{{ $class->description }}</textarea>
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
