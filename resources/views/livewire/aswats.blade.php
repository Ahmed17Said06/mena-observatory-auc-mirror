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
                <a href='{{$n->link}}'>
                    <div class="post-loop position-relative overflow-hidden">
                        <img class="post-img" src="{{Storage::url($n->thumbnail_image)}}">
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