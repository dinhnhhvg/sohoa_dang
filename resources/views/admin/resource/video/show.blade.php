<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.show') }}</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    @if($video->type->code === env('VDOCIPHER_CODE'))
        <div id="playVdoCipherElement"></div>
        <script>
            playVdoCipher('{{ $video->video['otp'] ?? '' }}', '{{ $video->video['playbackInfo'] ?? '' }}', '#playVdoCipherElement')
        </script>
    @endif

    @if($video->type->code === env('BUNNY_CODE'))
        <iframe class="w-100 aspect-ratio-16-9" src="{{ env('BUNNY_EMBED_URL') }}/{{ env('BUNNY_LIBRARY_ID') }}/{{ $video->videoId }}"
                allow="autoplay; fullscreen; picture-in-picture" allowfullscreen loading="lazy">
        </iframe>
    @endif
</div>
