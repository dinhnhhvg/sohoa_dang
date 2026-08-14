<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.edit') }}</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('admin.old_ward.update', ['old_ward' => $oldWard->id]) }}" onsubmit="commonSubmit(this); return false" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.province') }}<span class="text-danger">*</span></label>
                    <select class="form-select select2" name="old_province_id" data-placeholder="{{ __('app.select_province') }}">
                        <option value=""></option>
                        @foreach($oldProvinces as $province)
                            <option value="{{ $province->id }}" {{ $province->id == $oldWard->old_province_id ? 'selected' : '' }}>
                                {{ $province->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.district') }}<span class="text-danger">*</span></label>
                    <select class="form-select select2" name="old_district_id" data-placeholder="{{ __('app.select_district') }}">
                        <option value=""></option>
                        @foreach($oldDistricts as $districts)
                            <option value="{{ $districts->id }}" {{ $districts->id == $oldWard->old_district_id ? 'selected' : '' }}>
                                {{ $districts->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.prefix') }}<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="prefix" value="{{ $oldWard->prefix }}" placeholder="{{ __('app.enter_prefix') }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.name') }}<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" value="{{ $oldWard->name }}" required placeholder="{{ __('app.enter_name') }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.code') }}<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="code" value="{{ $oldWard->code }}" required placeholder="{{ __('app.enter_code') }}">
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
