<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.edit') }}</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('admin.old_district.update', ['old_district' => $oldDistrict->id]) }}" onsubmit="commonSubmit(this); return false" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.province') }}<span class="text-danger">*</span></label>
                    <select class="form-select select2" name="province_id" data-placeholder="{{ __('app.select_province') }}">
                        <option value=""></option>
                        @foreach($oldProvinces as $province)
                            <option value="{{ $province->id }}" {{ $province->id == $oldDistrict->old_province_id ? 'selected' : '' }}>
                                {{ $province->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.prefix') }}<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="prefix" value="{{ $oldDistrict->prefix }}" placeholder="{{ __('app.enter_prefix') }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.name') }}<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" value="{{ $oldDistrict->name }}" required placeholder="{{ __('app.enter_name') }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.code') }}<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="code" value="{{ $oldDistrict->code }}" required placeholder="{{ __('app.enter_code') }}">
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
