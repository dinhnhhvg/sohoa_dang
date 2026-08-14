<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.show') }}</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                    <img src="{{ asset($user->avatar) }}" alt="Image" class="w-50 aspect-ratio-11 rounded-circle">
                    <h2 class="mb-1 text-center">{{ $user->code }} <br> {{ $user->name }}</h2>
                    <h3 class="mb-2">{{ $user->role->name }}</h3>
                    {!! renderIsActive($user->is_active) !!}
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card h-100">
                <div class="card-body p-0">
                    <ul class="nav nav-tabs nav-tabs-bordered" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link p-3 active" data-bs-toggle="tab" data-bs-target="#tab-information" aria-selected="true" role="tab">
                                <strong>{{ __('app.information') }}</strong>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link p-3" data-bs-toggle="tab" data-bs-target="#tab-edit" aria-selected="false" role="tab" tabindex="-1">
                                <strong>{{ __('app.edit') }}</strong>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link p-3" data-bs-toggle="tab" data-bs-target="#tab-change-password" aria-selected="false" role="tab" tabindex="-1">
                                <strong>{{ __('app.change_password') }}</strong>
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade p-3 active show" id="tab-information" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-3 col-md-4 text-primary mb-2">{{ __('app.full_name') }}</div>
                                <div class="col-lg-9 col-md-8">{{ $user->name }}</div>

                                <div class="col-lg-3 col-md-4 text-primary mb-2">{{ __('app.email') }}</div>
                                <div class="col-lg-9 col-md-8">{{ $user->email }}</div>

                                <div class="col-lg-3 col-md-4 text-primary mb-2">{{ __('app.phone') }}</div>
                                <div class="col-lg-9 col-md-8">{{ $user->phone }}</div>

                                <div class="col-lg-3 col-md-4 text-primary mb-2">{{ __('app.gender') }}</div>
                                <div class="col-lg-9 col-md-8">{{ renderGender($user->gender) }}</div>

                                <div class="col-lg-3 col-md-4 text-primary mb-2">{{ __('app.birth_date') }}</div>
                                <div class="col-lg-9 col-md-8">{{ $user->birth_date?->format('d-m-Y') }}</div>

                                <div class="col-lg-3 col-md-4 text-primary mb-2">{{ __('app.center') }}</div>
                                <div class="col-lg-9 col-md-8">{{ $user->center?->name }}</div>

                                <div class="col-lg-3 col-md-4 text-primary mb-2">{{ __('app.address') }}</div>
                                <div class="col-lg-9 col-md-8">{{ formatAddress($user) }}</div>
                            </div>
                        </div>
                        <div class="tab-pane fade p-3" id="tab-edit" role="tabpanel">
                            <form method="POST" action="{{ route('admin.user.update_profile', ['user' => $user->id]) }}" onsubmit="commonSubmit(this); return false" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">{{ __('app.name') }}<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="name" value="{{ $user->name }}" required placeholder="{{ __('app.enter_name') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">{{ __('app.email') }}<span class="text-danger">*</span></label>
                                                    <input type="email" class="form-control" name="email" value="{{ $user->email }}" required placeholder="{{ __('app.enter_email') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">{{ __('app.phone') }}<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="phone" value="{{ $user->phone }}" oninput="phoneOnly(this)" required placeholder="{{ __('app.enter_phone') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">{{ __('app.gender') }}<span class="text-danger">*</span></label>
                                                    <select class="form-select select2" name="gender" required>
                                                        <option value="male" {{ $user->gender === 'male' ? 'selected' : '' }}>{{ __('app.male') }}</option>
                                                        <option value="female" {{ $user->gender === 'female' ? 'selected' : '' }}>{{ __('app.female') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">{{ __('app.birth_date') }}<span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control datepicker" name="birth_date" data-format="d-m-Y" value="{{ $user->birth_date?->format('d-m-Y') }}" required>
                                                        <i class="fa-solid fa-calendar-days"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">{{ __('app.role') }}<span class="text-danger">*</span></label>
                                                    <select class="form-select select2" name="role_id" required>
                                                        @foreach($roles as $role)
                                                            <option value="{{ $role->id }}" {{ $role->id === $user->role_id ? 'selected' : '' }}>
                                                                {{ $role->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">{{ __('app.center') }}</label>
                                                    <select class="form-select select2" name="center_id" data-placeholder="{{ __('app.select_center') }}">
                                                        <option value=""></option>
                                                        @foreach($centers as $center)
                                                            <option value="{{ $center->id }}" {{ $center->id === $user->center_id ? 'selected' : '' }}>
                                                                {{ $center->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">{{ __('app.province') }}<span class="text-danger">*</span></label>
                                                    <select class="form-select select2" name="province_id" onchange="getWardByProvince(this)" data-placeholder="{{ __('app.select_province') }}" required>
                                                        <option value=""></option>
                                                        @foreach($provinces as $province)
                                                            <option value="{{ $province->id }}" {{ $province->id === $user->province_id ? 'selected' : '' }}>
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
                                                        <option value=""></option>
                                                        @foreach($wards as $ward)
                                                            <option value="{{ $ward->id }}" {{ $ward->id === $user->ward_id ? 'selected' : '' }}>
                                                                {{ $ward->full_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">{{ __('app.address') }}</label>
                                                    <input type="text" class="form-control" name="address" value="{{ $user->address }}" placeholder="{{ __('app.address') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card card-profile">
                                            <div class="card-body p-2">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <img src="{{ asset($user->avatar) }}" alt="Image" class="w-100 aspect-ratio-11">
                                                        <input type="text" name="avatar" class="form-control ps-3" value="{{ $user->avatar }}" placeholder="{{ __('app.select_file') }}" readonly>
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
                        <div class="tab-pane fade p-3" id="tab-change-password" role="tabpanel">
                            <form method="POST" action="{{ route('admin.user.update_profile', ['user' => $user->id]) }}" onsubmit="commonSubmit(this); return false" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{ __('app.new_password') }}<span class="text-danger">*</span></label>
                                            <div class="position-relative mb-3">
                                                <input type="password" class="form-control pe-5" name="password" value="{{ env('APP_DEFAULT_PASSWORD') }}" required placeholder="{{ __('app.enter_new_password') }}">
                                                <button type="button" class="btn btn-link position-absolute end-0 top-0 text-muted" onclick="togglePassword(this)">
                                                    <i class="fa-regular fa-eye-slash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{ __('app.re_enter_new_password') }}<span class="text-danger">*</span></label>
                                            <div class="position-relative mb-3">
                                                <input type="password" class="form-control pe-5" name="password_confirmation" value="{{ env('APP_DEFAULT_PASSWORD') }}" required= placeholder="{{ __('app.re_enter_new_password') }}">
                                                <button type="button" class="btn btn-link position-absolute end-0 top-0 text-muted" onclick="togglePassword(this)">
                                                    <i class="fa-regular fa-eye-slash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <button type="submit" class="btn btn-primary">{{ __('app.save') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
