<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.edit') }}</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('admin.classroom.update', ['classroom' => $classroom->id]) }}" onsubmit="commonSubmit(this); return false" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.center') }}<span class="text-danger">*</span></label>
                    <select class="form-select select2" name="center_id" required data-placeholder="{{ __('app.select_center') }}" required>
                        <option value=""></option>
                        @foreach($centers as $center)
                            <option value="{{ $center->id }}" {{ $center->id === $classroom->center_id ? 'selected' : '' }}>
                                {{ $center->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.name') }}<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" value="{{ $classroom->name }}" required placeholder="{{ __('app.enter_name') }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.capacity') }}<span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="capacity" value="{{ $classroom->capacity }}" required placeholder="{{ __('app.enter_capacity') }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.locale') }}<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="locale" value="{{ $classroom->locale }}" required placeholder="{{ __('app.enter_locale') }}">
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
