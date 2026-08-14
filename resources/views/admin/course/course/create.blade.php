<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.create') }}</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('admin.course.store') }}" onsubmit="commonSubmit(this); return false" enctype="multipart/form-data">
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
                            <label class="form-label">{{ __('app.code') }}<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="code" required placeholder="{{ __('app.enter_code') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('app.price') }}<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="price" value="0" onkeyup="addCommas(this)" required placeholder="{{ __('app.enter_price') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('app.duration') }}<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="duration" required placeholder="{{ __('app.enter_duration') }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('app.introduce') }}</label>
                            <textarea class="form-control ckeditor-render" name="introduce"></textarea>
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
                            <label class="form-label">{{ __('app.description') }}</label>
                            <textarea class="form-control ckeditor-render" name="description"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="card card-profile">
                            <div class="card-body p-2">
                                <div class="form-group">
                                    <div class="input-group">
                                        <img src="{{ asset(env('APP_DEFAULT_IMAGE')) }}" alt="Image" class="w-100 aspect-ratio-11">
                                        <input type="text" name="image" class="form-control ps-3" value="{{ env('APP_DEFAULT_IMAGE') }}" placeholder="{{ __('app.select_file') }}" readonly>
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
                            <label class="form-label">{{ __('app.category') }}<span class="text-danger">*</span></label>
                            <select class="form-select select2" name="category_id" onchange="getTopicByCategory(this)" required data-placeholder="{{ __('app.select_category') }}">
                                <option value=""></option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('app.topic') }}</label>
                            <select class="form-select select2" name="topic_id[]" multiple data-placeholder="{{ __('app.select_topic') }}">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('app.level') }}</label>
                            <select class="form-select select2" name="level_id" data-placeholder="{{ __('app.select_level') }}">
                                <option value=""></option>
                                @foreach($levels as $level)
                                    <option value="{{ $level->id }}">{{ $level->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('app.meta_description') }}</label>
                            <textarea class="form-control" name="meta_description" rows="2" placeholder="{{ __('app.meta_description') }}"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('app.order_number') }}<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="order_number" value="1" required placeholder="{{ __('app.enter_order_number') }}">
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
