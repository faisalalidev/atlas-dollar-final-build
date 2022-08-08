<div>

    @if ($paginator->hasPages())
        <div class="toolbox toolbox-pagination justify-content-center mb-8">
            <ul class="pagination">
                @if ($paginator->onFirstPage())
                    <li class="prev disabled">
                        <a href="javascript:;" aria-label="Previous" tabindex="-1" aria-disabled="true">
                            <i class="w-icon-long-arrow-left"></i>Prev
                        </a>
                    </li>
                @else
                    <a class="" href="javascript:;"
                       wire:click="previousPage">
                        <i class="w-icon-long-arrow-left"></i>Prev
                    </a>
                @endif

                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled">
                            <a href="javascript:;" class="page-link" aria-disabled="true"
                               href="javascript:;">{{ $element }}</a>
                        </li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active">
                                    <a href="javascript:;" class="page-link">{{ $page }}</a>
                                </li>
                            @else
                                <a href="javascript:;" class="page-link"
                                   wire:click="gotoPage({{ $page }})">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                @if ($paginator->hasMorePages())
                    <li class="next">
                        <a href="javascript:;" aria-label="Next" dusk="nextPage" wire:click="nextPage" rel="next"
                           aria-label="@lang('pagination.next')">
                            Next<i class="w-icon-long-arrow-right"></i>
                        </a>
                    </li>
                @else
                    <li class="next disabled">
                        <a href="javascript:;" aria-disabled="true" aria-label="@lang('pagination.next')">
                            Next<i class="w-icon-long-arrow-right"></i>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    @endif

</div>
