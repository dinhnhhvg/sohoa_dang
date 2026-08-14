<div class="row">
    <div class="col-xxl-8 col-sm-12">
        <div class="card h-100">
            <div class="card-body">
                <div class="f-carousel" id="common-carousel" class="common-carousel">
                    <div class="f-carousel__slide" data-fancybox="gallery" data-src="{{ asset($product->image) }}" data-thumb-src="{{ asset($product->image) }}">
                        <img class="w-100 aspect-ratio-16-9" data-lazy-src="{{ asset($product->image) }}" alt="image">
                    </div>
                    @foreach($product->itemMedias as $itemMedia)
                        @if($itemMedia->type === 'video')
                            <div class="f-carousel__slide" data-fancybox="gallery" data-src="{{ asset($itemMedia->file_path) }}" data-thumb-src="{{ asset($product->image) }}">
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
            </div>
        </div>
    </div>
</div>

<script>
    Carousel(
        document.getElementById("common-carousel"),
        {},
        {Lazyload, Arrows, Thumbs,}
    ).init();
    Fancybox.bind("[data-fancybox]", {});
</script>
