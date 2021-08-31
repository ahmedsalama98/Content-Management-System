
</ul>
@if ($paginator->hasPages())
    <nav>
        <ul class="wn__pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class=" disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span  aria-hidden="true">&lsaquo;</span>
                </li>

            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class=" disabled" aria-disabled="true"><span >{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active disabled" ><a  href="#">{{ $page }}</a></li>
                        @else
                            <li class=""><a  href="{{ $url }}">{{ $page }}</a></li>
                        @endif


                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="">
                    <a  href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"><i class="zmdi zmdi-chevron-right"></i></a>
                </li>
            @else
                <li class=" disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span  aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
