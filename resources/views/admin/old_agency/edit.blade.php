<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.edit') }}</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('admin.old_agency.update', ['old_agency' => $oldAgency->id]) }}" onsubmit="commonSubmit(this); return false" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.name') }}<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" value="{{ $oldAgency->name }}" required placeholder="{{ __('app.enter_name') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.code') }}<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="code" value="{{ $oldAgency->code }}" required placeholder="{{ __('app.enter_code') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.email') }}</label>
                    <input type="email" class="form-control" name="email" value="{{ $oldAgency->email }}" placeholder="{{ __('app.enter_email') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.phone') }}</label>
                    <input type="text" class="form-control" name="phone" value="{{ $oldAgency->phone }}" oninput="phoneOnly(this)" placeholder="{{ __('app.enter_phone') }}">
                </div>
            </div>
            <div class="col-md-6 d-none">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.province') }}</label>
                    <select class="form-select select2" name="province_id" onchange="getWardByProvince(this)" data-placeholder="{{ __('app.select_province') }}">
                        <option value=""></option>
                        @foreach($oldAgencies as $oa)
                            <option value="{{ $oa->id }}" {{ $oa->id === $oldAgency->province_id ? 'selected' : '' }}>
                                {{ $oa->code }}-{{ $oa->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.description') }}</label>
                    <textarea class="form-control" name="description" rows="2" placeholder="{{ __('app.enter_description') }}">{{ $oldAgency->description }}</textarea>
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
