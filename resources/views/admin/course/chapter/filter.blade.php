<div class="accordion" id="accordionChapter">
    @foreach($chapters as $i => $chapter)
        <div class="accordion-item mb-2">
            <div class="accordion-header" id="headingChapter{{ $chapter->id }}">
                <div class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapseChapter{{ $chapter->id }}" aria-expanded="false" aria-controls="collapseChapter{{ $chapter->id }}">
                    <div class="w-100 d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="title text-primary mb-0">({{ $chapter->order_number }}) {{ $chapter->name }}</h6>
                        </div>
                        <div>
                            @foreach($chapter->types as $type)
                                <span class="btn btn-sm btn-secondary mb-1 fs-12">{{ __('app.'.$type->code) }}</span>
                            @endforeach
                        </div>
                        <div>
                            <a href="javascript:void(0)" class="btn btn-sm btn-success mb-1" title="{{ __('app.edit') }}"
                               onclick="commonShowModal('{{ route('admin.chapter.edit', ['chapter' => $chapter->id]) }}', '#common-modal-lg')">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                               onclick="commonDelete('{{ route('admin.chapter.destroy', ['chapter' => $chapter->id]) }}')">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="collapseChapter{{ $chapter->id }}" class="accordion-collapse collapse" aria-labelledby="headingChapter{{ $chapter->id }}" data-bs-parent="#accordionChapter">
                <div class="accordion-body">
                    <div class="text-end mb-3">
                        <a href="javascript:void(0)" class="btn btn-sm btn-primary"
                           onclick="commonShowModal('{{ route('admin.chapter_video.create', ['chapter_id' => $chapter->id]) }}', '#common-modal-xl')">
                            {{ __('app.lesson_create') }}
                        </a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-primary"
                           onclick="commonShowModal('{{ route('admin.chapter_document.create', ['chapter_id' => $chapter->id]) }}', '#common-modal-xl')">
                            {{ __('app.document_create') }}
                        </a>
                    </div>

                    @foreach($chapter->items as $item)
                        @if ($item->getTable() === 'chapter_videos')
                            <div class="card mb-2 btn-secondary">
                                <div class="card-body px-3 py-2">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h6 class="title text-primary mb-0">
                                            <i class="{{ $item->type->icon }}"></i> {{ $item->name }}
                                        </h6>
                                        <div>
                                            {{ gmdate("H:i:s", $item->duration) }}
                                            @if($item->is_free)
                                                <button class="btn btn-sm btn-danger fs-12 py-0 px-1">Free</button>
                                            @endif
                                        </div>
                                        <div>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-success mb-1" title="{{ __('app.edit') }}"
                                               onclick="commonShowModal('{{ route('admin.chapter_video.edit', ['chapter_video' => $item->id]) }}', '#common-modal-xl')">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                                               onclick="commonDelete('{{ route('admin.chapter_video.destroy', ['chapter_video' => $item->id]) }}')">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($item->getTable() === 'chapter_documents')
                            <div class="card mb-2 btn-secondary">
                                <div class="card-body px-3 py-2">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h6 class="title text-primary mb-0">
                                            <i class="{{ $item->type->icon }}"></i> {{ $item->name }}
                                        </h6>
                                        <div>
                                            @if($item->is_free)
                                                <button class="btn btn-sm btn-danger fs-12 py-0 px-1">Free</button>
                                            @endif
                                        </div>
                                        <div class="float-end">
                                            <a href="javascript:void(0)" class="btn btn-sm btn-success mb-1" title="{{ __('app.edit') }}"
                                               onclick="commonShowModal('{{ route('admin.chapter_document.edit', ['chapter_document' => $item->id]) }}', '#common-modal-xl')">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                                               onclick="commonDelete('{{ route('admin.chapter_document.destroy', ['chapter_document' => $item->id]) }}')">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
</div>

{!! renderPagination($chapters) !!}

{!! renderSearchEmpty($chapters) !!}
