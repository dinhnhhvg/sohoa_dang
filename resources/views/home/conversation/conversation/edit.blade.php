<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.edit') }}</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('conversation.update', ['conversation' => $conversation->id]) }}" onsubmit="conversationSubmit(this); return false" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.name') }}<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" value="{{ $conversation->name }}" required placeholder="{{ __('app.enter_name') }}">
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card card-profile">
                    <div class="card-body p-2">
                        <label class="form-label">{{ __('app.avatar') }}<span class="text-danger">*</span></label>
                        <div class="form-group">
                            <div class="input-group">
                                <img src="{{ asset($conversation->avatar) }}" alt="Image" class="w-100 aspect-ratio-11">
                                <input type="text" name="avatar" class="form-control ps-3" value="{{ $conversation->avatar }}" placeholder="Chọn File" readonly="">
                                <button type="button" class="input-group-text btn btn-primary fa-solid fa-folder-open" onclick="openFileManager(this, 'image')" title="{{ __('app.select_image') }}">
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
