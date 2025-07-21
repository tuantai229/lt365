@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-center">
        <div class="flex items-center justify-center gap-2">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <button class="px-3 py-2 border border-gray-200 rounded-button cursor-not-allowed" disabled>
                    <i class="ri-arrow-left-line"></i>
                </button>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-2 border border-gray-200 rounded-button hover:bg-gray-100 transition-colors duration-200">
                    <i class="ri-arrow-left-line"></i>
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="px-3 py-2 text-gray-500">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <button class="px-3 py-2 bg-primary text-white rounded-button">{{ $page }}</button>
                        @else
                            <a href="{{ $url }}" class="px-3 py-2 border border-gray-200 rounded-button hover:bg-gray-100 transition-colors duration-200">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-2 border border-gray-200 rounded-button hover:bg-gray-100 transition-colors duration-200">
                    <i class="ri-arrow-right-line"></i>
                </a>
            @else
                <button class="px-3 py-2 border border-gray-200 rounded-button cursor-not-allowed" disabled>
                    <i class="ri-arrow-right-line"></i>
                </button>
            @endif
        </div>
    </nav>
@endif
