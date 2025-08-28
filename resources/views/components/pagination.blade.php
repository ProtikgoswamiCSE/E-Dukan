<div class="mt-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 bg-white p-3 rounded-3 shadow-sm border">
        <div class="text-muted small">
            @if ($paginator->total() > 0)
                Showing <span class="fw-semibold">{{ $paginator->firstItem() }}</span>
                to <span class="fw-semibold">{{ $paginator->lastItem() }}</span>
                of <span class="fw-semibold">{{ $paginator->total() }}</span> results
            @else
                Showing 0 results
            @endif
        </div>

        <nav aria-label="Pagination">
            <ul class="pagination mb-0">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true" aria-label="Previous">
                        <span class="page-link rounded-pill px-3">« Previous</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link rounded-pill px-3" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Previous">« Previous</a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled" aria-disabled="true"><span class="page-link rounded-pill">{{ $element }}</span></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active" aria-current="page"><span class="page-link rounded-pill">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link rounded-pill" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link rounded-pill px-3" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next">Next »</a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true" aria-label="Next">
                        <span class="page-link rounded-pill px-3">Next »</span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</div>


