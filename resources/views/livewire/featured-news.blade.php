<div class='col-12'>

    <div id="blogs">
        <div class="flex-column flex-md-row lazy-items-container" style='
    display: flex;
    flex-wrap: wrap;
    align-content: center;
    padding-bottom: 50px;'>
            @foreach($blogs as $index => $n)
                <div class="post-container lazy-item">
                    <div class="post-loop-events position-relative overflow-hidden">
                        <img class="post-img" src="{{Storage::url($n->image)}}">
                        <div class="post-content" lang="en">
                            <h4 style='color:#FFF;' class='slide_title'>{{$n->title}}</h4>
                            <p style='color:#FFF;' class='slide_description'>{{$n->description}}</p>

                            <a href='{{route("news", ["id" => $n->id])}}'>
                                <button class='btn learn_more'><i class="fas fa-plus"></i> Learn More</button>
                            </a>
                        </div>

                        <div class="overlay-1"></div>
                        <div class="overlay-news"></div>
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
        @else
            @if($blogs->count() > 0)
                <div class="end-of-list">
                    You've reached the end
                </div>
            @endif
        @endif

    </div>
</div>