<div id='blogs_pagination'>
    <div class="pagination">
        <nav>
            <ul class="pagination">
                @if ($paginator->hasPages())
                    @php(isset($this->numberOfPaginatorsRendered[$paginator->getPageName()]) ? $this->numberOfPaginatorsRendered[$paginator->getPageName()]++ : $this->numberOfPaginatorsRendered[$paginator->getPageName()] = 1)
                    {{-- Previous Page Link --}}

                    @if ($paginator->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link">
                                <i class="fa fas fa-chevron-left"></i>
                                Prev
                            </span>
                        </li>
                    @else
                        <li class="page-item">
                            <a wire:click="previousPage" wire:loading.attr="disabled" class="page-link prev">
                                <i class="fa fas fa-chevron-left"></i>
                                Prev
                            </a>
                        </li>
                    @endif
                    @foreach ($elements as $element)
                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if (($page == $paginator->currentPage())&&$page>2&&$page<=$paginator->lastPage() - 2)
                                    <li class="page-item active">
                                        <a wire:click="gotoPage({{$page}})" wire:loading.attr="disabled"
                                           class="page-link">
                                            {{$page}}
                                        </a>
                                    </li>
                                @endif
                                @if ($page <= 2)
                                    <li class="page-item @if($page === $paginator->currentPage()) active @endif">
                                        <a wire:click="gotoPage({{$page}})" wire:loading.attr="disabled"
                                           class="page-link">
                                            {{$page}}
                                        </a>
                                    </li>
                                @elseif ($page === 3 && sizeof($element)>4)
                                    <li class="page-item disabled">
                                        <span class="page-link">...</span>
                                    </li>
                                @elseif ($page > $paginator->lastPage() - 2)
                                    <li class="page-item @if($page === $paginator->currentPage()) active @endif">
                                        <a wire:click="gotoPage({{$page}})" wire:loading.attr="disabled"
                                           class="page-link">
                                            {{$page}}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                    @if ($paginator->hasMorePages())
                        <li class="page-item">
                            <a wire:click="nextPage" wire:loading.attr="disabled" class="page-link">
                                Next
                                <i class="fa fas fa-chevron-right"></i>
                            </a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <span class="page-link">Next
                                <i class="fa fas fa-chevron-right"></i>
                            </span>
                        </li>
                    @endif
                @endif

            </ul>
        </nav>
    </div>
</div>
