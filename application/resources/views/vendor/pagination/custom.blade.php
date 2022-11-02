<div class="col-md-6 col-sm-6">
    <span class="page-count">Showing   <span class="font-medium">{{ $paginator->firstItem() }} to <span class="font-medium">{{ $paginator->lastItem() }}</span></span> out of    <span class="font-medium">{{ $paginator->lastItem() }}</span></span>
</div>

<div class="col-md-6 col-sm-6 text-sm-right">
@if ($paginator->hasPages())
    <ul class="pagination-lsit">

        @if ($paginator->onFirstPage())
            {{-- <li class="disabled"><span> <i class="fas fa-angle-left"></i></span></li> --}}
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev"> <i class="fas fa-angle-left"></i></a></li>
        @endif

        @foreach ($elements as $element)

            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif



            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><a href="#">{{ $page }}</a></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach



        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fas fa-angle-right"></i></a></li>
        @else
            {{-- <li class="disabled"><span><i class="fas fa-angle-right"></i></span></li> --}}
        @endif
    </ul>
@endif
</div>
