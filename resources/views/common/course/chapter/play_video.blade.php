@if($video->video?->type?->code === env('VDOCIPHER_CODE'))
    <div id="playVdoCipherElement"></div>
    <script>
        playVdoCipher('{{ $video->video->play['otp'] ?? '' }}', '{{ $video->video->play['playbackInfo'] ?? '' }}', '#playVdoCipherElement')
    </script>
@elseif($video->video?->type?->code === env('BUNNY_CODE'))
    <iframe class="w-100 aspect-ratio-16-9" src="{{ env('BUNNY_EMBED_URL') }}/{{ env('BUNNY_LIBRARY_ID') }}/{{ $video->video->videoId ?? '' }}"
            allow="autoplay; fullscreen; picture-in-picture" allowfullscreen loading="lazy">
    </iframe>
@else
    <iframe class="w-100 aspect-ratio-16-9" src="{{ $video->src }}"
            allow="autoplay; fullscreen; picture-in-picture" allowfullscreen loading="lazy">
    </iframe>
@endif
