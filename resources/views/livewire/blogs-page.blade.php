<div class="container">
    <h3 @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl"
        @endif hreflang="{{ getLang() }}">@lang('translation.posts')</h3>

    <div class='row' @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl" @endif>
        <div class="col-md-6 col-12">
            <div class="search-box event">
                <form wire:submit.prevent>
                    <input class="search" type="text" placeholder="@lang('translation.search-posts')"
                           name="posts_keywords" wire:model.debounce.400ms="search" id='posts_keywords'>
                    <button type="submit" aria-label="@lang('translation.search-posts')">
                        <svg width="20" height="20" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_blogs_search)">
                                <path d="M5.80292 11.413C2.62774 11.413 0 8.91304 0 5.76087C0 2.6087 2.62774 0 5.80292 0C8.9781 0 11.6058 2.6087 11.6058 5.76087C11.6058 8.91304 8.9781 11.413 5.80292 11.413ZM5.80292 1.08696C3.17518 1.08696 1.09489 3.15217 1.09489 5.76087C1.09489 8.36957 3.17518 10.4348 5.80292 10.4348C8.43066 10.4348 10.5109 8.36957 10.5109 5.76087C10.5109 3.15217 8.32117 1.08696 5.80292 1.08696Z" fill="#FAAF1C"/>
                                <path d="M9.68313 8.99118L8.90894 9.75977L14.2509 15.063L15.0251 14.2944L9.68313 8.99118Z" fill="#FAAF1C"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_blogs_search">
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
        @foreach($blogs as $index => $n)
            <div class="post-container lazy-item">
                <div class="post-loop position-relative overflow-hidden">
                    <img class="post-img" src="{{Storage::url($n->image)}}">
                    <div class="post-content" lang="en">
                        <h4 style='color:#FFF;' class='slide_title'>
                        <a href='{{route("blogs.single", ["id" => $n->id])}}'>{{$n->title}}</a>
                        </h4>
                        <p style='color:#FFF;' class='slide_description'>{{$n->description}}</p>
                        <a href='{{route("blogs.single", ["id" => $n->id])}}'>
                            <button class='btn learn_more'><i class="fas fa-plus"></i> Read More</button>
                        </a>
                    </div>

                    <div class="overlay-1"></div>
                </div>
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

    @if($blogs->count() === 0)
        <div class="end-of-list" @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl" @endif>
            @if(trim($search) !== '')
                @lang('translation.no-results-found')
            @endif
        </div>
    @endif
</div>