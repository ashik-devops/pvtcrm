@if ($paginator->hasPages())
    <nav class="text-center pagination-wrapper">
        <p class="pagination-info">Showing {{(($paginator->currentPage()-1)*$paginator->perPage()) + 1}} - {{($paginator->currentPage()*$paginator->perPage()) > $paginator->total()?$paginator->total() : $paginator->currentPage()*$paginator->perPage()}} of {{$paginator->total()}}</p>

    <ul class="pagination pagination-sm">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><a href="#" rel="prev" aria-label="Previous"><span>&laquo;</span></a></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><a href="#"><span>{{ $page }}</span></a></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
        @else
            <li class="disabled"><a href="#" rel="prev" aria-label="Previous"><span>&raquo;</span></a></li>
        @endif
    </ul>
    </nav>
@endif
