@extends(env('APP_VIEW_PATH_ADMIN').'.layout')

@section('content')
    <div class="content-title">
        <div class="pagetitle d-sm-flex align-items-center justify-content-between pb-3">
            <h1>{{ $product->name }} <span class="text-danger">{{ $product->code }}</span></h1>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('app.admin') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">{{ __('app.product') }}</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('admin.course.detail', ['course' => $product->id]) }}">{{ __('app.detail') }}</a></li>
                </ol>
            </nav>
        </div>
        <hr class="dropdown-divider mb-3">
    </div>

    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-0">
                        <ul class="nav nav-tabs nav-tabs-bordered nav-product" role="tablist">
                            <li class="nav-item nav-item-tab-show" role="presentation" onclick="commonShowTab('{{ route('admin.product.show', ['product' => $product->id]) }}', this)">
                                <a href="javascript:void(0)" class="nav-link p-3 active" data-bs-toggle="tab" data-bs-target="#tab-show" aria-selected="true" role="tab">
                                    <h5 class="mb-0">{{ __('app.show') }}</h5>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation" onclick="commonShowTab('{{ route('admin.product.edit', ['product' => $product->id]) }}', this)">
                                <a href="javascript:void(0)" class="nav-link p-3" data-bs-toggle="tab" data-bs-target="#tab-edit" aria-selected="false" role="tab" tabindex="-1">
                                    <h5 class="mb-0">{{ __('app.edit') }}</h5>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation" onclick="commonShowTab('{{ route('admin.item_media.filter_card', ['item_type' => get_class($product), 'item_id' => $product->id]) }}', this)">
                                <a href="javascript:void(0)" class="nav-link p-3" data-bs-toggle="tab" data-bs-target="#tab-media" aria-selected="false" role="tab" tabindex="-1">
                                    <h5 class="mb-0">{{ __('app.media') }}</h5>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade p-3 active show" id="tab-show" role="tabpanel"></div>
                            <div class="tab-pane fade p-3" id="tab-edit" role="tabpanel"></div>
                            <div class="tab-pane fade p-3" id="tab-media" role="tabpanel"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js-content')
    <script>
        $(document).ready(function() {
            $('ul.nav-product a[data-bs-target="#tab-show"]').trigger('click');
        });
    </script>
@endsection
