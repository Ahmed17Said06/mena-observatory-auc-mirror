<div id='blogs_pagination'>
    <div class="pagination">
        <nav>
            <ul class="pagination">
                @if ($paginator->hasPages())
                    @php(isset($this->numberOfPaginatorsRendered[$paginator->getPageName()]) ? $this->numberOfPaginatorsRendered[$paginator->getPageName()]++ : $this->numberOfPaginatorsRendered[$paginator->getPageName()] = 1)
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="page-item disabled" style="min-width: 83px">
                    <span class="page-link">
                        <i class="fa fas fa-chevron-left"></i>
                    Prev
                    </span>
                        </li>
                    @else
                        <li class="page-item" style="min-width: 83px">
                            <a wire:click="previousPage" wire:loading.attr="disabled" class="page-link prev">
                                <i class="fa fas fa-chevron-left"></i>
                                Prev</a>
                        </li>
                    @endif
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                        @endif
                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="page-item disabled active">
                                        <span class="page-link" wire:loading.attr="disabled" >{{$page}}</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a wire:click="gotoPage({{$page}})" wire:loading.attr="disabled" class="page-link">
                                            {{$page}}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                    @if ($paginator->hasMorePages())
                        <li class="page-item" style="min-width: 65px">
                            <a wire:click="nextPage" wire:loading.attr="disabled" class="page-link">
                                Next
                                <i class="fa fas fa-chevron-right"></i>
                            </a>
                        </li>
                    @else
                        <li class="page-item disabled" style="min-width: 65px">
                            <span class="page-link">Next
                                <i class="fa fas fa-chevron-right"></i>
                            </span>

                        </li>
                    @endif
                @endif
                <li class="page-item">
                    <a href="{{route('news-all')}}" class="page-link">ALL NEWS</a>
                </li>
            </ul>
        </nav>
    </div>
</div>
