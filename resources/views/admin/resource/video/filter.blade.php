@if($viewType === 'table')
    <div class="table-responsive">
        <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100" data-sticky-column="2">
            <thead>
            <tr>
                <th class="w-40px">#</th>
                <th class="min-w-220px">{!! renderThSort(__('app.name'), 'videos.name', $orderByName, $orderByType) !!}</th>
                <th>{{ __('app.description') }}</th>
                <th>{{ __('app.category') }}</th>
                <th>{{ __('app.type') }}</th>
                <th>{{ __('app.videoId') }}</th>
                <th>{!! renderThSort(__('app.duration'), 'videos.duration', $orderByName, $orderByType) !!}</th>
                <th>{{ __('app.status') }}</th>
                <th>{!! renderThSort(__('app.created_at'), 'videos.created_at', $orderByName, $orderByType) !!}</th>
                <th class="min-w-100px">{{ __('app.action') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($videos as $i => $video)
                <tr class="{{ $video->video ? '' : 'bg-inactive' }}">
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td>
                        <a href="{{ route('admin.video.show', ['video' => $video->id]) }}"><strong>{{ $video->name }}</strong></a>
                    </td>
                    <td class="min-w-220px">{{ $video->description }}</td>
                    <td class="text-center text-nowrap">{{ $video->category?->name }}</td>
                    <td class="text-center text-nowrap">{{ __('app.'.$video->type?->name) }}</td>
                    <td class="text-center text-nowrap">{{ $video->videoId }}</td>
                    <td class="text-center text-nowrap">{{ isset($video->video['length']) ? gmdate("H:i:s", $video->video['length']) : '' }}</td>
                    <td class="text-center text-nowrap">{{ $video->video['status'] ?? '' }}</td>
                    <td class="text-center text-nowrap">{{ $video->created_at->format('d-m-Y H:i:s') }}</td>
                    <td class="text-center">
                        <a href="javascript:void(0)" class="btn btn-sm btn-success mb-1" title="{{ __('app.edit') }}"
                           onclick="commonShowModal('{{ route('admin.video.edit', ['video' => $video->id]) }}', '#common-modal-lg')">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-primary mb-1" title="{{ __('app.show') }}"
                           onclick="commonShowModal('{{ route('admin.video.show', ['video' => $video->id]) }}', '#common-modal-fullscreen')">
                            <i class="fa-solid fa-circle-play"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                           onclick="commonDelete('{{ route('admin.video.destroy', ['video' => $video->id]) }}')">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endif

@if($viewType === 'card')
    <div class="row">
        @foreach($videos as $i => $video)
            <div class="col-xxl-3 col-xl-4 col-md-6 mb-3">
                <div class="card card-profile">
                    <div class="card-body h-100 p-2 {{ $video->video ? '' : 'bg-inactive' }}">
                        <div class="position-relative">
                            <img src="{{ asset($video->video['poster'] ?? env('APP_DEFAULT_IMAGE')) }}" class="w-100 mb-1 aspect-ratio-16-9">
                            <a href="javascript:void(0)" class="position-absolute text-primary transform-50"
                               onclick="commonShowModal('{{ route('admin.video.show', ['video' => $video->id]) }}', '#common-modal-fullscreen')">
                                <i class="fa-solid fa-circle-play"></i>
                            </a>
                        </div>
                        <div class="mb-1">
                            <p class="mb-0 text-primary">{{ $video->name }}</p>
                            <p class="mb-0">{{ __('app.category') }}: {{ $video->category?->name }}</p>
                            <p class="mb-0">{{ __('app.type') }}: {{ $video->type?->name }}</p>
                            <p class="mb-0">{{ __('app.status') }}: {{ $video->video['status'] ?? '' }}</p>
                            <p class="mb-0">{{ __('app.duration') }}: {{ isset($video->video['length']) ? gmdate("H:i:s", $video->video['length']) : '' }}</p>
                        </div>
                        <p class="mb-0 float-end">
                            <a href="javascript:void(0)" class="btn btn-sm btn-success mb-1" title="{{ __('app.edit') }}"
                               onclick="commonShowModal('{{ route('admin.video.edit', ['video' => $video->id]) }}', '#common-modal-lg')">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-primary mb-1" title="{{ __('app.show') }}"
                               onclick="commonShowModal('{{ route('admin.video.show', ['video' => $video->id]) }}', '#common-modal-fullscreen')">
                                <i class="fa-solid fa-circle-play"></i>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                               onclick="commonDelete('{{ route('admin.video.destroy', ['video' => $video->id]) }}')">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

{!! renderPagination($videos) !!}

{!! renderSearchEmpty($videos) !!}
