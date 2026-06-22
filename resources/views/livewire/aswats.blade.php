<div class="container">
    <h3 @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl"
        @endif hreflang="{{ getLang() }}">@lang('translation.aswat')</h3>

    <div class='row' @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl" @endif>
        <div class="col-md-6 col-12">
            <div class="search-box event">
                <form wire:submit.prevent>
                    <input class="search" type="text" placeholder="@lang('translation.search-posts')"
                           name="aswat_keywords" wire:model.debounce.400ms="search" id='aswat_keywords'>
                    <button type="submit" aria-label="@lang('translation.search-posts')">
                        <svg width="20" height="20" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_aswat_search)">
                                <path d="M5.80292 11.413C2.62774 11.413 0 8.91304 0 5.76087C0 2.6087 2.62774 0 5.80292 0C8.9781 0 11.6058 2.6087 11.6058 5.76087C11.6058 8.91304 8.9781 11.413 5.80292 11.413ZM5.80292 1.08696C3.17518 1.08696 1.09489 3.15217 1.09489 5.76087C1.09489 8.36957 3.17518 10.4348 5.80292 10.4348C8.43066 10.4348 10.5109 8.36957 10.5109 5.76087C10.5109 3.15217 8.32117 1.08696 5.80292 1.08696Z" fill="#FAAF1C"/>
                                <path d="M9.68313 8.99118L8.90894 9.75977L14.2509 15.063L15.0251 14.2944L9.68313 8.99118Z" fill="#FAAF1C"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_aswat_search">
                                    <rect width="15" height="15" fill="white"/>
                                </clipPath>
                            </defs>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="lazy-items-container" style='
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    align-content: center;
    padding-bottom: 50px;'>
        @foreach($aswats as $index => $n)
            <div class="post-container lazy-item">
                @if($n->embed_url)
                    <a href="#" class="aswat-play" data-embed="{{ $n->embed_url }}" data-title="{{ $n->title }}">
                @else
                    <a href="{{ $n->link }}" target="_blank" rel="noopener">
                @endif
                    <div class="post-loop position-relative overflow-hidden">
                        <img class="post-img" src="{{ $n->thumbnail_url ?: '/img/card-placeholder.svg' }}" onerror="this.onerror=null;this.src='/img/card-placeholder.svg'">
                        <div class="post-content" lang="en">
                            <h4 style='color:#FFF;' class='slide_title' lang="en">{{$n->title}}</h4>
                            <p style='color:#FFF;' class='slide_description'>{{$n->description}}</p>

                        </div>

                        <div class="overlay-1"></div>
                        <div class="play-btn"></div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    {{-- Inline video player modal (shared by all aswat cards) --}}
    <div id="aswat-modal" class="aswat-modal" aria-hidden="true">
        <div class="aswat-modal__backdrop" data-close></div>
        <div class="aswat-modal__dialog" role="dialog" aria-modal="true" aria-label="Video player">
            <button type="button" class="aswat-modal__close" data-close aria-label="Close">&times;</button>
            <div class="aswat-modal__frame">
                <iframe id="aswat-modal__iframe" src="" frameborder="0"
                        allow="autoplay; encrypted-media; fullscreen; picture-in-picture"
                        allowfullscreen></iframe>
            </div>
        </div>
    </div>

    <style>
        .aswat-modal { position: fixed; top: 0; right: 0; bottom: 0; left: 0; z-index: 1050; display: none; }
        .aswat-modal.is-open { display: block; }
        .aswat-modal__backdrop { position: absolute; top: 0; right: 0; bottom: 0; left: 0; background: rgba(1,16,38,.82); -webkit-backdrop-filter: blur(3px); backdrop-filter: blur(3px); }
        .aswat-modal__dialog {
            position: absolute; top: 50%; left: 50%; transform: translate(-50%,-50%);
            width: min(900px, 92vw);
        }
        .aswat-modal__frame { position: relative; padding-bottom: 56.25%; height: 0; border-radius: 12px; overflow: hidden; background: #000; box-shadow: 0 20px 60px rgba(0,0,0,.5); }
        .aswat-modal__frame iframe { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }
        .aswat-modal__close {
            position: absolute; top: -42px; right: 0; width: 36px; height: 36px;
            background: transparent; border: none; color: #fff; font-size: 34px; line-height: 1;
            cursor: pointer; opacity: .85; transition: opacity .2s;
        }
        .aswat-modal__close:hover { opacity: 1; }
    </style>

    <script>
        (function () {
            // Bind document-level listeners once; resolve modal/iframe at
            // click-time so Livewire re-renders (Load More) can't leave us
            // holding stale element references.
            if (window.aswatModalBound) return;
            window.aswatModalBound = true;

            function open(src) {
                var modal = document.getElementById('aswat-modal');
                var iframe = document.getElementById('aswat-modal__iframe');
                if (!modal || !iframe) return;
                iframe.src = src;
                modal.classList.add('is-open');
                modal.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
            }
            function close() {
                var modal = document.getElementById('aswat-modal');
                var iframe = document.getElementById('aswat-modal__iframe');
                if (!modal || !iframe) return;
                modal.classList.remove('is-open');
                modal.setAttribute('aria-hidden', 'true');
                iframe.src = ''; // stop playback
                document.body.style.overflow = '';
            }

            document.addEventListener('click', function (e) {
                var trigger = e.target.closest('.aswat-play');
                if (trigger) {
                    e.preventDefault();
                    open(trigger.getAttribute('data-embed'));
                    return;
                }
                if (e.target.closest('[data-close]')) {
                    close();
                }
            });
            document.addEventListener('keydown', function (e) {
                var modal = document.getElementById('aswat-modal');
                if (e.key === 'Escape' && modal && modal.classList.contains('is-open')) close();
            });
        })();
    </script>
    
    <!-- Load More Button -->
    @if($hasMorePages)
        <div class="load-more-container">
            <button 
                class="btn-load-more"
                wire:click="loadMore"
                wire:loading.attr="disabled"
                wire:loading.class="loading"
            >
                <span wire:loading.remove wire:target="loadMore">Load More</span>
                <span wire:loading wire:target="loadMore" class="loading-state">
                    <span class="spinner"></span>
                    Loading...
                </span>
            </button>
        </div>
    @endif

    @if($aswats->count() === 0)
        <div class="end-of-list" @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl" @endif>
            @if(trim($search) !== '')
                @lang('translation.no-results-found')
            @endif
        </div>
    @endif
</div>
