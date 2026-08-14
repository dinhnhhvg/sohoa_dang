<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.show') }}</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('admin.order.store') }}" onsubmit="commonSubmit(this); return false" enctype="multipart/form-data">
        @csrf
        <div>
            <h5 class="mb-1">{{ $product->name }}</h5>
            @foreach($product->values as $value)
                <p class="mb-1">
                    {{ $value->attribute->name }}:
                    @if($)
                </p>
            @endforeach
        </div>
    </form>
</div>
