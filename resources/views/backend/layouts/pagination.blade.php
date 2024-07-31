@if ($paginator->hasPages())
    <div class="demo-inline-spacing">
        <!-- Basic Pagination -->
        <nav aria-label="Page navigation">
            <ul class="pagination">
                {{--    <ul class="pager"> --}}{{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    {{--            <li class="disabled"><span>← Previous</span></li>--}}

                    <li class="page-item first">
                        <a class="page-link" href="javascript:void(0);"
                        ><i class="tf-icon bx bx-chevron-left"></i
                            ></a>
                    </li>
                @else
{{--                    <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">← Previous</a></li>--}}

                    <li class="page-item first">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}"
                        ><i class="tf-icon bx bx-chevron-left"></i
                            ></a>
                    </li>
                @endif {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
{{--                        <li class="disabled"><span>{{ $element }}</span></li>--}}
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0);">{{ $element }}</a>
                        </li>

                    @endif {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
{{--                                <li class="active my-active"><span>{{ $page }}</span></li>--}}
                                <li class="page-item active">
                                    <a class="page-link" href="javascript:void(0);">{{ $page }}</a>
                                </li>
                            @else
{{--                                <li><a href="{{ $url }}">{{ $page }}</a></li>--}}
                                <li class="page-item">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
{{--                    <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">Next →</a></li>--}}

                    <li class="page-item first">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}"
                        ><i class="tf-icon bx bx-chevron-right"></i
                            ></a>
                    </li>
                @else
                    <li class="page-item first">
                        <a class="page-link" href="javascript:void(0);"
                        ><i class="tf-icon bx bx-chevron-right"></i
                            ></a>
                    </li>
                @endif
            </ul>
        </nav>
        <!--/ Basic Pagination -->
    </div>
@endif
