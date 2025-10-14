
@php
    $qty = 1;
@endphp
<div class="bx_paginate">
    @if($paginator->onFirstPage())
        <button type="button" class="btn_prev"></button>
    @else
        <button type="button" class="btn_step prev" onclick="location.href='{{ $paginator->previousPageUrl() }}'"></button>
    @endif
    @foreach(range(1, $paginator->lastPage()) as $i)
        @if($paginator->currentPage() / (10 * $qty) <= $qty)
            @if($i <= (10 * $qty) && $i > (10 * ($qty - 1)))
                @if($i == $paginator->currentPage())
                    <button type="button" class="active">{{ $i }}</button>
                @else
                        <button type="button" onclick="location.href='{{ $paginator->url($i) }}'">{{ $i }}</button>
                @endif
            @endif
        @endif
        @if($paginator->currentPage() > (10 * $qty))
            @php
                $qty++;
            @endphp
        @endif
    @endforeach
    @if($paginator->hasMorePages())
            <button type="button" class="btn_next" onclick="location.href='{{ $paginator->nextPageUrl() }}'"></button>
    @else
            <button type="button" class="btn_next"></button>
    @endif
</div>

