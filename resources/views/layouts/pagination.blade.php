<!-- Pagination -->
<div class="flex justify-between space-x-2">
    <div class="dropdown dropdown-right dropdown-end">
        <div tabindex="0" role="button" class="btn">{{ __('Show :count items', ['count' => request()->input('per_page', 10)]) }}</div>
        <ul tabindex="0" class="dropdown-content menu p-1 ml-2 bg-base-100 border border-base-200 rounded-box min-w-40">
            @if (request()->input('per_page', 10) != 10)
            <li><a href="{{ request()->fullUrlWithQuery(['per_page' => 10]) }}">10 items</a></li>
            @endif
            @if (request()->input('per_page', 10) != 25)
            <li><a href="{{ request()->fullUrlWithQuery(['per_page' => 25]) }}">25 items</a></li>
            @endif
            @if (request()->input('per_page', 10) != 50)
            <li><a href="{{ request()->fullUrlWithQuery(['per_page' => 50]) }}">50 items</a></li>
            @endif
            @if (request()->input('per_page', 10) != 100)
            <li><a href="{{ request()->fullUrlWithQuery(['per_page' => 100]) }}">100 items</a></li>
            @endif
        </ul>
    </div>
    <div class="join">
        @if ($todos->onFirstPage())
        <button class="join-item btn btn-disabled"><i data-feather="chevrons-left" class="w-4"></i></button>
        @else
        <a href="{{ $todos->previousPageUrl() }}" class="join-item btn"><i data-feather="chevrons-left" class="w-4"></i></a>
        @endif

        @php
        $total_pages = $todos->lastPage();
        $current_page = $todos->currentPage();
        @endphp

        @if ($total_pages <= 7) @foreach (range(1, $total_pages) as $page) <a href="{{ $todos->url($page) }}" class="join-item btn {{ $page == $current_page ? 'btn-active' : '' }}">
            {{ $page }}
            </a>
            @endforeach
            @else
            <a href="{{ $todos->url(1) }}" class="join-item btn {{ $current_page == 1 ? 'btn-active' : '' }}">1</a>

            @if ($current_page > 3)
            <button class="join-item btn btn-disabled"><i data-feather="more-horizontal"></i></button>
            @endif

            @foreach (range(max(2, $current_page - 1), min($total_pages - 1, $current_page + 1)) as $page)
            <a href="{{ $todos->url($page) }}" class="join-item btn {{ $page == $current_page ? 'btn-active' : '' }}">
                {{ $page }}
            </a>
            @endforeach

            @if ($current_page < $total_pages - 2) <button class="join-item btn btn-disabled"><i data-feather="more-horizontal"></i></button>
                @endif

                <a href="{{ $todos->url($total_pages) }}" class="join-item btn {{ $current_page == $total_pages ? 'btn-active' : '' }}">
                    {{ $total_pages }}
                </a>
                @endif

                @if ($todos->hasMorePages())
                <a href="{{ $todos->nextPageUrl() }}" class="join-item btn"><i data-feather="chevrons-right" class="w-4"></i></a>
                @else
                <button class="join-item btn btn-disabled"><i data-feather="chevrons-right" class="w-4"></i></button>
                @endif
    </div>
</div>