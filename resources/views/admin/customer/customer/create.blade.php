<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.create') }}</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('admin.customer.store') }}" onsubmit="commonSubmit(this); return false" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('app.name') }}<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" required placeholder="{{ __('app.enter_name') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('app.email') }}<span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email" required placeholder="{{ __('app.enter_email') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('app.phone') }}<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="phone" oninput="phoneOnly(this)" required placeholder="{{ __('app.enter_phone') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('app.gender') }}<span class="text-danger">*</span></label>
                            <select class="form-select select2" name="gender" required>
                                <option value="male">{{ __('app.male') }}</option>
                                <option value="female">{{ __('app.female') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('app.birth_date') }}</label>
                            <div class="input-group">
                                <input type="text" class="form-control datepicker" name="birth_date" data-format="d-m-Y" placeholder="{{ __('app.birth_date') }}">
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
                                    <option value="{{ $center->id }}">{{ $center->name }}</option>
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
                                    <option value="{{ $agency->id }}">{{ $agency->name }}</option>
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
                                    <option value="{{ $customerTag->id }}">{{ $customerTag->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('app.province') }}<span class="text-danger">*</span></label>
                            <select class="form-select select2" name="province_id" onchange="getWardByProvince(this)" data-placeholder="{{ __('app.select_province') }}" required>
                                @foreach($provinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('app.ward') }}</label>
                            <select class="form-select select2" name="ward_id" data-placeholder="{{ __('app.select_ward') }}">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('app.address') }}</label>
                            <input type="text" class="form-control" name="address" placeholder="{{ __('app.address') }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card card-profile">
                    <div class="card-body p-2">
                        <div class="form-group">
                            <div class="input-group">
                                <img src="{{ asset(env('APP_DEFAULT_AVATAR')) }}" alt="Image" class="w-100 aspect-ratio-11">
                                <input type="text" name="avatar" class="form-control ps-3" value="{{ env('APP_DEFAULT_AVATAR') }}" placeholder="{{ __('app.select_file') }}" readonly>
                                <button type="button" class="input-group-text btn btn-primary fa-solid fa-folder-open" title="{{ __('app.select_file') }}"
                                        onclick="openFileManager(this, 'image')">
                                </button>
                            </div>
                        </div>
                    </div>
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
