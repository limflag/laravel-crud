@if ($paginator->hasPages())
<nav class="flex items-center justify-center">
    <ul class="flex flex-row items-center gap-3">
        @if ($paginator->onFirstPage())
        <li class="disabled">
            <span>&laquo;</span>
        </li>
        @else
        <li class="disabled">
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a>
        </li>
        @endif
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class=""><span class="">{{ $element }}</span></li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li><span class="p-1 border-black border-2 neo-shadow">{{ $page }}</span></li>
                    @else
                        <li><a class="p1" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <li class=""><a class="" href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>
        @else
            <li class=""><span class="">&raquo;</span></li>
        @endif
    </ul>
<nav>
@endif
