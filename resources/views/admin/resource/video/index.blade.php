@extends(env('APP_VIEW_PATH_ADMIN').'.layout')

@section('css-content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" rel="stylesheet"/>

    <style>
        .dropzone {
            border-color: var(--color-boder);
        }
        .dropzone .dz-remove {
            color: red;
        }
        .select2-search__field {
            margin-bottom: 0.5rem;
        }
        .btn.btn-sm {
            padding: 7px;
        }
    </style>
@endsection

@section('content')
    <div class="content-title">
        <div class="pagetitle d-sm-flex align-items-center justify-content-between pb-3">
            <h1>{{ __('app.video_manage') }}</h1>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('app.admin') }}</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('admin.video.index') }}">{{ __('app.video_manage') }}</a></li>
                </ol>
            </nav>
        </div>
        <hr class="dropdown-divider mb-3">
    </div>

    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card filter-card">
                    <div class="card-header">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h5 class="card-title mb-0">{{ __('app.list') }}</h5>
                            <div>
                                <div class="btn-group float-end">
                                    <a href="javascript:void(0)" class="btn btn-primary me-2" onclick="commonShowModal('{{ route('admin.video.create') }}', '#common-modal-lg')">{{ __('app.create') }}</a>
                                    <button type="button" class="btn btn-primary me-2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('app.upload') }}</button>
                                    <div class="dropdown-menu">
                                        @foreach($types as $type)
                                            <a class="dropdown-item" href="javascript:void(0)" onclick="videoCreate({{ $type->id }}, '{{ $type->code }}')">
                                                {{ __('app.'.$type->code) }}
                                            </a>
                                        @endforeach
                                    </div>
                                    <button type="button" class="btn btn-primary me-2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('app.advanced') }}</button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0)" data-localStorage-name="adminVideos" onclick="showHideShowColumn(this)">{{ __('app.hide_show_column') }}</a>
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="commonExport('{{ route('admin.video.export') }}', this)">{{ __('app.export_excel') }}</a>
                                    </div>
                                    <button type="button" class="btn btn-primary view-type-button me-2" onclick="renderViewType(this)"></button>
                                    <button type="button" class="btn btn-primary is-search-button" onclick="changeIsSearch(this)"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.video.filter') }}" id="filter-form" class="filter-form d-none mb-0" onsubmit="commonFilter(); return false">
                            <input type="hidden" name="orderByName">
                            <input type="hidden" name="orderByType">
                            <input type="hidden" name="viewType">
                            <div class="row">
                                <div class="col-xxl-3 col-sm-12">
                                    <div class="form-group mb-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search_key" autocomplete="off" placeholder="{{ __('app.search') }}...">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-sm-12">
                                    <div class="form-group mb-3">
                                        <select class="form-select select2" name="category_id[]" data-placeholder="{{ __('app.select_category') }}" multiple>
                                            <option value=""></option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-sm-12">
                                    <div class="form-group mb-3">
                                        <select class="form-select select2" name="type_id[]" data-placeholder="{{ __('app.select_type') }}" multiple>
                                            <option value=""></option>
                                            @foreach($types as $type)
                                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {!! renderSelectPaginateAndSubmit() !!}
                            </div>
                        </form>

                        <div id="filter-table" class="filter-table"></div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<div class="modal fade" id="selectManyFileModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-primary">{{ __('app.create') }}</h4>
                <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <h5 class="text-primary mb-4">{{ __('app.select_file') }}</h5>
                    <p class="message mb-2"></p>
                    <form method="POST" action="" id="videoDropzone" class="dropzone mb-3" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="type_id">
                        <input type="hidden" name="type">
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('app.no') }}</button>
                    <button type="button" class="btn btn-primary" id="selectManyFileButton">{{ __('app.upload') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>

@section('js-content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>

    <script>
        $(document).ready(function() {
            commonFilter();
        });

        function videoCreate(type_id, type, modal = '#selectManyFileModal') {
            $(modal).find('form input[name="type_id"]').val(type_id);
            $(modal).find('form input[name="type"]').val(type);
            $(modal).modal('show');
        }

        window.appLocale = "{{ app()->getLocale() }}";
        window.dropzoneLang = @json(__('dropzone'));
        window.addEventListener("dragover", e => e.preventDefault(), false);
        window.addEventListener("drop", e => e.preventDefault(), false);
        Dropzone.autoDiscover = false;

        videoDropzoneRender();

        function videoDropzoneRender() {
            const videoDropzone = new Dropzone("#videoDropzone", {
                url: "{{ route('admin.video.store_many') }}",
                autoProcessQueue: false,
                uploadMultiple: true,
                parallelUploads: 20,
                maxFilesize: 5120,
                acceptedFiles: "video/*",
                paramName: "video",
                addRemoveLinks: true,
                ...window.dropzoneLang,
                init: function () {
                    const dz = this;
                    document.getElementById("selectManyFileButton").addEventListener("click", function () {
                        if (dz.getQueuedFiles().length > 0) {
                            dz.processQueue();
                        } else {
                            showNotification('error', window.dropzoneLang.msg_no_files);
                        }
                    });
                    dz.on("successmultiple", function (files, response) {
                        if (response.type === 'success') {
                            localStorage.setItem("showNotification", response.message);
                            window.location.reload();
                        } else {
                            showNotification(response.type, response.message);
                        }
                    });
                    dz.on("error", function (file, message, xhr) {
                        dz.removeFile(file);
                    });
                    dz.on("errormultiple", function (files, response, xhr) {
                        if (typeof response === 'string') {
                            showNotification('error', response);
                        } else {
                            showNotification('error', response.message);
                        }
                    });
                }
            });
        }
    </script>
@endsection
