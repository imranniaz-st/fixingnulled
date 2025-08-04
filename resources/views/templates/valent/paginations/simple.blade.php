<div class="flex justify-center items-center mt-4 gap-4">
    @if ($paginator->onFirstPage())
        <span class="px-2 py-1 bg-gray-500 border border-blue-200 rounded-md" aria-disabled="true">
            <img src="{{ asset('/assets/templates/valent/images/icon/arrow_left.svg') }}" alt="">
        </span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
            class="px-2 py-1 bg-gradient-to-r from-[#0038A3] via-[#0038A3] to-[#02215B] border border-blue-200 rounded-md paginator-link flex items-center justify-center"
            aria-disabled="true">
            <img src="{{ asset('/assets/templates/valent/images/icon/arrow_left.svg') }}" alt="">
        </a>
    @endif

    <!-- Pagination Links -->
    {{-- @php
        $pageCount = $paginator->lastPage();
        $currentPage = $paginator->currentPage();
        $startIndex = $currentPage <= 2 ? 1 : max($currentPage - 2, 1);
        $endIndex = $currentPage <= 2 ? min($pageCount, 6) : min($currentPage + 2, $pageCount);
    @endphp --}}

    @php
        $pageCount = $paginator->lastPage();
        $currentPage = $paginator->currentPage();

        if ($currentPage <= 2) {
            $startIndex = 1;
            $endIndex = min(3, $pageCount);
        } else {
            $startIndex = $currentPage - 1;
            $endIndex = min($currentPage + 1, $pageCount);
        }
    @endphp

    @for ($i = $startIndex; $i <= $endIndex; $i++)
        @if ($i == $currentPage)
            <div
                class="px-2 py-1 text-white bg-[#0038A3] border border-blue-200 rounded-md paginator-link not-allowed-cursor">
                <span>{{ $i }}</span>
            </div>
        @else
            <a class="px-2 py-1 text-white bg-gradient-to-r from-black to-gray0700 border border-blue-200 rounded-md paginator-link flex items-center justify-center"
                href="{{ $paginator->url($i) }}">{{ $i }}</a>
        @endif
    @endfor

    @if ($currentPage < $pageCount - 1)
        <div class="disabled"><span>...</span></div>
        <a href="{{ $paginator->url($pageCount) }}"
            class="px-3 py-1 text-white bg-gradient-to-r from-black to-gray0700 border border-blue-200 rounded-md paginator-link flex items-center justify-center">
            {{ $pageCount }}
        </a>
    @endif


    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" rel="next"
            class=" paginator-link px-2 py-1  bg-[#0038A3] border border-blue-200 rounded-md paginator-link flex items-center justify-center">
            <img src="{{ asset('/assets/templates/valent/images/icon/arrow_right.svg') }}" alt="">
        </a>
    @else
        <span class="px-2 py-1  bg-gray-500 border border-blue-200 rounded-md">
            <img src="{{ asset('/assets/templates/valent/images/icon/arrow_right.svg') }}" alt="">
        </span>
    @endif

</div>
