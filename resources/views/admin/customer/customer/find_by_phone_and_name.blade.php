<input type="hidden" name="avatar" value="{{ env('APP_DEFAULT_AVATAR') }}">
<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label class="form-label">{{ __('app.name') }}<span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="name" value="{{ $customer->name }}" onchange="searchCustomer(this)" required placeholder="{{ __('app.enter_name') }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label class="form-label">{{ __('app.phone') }}<span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="phone" value="{{ $customer->phone }}" oninput="phoneOnly(this)" onchange="searchCustomer(this)" required placeholder="{{ __('app.enter_phone') }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label class="form-label">{{ __('app.email') }}<span class="text-danger">*</span></label>
            <input type="email" class="form-control" name="email" value="{{ $customer->email }}" required placeholder="{{ __('app.enter_email') }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label class="form-label">{{ __('app.gender') }}<span class="text-danger">*</span></label>
            <select class="form-select select2" name="gender" required>
                <option value="male" {{ $customer->gender === 'male' ? 'selected' : '' }}>{{ __('app.male') }}</option>
                <option value="female" {{ $customer->gender === 'female' ? 'selected' : '' }}>{{ __('app.female') }}</option>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label class="form-label">{{ __('app.birth_date') }}</label>
            <div class="input-group">
                <input type="text" class="form-control datepicker" name="birth_date" data-format="d-m-Y" value="{{ $customer->birth_date?->format('d-m-Y') }}" placeholder="{{ __('app.birth_date') }}">
                <i class="fa-solid fa-calendar-days"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label class="form-label">{{ __('app.center') }}</label>
            <select class="form-select select2" name="center_id" data-placeholder="{{ __('app.select_center') }}">
                <option value=""></option>
                @foreach($centers as $center)
                    <option value="{{ $center->id }}" {{ $center->id == $customer->center_id ? 'selected' : '' }}>
                        {{ $center->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label class="form-label">{{ __('app.agency') }}</label>
            <select class="form-select select2" name="agency_id" data-placeholder="{{ __('app.select_agency') }}">
                <option value=""></option>
                @foreach($agencies as $agency)
                    <option value="{{ $agency->id }}" {{ $agency->id == $customer->agency_id ? 'selected' : '' }}>
                        {{ $agency->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label class="form-label">{{ __('app.customer_tag') }}</label>
            <select class="form-select select2" name="customer_tag_id" data-placeholder="{{ __('app.select_customer_tag') }}">
                <option value=""></option>
                @foreach($customerTags as $customerTag)
                    <option value="{{ $customerTag->id }}" {{ $customerTag->id == $customer->customer_tag_id ? 'selected' : '' }}>
                        {{ $customerTag->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label class="form-label">{{ __('app.province') }}<span class="text-danger">*</span></label>
            <select class="form-select select2" name="province_id" onchange="getWardByProvince(this)" data-placeholder="{{ __('app.select_province') }}" required>
                @foreach($provinces as $province)
                    <option value="{{ $province->id }}" {{ $province->id == $customer->province_id ? 'selected' : '' }}>
                        {{ $province->full_name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label class="form-label">{{ __('app.ward') }}</label>
            <select class="form-select select2" name="ward_id" data-placeholder="{{ __('app.select_ward') }}">
                @foreach($wards as $ward)
                    <option value="{{ $ward->id }}" {{ $ward->id == $customer->ward_id ? 'selected' : '' }}>
                        {{ $ward->full_name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label class="form-label">{{ __('app.address') }}</label>
            <input type="text" class="form-control" name="address" value="{{ $customer->address }}" placeholder="{{ __('app.address') }}">
        </div>
    </div>
</div>
