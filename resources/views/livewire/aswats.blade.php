<div class="container">
    <h3 @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl"
        @endif hreflang="{{ getLang() }}">@lang('translation.aswat')</h3>
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
                        <img class="post-img" src="{{ $n->thumbnail_url }}">
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
</div>
