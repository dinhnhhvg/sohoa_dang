<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.edit') }}</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('admin.lesson.update', ['lesson' => $lesson->id]) }}" onsubmit="commonSubmit(this); return false" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <input type="hidden" name="class_id" value="{{ $lesson->class_id }}">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.name') }}<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" value="{{ $lesson->name }}" required placeholder="{{ __('enter_name') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.date') }}<span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="text" class="form-control datepicker" name="date" value="{{ $lesson->date?->format('d-m-Y') }}" placeholder="{{ __('app.enter_date') }}" data-format="d-m-Y" required>
                        <i class="fa-solid fa-calendar-days"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('app.start_time') }}<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control timepicker" name="start_time" value="{{ $lesson->start_time?->format('H:i') }}" placeholder="{{ __('app.start_time') }}" data-format="H:i" required>
                                <i class="fa-solid fa-clock"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('app.end_time') }}<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control timepicker" name="end_time" value="{{ $lesson->end_time?->format('H:i') }}" placeholder="{{ __('app.end_time') }}" data-format="H:i" required>
                                <i class="fa-solid fa-clock"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.type') }}<span class="text-danger">*</span></label>
                    <select class="form-select select2" name="type_id" data-placeholder="{{ __('app.select_type') }}">
                        <option value=""></option>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}" {{ $lesson->type_id === $type->id ? 'selected' : '' }}>
                                {{ __('app.').$type->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.center') }}</label>
                    <select class="form-select select2" name="center_id" onchange="getClassroomByCenter(this)" data-placeholder="{{ __('app.select_center') }}">
                        <option value=""></option>
                        @foreach($centers as $center)
                            <option value="{{ $center->id }}" {{ $lesson->center_id == $center->id ? 'selected' : '' }}>
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
                            <option value="{{ $classroom->id }}" {{ $classroom->id == $lesson->classroom_id ? 'selected' : '' }}>
                                {{ $classroom->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.content') }}</label>
                    <textarea class="form-control" name="content" rows="2" placeholder="{{ __('app.enter_content') }}">{{ $lesson->content }}</textarea>
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
