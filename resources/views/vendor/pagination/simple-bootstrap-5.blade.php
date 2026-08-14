@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation">
        <ul class="pagination">
            {{-- First Page Link
            @if ($paginator->currentPage() > 1)
                <li class="page-item">
                    <a class="page-link" href="{{ request()->fullUrlWithQuery(['page' => 1]) }}">@lang('pagination.first')</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">@lang('pagination.first')</span>
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

            {{-- Last Page Link
            @if ($paginator->currentPage() < $paginator->lastPage())
                <li class="page-item">
                    <a class="page-link" href="{{ request()->fullUrlWithQuery(['page' => $paginator->lastPage()]) }}">@lang('pagination.last')</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">@lang('pagination.last')</span>
                </li>
            @endif --}}
        </ul>
    </nav>
@endif
