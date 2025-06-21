@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-center space-x-2 text-sm">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-1 text-gray-400 border border-gray-300 rounded bg-gray-100 cursor-not-allowed">&lsaquo;</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="px-3 py-1 border border-gray-300 rounded hover:bg-gray-100">&lsaquo;</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="px-3 py-1 text-gray-500">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-3 py-1 border border-primary-600 text-primary-600 font-semibold rounded bg-primary-100">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="px-3 py-1 border border-gray-300 rounded hover:bg-gray-100">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="px-3 py-1 border border-gray-300 rounded hover:bg-gray-100">&rsaquo;</a>
        @else
            <span class="px-3 py-1 text-gray-400 border border-gray-300 rounded bg-gray-100 cursor-not-allowed">&rsaquo;</span>
        @endif
    </nav>
@endif
