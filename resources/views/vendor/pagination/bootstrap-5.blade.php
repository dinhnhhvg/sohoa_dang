@if ($paginator->hasPages())
    <nav class="d-flex justify-items-center justify-content-between mt-3">
        {{-- Mobile view --}}
        <div class="d-flex justify-content-between flex-fill d-sm-none">
            <ul class="pagination">
                {{-- First Page Link --}}
                @if ($paginator->currentPage() > 1)
                    <li class="page-item">
                        <a class="page-link" data-page="1" href="{{ request()->fullUrlWithQuery(['page' => 1]) }}">@lang('pagination.first')</a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">@lang('pagination.first')</span>
                    </li>
                @endif

                {{-- Page Numbers --}}
                @php
                    $current = $paginator->currentPage();
                    $last = $paginator->lastPage();
                    $start = max(1, $current - 2);
                    $end = min($last, $current + 2);
                @endphp

                @if ($start > 1)
                    <li class="page-item disabled"><span class="page-link">…</span></li>
                @endif

                @for ($i = $start; $i <= $end; $i++)
                    @if ($i == $current)
                        <li class="page-item active" aria-current="page"><span class="page-link">{{ $i }}</span></li>
                    @else
                        <li class="page-item">
                            <a class="page-link" data-page="{{ $i }}" href="{{ request()->fullUrlWithQuery(['page' => $i]) }}">{{ $i }}</a>
                        </li>
                    @endif
                @endfor

                @if ($end < $last)
                    <li class="page-item disabled"><span class="page-link">…</span></li>
                @endif

                {{-- Last Page Link --}}
                @if ($current < $last)
                    <li class="page-item">
                        <a class="page-link" data-page="{{ $last }}" href="{{ request()->fullUrlWithQuery(['page' => $last]) }}">@lang('pagination.last')</a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">@lang('pagination.last')</span>
                    </li>
                @endif
            </ul>
        </div>

        {{-- Desktop view --}}
        <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">
            <div>
                <p class="small text-muted">
                    {!! __('pagination.showing') !!}
                    <span class="fw-semibold">{{ $paginator->firstItem() }}</span>
                    {!! __('pagination.to') !!}
                    <span class="fw-semibold">{{ $paginator->lastItem() }}</span>
                    {!! __('pagination.of') !!}
                    <span class="fw-semibold">{{ $paginator->total() }}</span>
                    {!! __('pagination.results') !!}
                </p>
            </div>
            <div>
                <ul class="pagination">
                    {{-- First Page
                    @if ($paginator->currentPage() > 1)
                        <li class="page-item">
                            <a class="page-link" href="{{ request()->fullUrlWithQuery(['page' => 1]) }}" aria-label="@lang('pagination.first')">«</a>
                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link" aria-hidden="true">«</span>
                        </li>
                    @endif --}}

                    {{-- Page Numbers --}}
                    @php
                        $current = $paginator->currentPage();
                        $last = $paginator->lastPage();
                        $start = max(1, $current - 2);
                        $end = min($last, $current + 2);
                    @endphp

                    @if ($start > 1)
                        <li class="page-item">
                            <a class="page-link" data-page="1" href="{{ request()->fullUrlWithQuery(['page' => 1]) }}">1</a>
                        </li>
                        @if ($start > 2)
                            <li class="page-item disabled"><span class="page-link">…</span></li>
                        @endif
                    @endif

                    @for ($i = $start; $i <= $end; $i++)
                        @if ($i == $current)
                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $i }}</span></li>
                        @else
                            <li class="page-item">
                                <a class="page-link" data-page="{{ $i }}" href="{{ request()->fullUrlWithQuery(['page' => $i]) }}">{{ $i }}</a>
                            </li>
                        @endif
                    @endfor

                    @if ($end < $last)
                        @if ($end < $last - 1)
                            <li class="page-item disabled"><span class="page-link">…</span></li>
                        @endif
                        <li class="page-item">
                            <a class="page-link" data-page="{{ $last }}" href="{{ request()->fullUrlWithQuery(['page' => $last]) }}">{{ $last }}</a>
                        </li>
                    @endif

                    {{-- Last Page
                    @if ($paginator->currentPage() < $paginator->lastPage())
                        <li class="page-item">
                            <a class="page-link" href="{{ request()->fullUrlWithQuery(['page' => $paginator->lastPage()]) }}" aria-label="@lang('pagination.last')">»</a>
                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link" aria-hidden="true">»</span>
                        </li>
                    @endif --}}
                </ul>
            </div>
        </div>
    </nav>
@endif
