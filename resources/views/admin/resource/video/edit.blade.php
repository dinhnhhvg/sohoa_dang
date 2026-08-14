<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.edit') }}</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('admin.video.update', ['video' => $video->id]) }}" onsubmit="commonSubmit(this); return false" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.name') }}<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" value="{{ $video->name }}" required placeholder="{{ __('app.enter_name') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.category') }}<span class="text-danger">*</span></label>
                    <select class="form-select select2" name="category_id" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id === $video->category_id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.type') }}<span class="text-danger">*</span></label>
                    <select class="form-select select2" name="type_id" onchange="changeVideoType(this)">
                        @foreach($types as $type)
                            <option value="{{ $type->id }}" data-code="{{ $type->code }}" {{ $type->id === $video->type_id ? 'selected' : '' }}>
                                {{ __('app.'.$type->code) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.videoId') }}<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" value="{{ $video->videoId }}" name="videoId" required>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.description') }}</label>
                    <textarea class="form-control" name="description" rows="2">{{ $video->description }}</textarea>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.order_number') }}<span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="order_number" value="{{ $video->order_number }}" required placeholder="{{ __('app.enter_order_number') }}">
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

<script>
    $('select[name="type_id"]').trigger('change');
</script>
