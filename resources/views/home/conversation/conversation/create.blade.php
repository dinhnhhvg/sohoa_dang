<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.create') }}</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('conversation.store') }}" onsubmit="conversationSubmit(this); return false" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="is_group" value="{{ $is_group ?? 0 }}">
        <div class="row">
            @if(isset($is_group) && $is_group)
                <div class="col-md-12">
                    <div class="form-group mb-3">
                        <label class="form-label">{{ __('app.name') }}<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" required placeholder="{{ __('app.enter_name') }}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group mb-3">
                        <label class="form-label">{{ __('app.member') }}<span class="text-danger">*</span></label>
                        <select class="form-select select2" name="member_id[]" multiple data-placeholder="{{ __('app.select_member') }}" required>
                            <option value=""></option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @else
                <div class="col-md-12 d-none">
                    <div class="form-group mb-3">
                        <label class="form-label">{{ __('app.name') }}<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" value="..." required placeholder="{{ __('app.enter_name') }}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group mb-3">
                        <label class="form-label">{{ __('app.member') }}<span class="text-danger">*</span></label>
                        <select class="form-select select2" name="member_id[]" data-placeholder="{{ __('app.select_member') }}" required>
                            <option value=""></option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <button type="submit" class="btn btn-primary">{{ __('app.save') }}</button>
                </div>
            </div>
        </div>
    </form>
</div>
