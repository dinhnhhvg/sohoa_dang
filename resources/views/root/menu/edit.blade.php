<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.edit') }}</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('root.menu.update', ['menu' => $menu->id]) }}" onsubmit="commonSubmit(this); return false" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.account') }}<span class="text-danger">*</span></label>
                    <select class="form-select select2" name="account" required>
                        @foreach($accounts as $account)
                            <option value="{{ $account->code }}" {{ $account->code === $menu->account ? 'selected' : '' }}>
                                {{ $account->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.menu') }}</label>
                    <select class="form-select select2" name="parent_id" data-placeholder="{{ __('app.select_menu') }}">
                        <option value=""></option>
                        @foreach($menus as $parentMenu)
                            <option value="{{ $parentMenu->id }}" {{ $parentMenu->id === $menu->parent_id ? 'selected' : '' }}>
                                {{ $parentMenu->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.name') }}<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" value="{{ $menu->name }}" required placeholder="{{ __('app.enter_name') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.router') }}</label>
                    <input type="text" class="form-control" name="router" value="{{ $menu->router }}" placeholder="{{ __('app.enter_router') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.icon') }}</label>
                    <input type="text" class="form-control" name="icon" value="{{ $menu->icon }}" placeholder="{{ __('app.enter_icon') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.lock') }}<span class="text-danger">*</span></label>
                    <select class="form-select select2" name="is_menu" data-placeholder="{{ __('app.select') }}">
                        <option value="1" {{ $menu->is_menu == 1 ? 'selected' : '' }}>{{ __('app.active') }}</option>
                        <option value="0" {{ $menu->is_menu == 0 ? 'selected' : '' }}>{{ __('app.inactive') }}</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.order_number') }}<span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="order_number" value="{{ $menu->order_number }}" required placeholder="{{ __('app.enter_order_number') }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.action') }}<span class="text-danger">*</span></label>
                    <select class="form-select select2" name="action_ids[]" data-placeholder="{{ __('app.select_action') }}" multiple>
                        <option value=""></option>
                        @foreach($actions as $action)
                            <option value="{{ $action->id }}">{{ $action->name }}</option>
                        @endforeach
                    </select>
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
