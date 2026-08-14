<div class="row">
    <div class="col-xxl-8 col-sm-12">
        <div class="card h-100">
            <div class="card-body">
                @if($video)
                    @include(env('APP_VIEW_PATH_COMMON').'.course.chapter.play_video')
                @elseif($document)
                    @include(env('APP_VIEW_PATH_COMMON').'.course.chapter.play_document')
                @else
                    <div class="f-carousel" id="common-carousel" class="common-carousel">
                        <div class="f-carousel__slide" data-fancybox="gallery" data-src="{{ asset($course->image) }}" data-thumb-src="{{ asset($course->image) }}">
                            <img class="w-100 aspect-ratio-16-9" data-lazy-src="{{ asset($course->image) }}" alt="image">
                        </div>
                        @foreach($course->itemMedias as $itemMedia)
                            @if($itemMedia->type === 'video')
                                <div class="f-carousel__slide" data-fancybox="gallery" data-src="{{ asset($itemMedia->file_path) }}" data-thumb-src="{{ asset($course->image) }}">
                                    <div class="position-relative w-100 aspect-ratio-16-9">
                                        <video class="w-100 h-100" playsinline preload="metadata" controls>
                                            <source src="{{ asset($itemMedia->file_path) }}" type="video/mp4">
                                        </video>
                                        <a href="javascript:void(0)" class="position-absolute top-50 start-50 translate-middle text-primary">
                                            <h1><i class="fa-solid fa-circle-play"></i></h1>
                                        </a>
                                    </div>
                                </div>
                            @else
                                <div class="f-carousel__slide" data-fancybox="gallery" data-src="{{ asset($itemMedia->file_path) }}" data-thumb-src="{{ asset($itemMedia->file_path) }}">
                                    <img class="w-100 aspect-ratio-16-9" data-lazy-src="{{ asset($itemMedia->file_path) }}" alt="image">
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <script>
                        Carousel(
                            document.getElementById("common-carousel"),
                            {},
                            {Lazyload, Arrows, Thumbs,}
                        ).init();
                        Fancybox.bind("[data-fancybox]", {});
                    </script>
                @endif
                <div>
                    <h5 class="title mt-3 mb-2">{{ $activeTitle }}</h5>
                    <div>
                        <ul class="nav nav-tabs nav-tabs-bordered" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-bs-toggle="tab" href="#course-info" data-bs-target="#course-info" aria-selected="true" role="tab">
                                    <strong>{{ __('app.info') }} {{ __('app.course') }}</strong>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#course-introduce" data-bs-target="#course-introduce" aria-selected="false" role="tab" tabindex="-1">
                                    <strong>{{ __('app.introduce') }} {{ __('app.course') }}</strong>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#course-content" data-bs-target="#course-content" aria-selected="false" role="tab" tabindex="-1">
                                    <strong>{{ __('app.content') }} {{ __('app.course') }}</strong>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#course-description" data-bs-target="#course-description" aria-selected="false" role="tab" tabindex="-1">
                                    <strong>{{ __('app.description') }} {{ __('app.course') }}</strong>
                                </a>
                            </li>
                            @if($chapter)
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#chapter-content" data-bs-target="#chapter-content" aria-selected="false" role="tab" tabindex="-1">
                                        <strong>{{ __('app.content') }} {{ __('app.chapter') }}</strong>
                                    </a>
                                </li>
                            @endif
                            @if($video)
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#video-content" data-bs-target="#video-content" aria-selected="false" role="tab" tabindex="-1">
                                        <strong>{{ __('app.content') }} {{ __('app.video') }}</strong>
                                    </a>
                                </li>
                            @endif
                            @if($document)
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#document-content" data-bs-target="#document-content" aria-selected="false" role="tab" tabindex="-1">
                                        <strong>{{ __('app.content') }} {{ __('app.document') }}</strong>
                                    </a>
                                </li>
                            @endif
                        </ul>

                        <div class="tab-content pt-2">
                            <div class="tab-pane fade pt-3 active show" id="course-info" role="tabpanel">
                                <h6 class="mb-2 title text-primary">{{ __('app.course') }}: {{ $course->name }}</h6>
                                <p class="mb-2"><span class="text-primary">{{ __('app.category') }}</span>: {{ $course->category->name }}</p>
                                <p class="mb-2">
                                    <span class="text-primary">{{ __('app.topic') }}</span>:
                                    @foreach($course->topics as $topic)
                                        <span class="btn btn-sm btn-secondary mb-1 fs-12">{{ $topic->name }}</span>
                                    @endforeach
                                </p>
                                <p class="mb-2"><span class="text-primary">{{ __('app.duration') }}</span>: {{ $course->duration }}</p>
                                <p class="mb-2"><span class="text-primary">{{ __('app.meta_description') }}</span>:<br>{{ $course->meta_description }}</p>
                            </div>
                            <div class="tab-pane fade pt-3" id="course-introduce" role="tabpanel">
                                {!! $course->content !!}
                            </div>
                            <div class="tab-pane fade pt-3" id="course-content" role="tabpanel">
                                {!! $course->content !!}
                            </div>
                            <div class="tab-pane fade pt-3" id="course-description" role="tabpanel">
                                {!! $course->description !!}
                            </div>
                            @if($chapter)
                                <div class="tab-pane fade pt-3" id="chapter-content" role="tabpanel">
                                    {!! $chapter->content !!}
                                </div>
                            @endif
                            @if($video)
                                <div class="tab-pane fade pt-3" id="video-content" role="tabpanel">
                                    {!! $video->content !!}
                                </div>
                            @endif
                            @if($document)
                                <div class="tab-pane fade pt-3" id="document-content" role="tabpanel">
                                    {!! $document->content !!}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xxl-4 col-sm-12">
        <div class="card h-100">
            <div class="card-body">
                <div class="form-group mb-3">
                    <select class="form-select select2" name="type_id" id="show_course_type_id" onchange="showCourse('video_id', 0)"
                            data-placeholder="{{ __('app.select_course_type') }}">
                        <option value=""></option>
                        @foreach($course->courseTypes as $courseType)
                            <option value="{{ $courseType->type->id }}" {{ isset($type_id) && $type_id == $courseType->type->id ? 'selected' : '' }}>
                                {{ __('app.'.$courseType->type->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <ul id="sidebar-chapter" class="sidebar-nav">
                    @foreach($course->chapters as $i => $chapter)
                        <li class="nav-item">
                            <a class="nav-link py-3 collapsed" data-bs-target="#chapter{{ $i }}-nav" data-bs-toggle="collapse" href="#">
                                <h6 class="mb-0 title">{{ $chapter->name }}</h6>
                                <i class="fas fa-chevron-down ms-auto"></i>
                            </a>
                            <ul id="chapter{{ $i }}-nav" class="nav-content collapse" data-bs-parent="#sidebar-chapter">
                                @foreach($chapter->items as $item)
                                    @if($item->getTable() === 'chapter_videos')
                                        <li>
                                            <a href="javascript:void(0)" class="mb-1 {{ $video && $video->id == $item->id ? 'active' : '' }}"
                                               onclick="showCourse('video_id', {{ $item->id }})">
                                                <h6 class="mb-0 title">
                                                    <i class="{{ $item->type->icon }}"></i> {{ $item->name }}
                                                    ({{ gmdate("H:i:s", $item->duration) }})
                                                </h6>
                                            </a>
                                        </li>
                                    @endif
                                    @if($item->getTable() === 'chapter_documents')
                                        @if($item->type->code === 'document_other')
                                            <li>
                                                <a href="{{ asset($item->file_path) }}" download class="mb-1">
                                                    <h6 class="mb-0 title">
                                                        <i class="{{ $item->type->icon }}"></i> {{ $item->name }}
                                                    </h6>
                                                </a>
                                            </li>
                                        @else
                                            <li>
                                                <a href="javascript:void(0)" class="mb-1 {{ $document && $document->id == $item->id ? 'active' : '' }}"
                                                   onclick="showCourse('document_id', {{ $item->id }})">
                                                    <h6 class="mb-0 title">
                                                        <i class="{{ $item->type->icon }}"></i> {{ $item->name }}
                                                    </h6>
                                                </a>
                                            </li>
                                        @endif
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
