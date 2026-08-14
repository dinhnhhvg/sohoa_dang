<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.create') }}</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('admin.chapter_video.store') }}" onsubmit="commonSubmit(this); return false" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="chapter_id" value="{{ $chapter_id }}">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.name') }}<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" required placeholder="{{ __('app.enter_name') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.video_type') }}<span class="text-danger">*</span></label>
                    <select class="form-select select2" name="type_id" required onchange="commonChangeType('video_type', this)">
                        @foreach($types as $type):
                            <option value="{{ $type->id }}" data-code="{{ $type->code }}">
                                {{ __('app.'.$type->code) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.video_type') }}<span class="text-danger">*</span></label>
                    <select class="form-select select2 video_type video_security" name="video_id" data-placeholder="{{ __('app.select_video') }}">
                        <option value=""></option>
                        @foreach($videos as $video)
                            <option value="{{ $video->id }}">{{ $video->category->name }} - {{ $video->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-12 d-none">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.src_link') }}<span class="text-danger">*</span></label>
                    <input type="text" class="form-control video_type video_other" name="src" placeholder="{{ __('app.enter_src_link') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.duration') }} ({{ __('app.second') }})<span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="duration" value="60" placeholder="{{ __('app.enter_duration') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.max_view') }}</label>
                    <input type="number" class="form-control" name="max_view" placeholder="{{ __('app.enter_max_view') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.is_free') }}<span class="text-danger">*</span></label>
                    <select class="form-select select2" name="is_free">
                        <option value="0">{{ __('app.no') }}</option>
                        <option value="1">{{ __('app.yes') }}</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.order_number') }}<span class="text-danger">*</span></label>
                    <input class="form-control" type="number" name="order_number" value="1" required>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.content') }}</label>
                    <textarea class="form-control ckeditor-render" name="content"></textarea>
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
