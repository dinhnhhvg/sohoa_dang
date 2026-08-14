<form method="POST" action="{{ route('admin.setting.update') }}" onsubmit="commonSubmit(this, false, false); return false" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="row">
        <div class="col-md-4">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.user') }}<span class="text-danger">*</span></label>
                <select class="form-select select2" name="default_user_id" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $user->id === env('APP_DEFAULT_USER_ID') ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.center') }}<span class="text-danger">*</span></label>
                <select class="form-select select2" name="default_center_id" required>
                    @foreach($centers as $center)
                        <option value="{{ $center->id }}" {{ $center->id === env('APP_DEFAULT_CENTER_ID') ? 'selected' : '' }}>
                            {{ $center->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.agency') }}<span class="text-danger">*</span></label>
                <select class="form-select select2" name="default_agency_id" required>
                    @foreach($agencies as $agency)
                        <option value="{{ $agency->id }}" {{ $agency->id === env('APP_DEFAULT_AGENCY_ID') ? 'selected' : '' }}>
                            {{ $agency->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.province') }}<span class="text-danger">*</span></label>
                <select class="form-select select2" name="default_province_id" required>
                    @foreach($provinces as $province)
                        <option value="{{ $province->id }}" {{ $province->id === env('APP_DEFAULT_PROVINCE_ID') ? 'selected' : '' }}>
                            {{ $province->full_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.per_page') }}<span class="text-danger">*</span></label>
                <select class="form-select select2" name="default_per_page" required>
                    <option value="25" {{ 25 === env('APP_DEFAULT_PER_PAGE') ? 'selected' : '' }}>25</option>
                    <option value="50" {{ 50 === env('APP_DEFAULT_PER_PAGE') ? 'selected' : '' }}>50</option>
                    <option value="100" {{ 100 === env('APP_DEFAULT_PER_PAGE') ? 'selected' : '' }}>100</option>
                    <option value="0" {{ !env('APP_DEFAULT_PER_PAGE') ? 'selected' : '' }}>All</option>
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('app.password') }}<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="default_password" value="{{ env('APP_DEFAULT_PASSWORD') }}" required placeholder="{{ __('app.enter_password') }}">
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group mb-3">
                <button type="submit" class="btn btn-primary w-100">{{ __('app.save') }}</button>
            </div>
        </div>
    </div>
</form>
