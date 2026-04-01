<div class="container">
    <h3 class="mb-4" @if(LaravelLocalization::getCurrentLocale()==='ar' ) dir="rtl" @endif>
        @lang('translation.blogs')
    </h3>

    <div class="lazy-items-container" style='overflow: hidden; display: flex; flex-wrap: wrap; justify-content: center;'>
        @if($newWorkBlogs && $newWorkBlogs->count() > 0)
        @foreach($newWorkBlogs as $index => $blog)
        <div class="post-container lazy-item">
            <div class="post-loop position-relative overflow-hidden">
                <img class="post-img" src="{{Storage::url($blog->image)}}">
                <div class="post-content" lang="en">
                    <h4 style='color:#FFF;' class='slide_title'>
                        <a href='{{route("new-work-blogs.single", ["id" => $blog->id])}}'>{{$blog->title}}</a>
                    </h4>
                    <p style='color:#FFF;' class='slide_description'>
                        {{ Str::limit(strip_tags($blog->description), 80) }}</p>
                    <a href='{{route("new-work-blogs.single", ["id" => $blog->id])}}'>
                        <button class='btn learn_more'><i class="fas fa-plus"></i> Read More</button>
                    </a>
                </div>
                <div class="overlay-1"></div>
            </div>
        </div>
        @endforeach
        @else
        @for($i = 0; $i < 3; $i++) <div class="post-container">
            <div class="post-loop position-relative overflow-hidden">
                <img class="post-img" src="{{ asset('storage/' . "storage/680e75fc3ae42995d06462837d3d5085.png") }}"
                    alt="Blog Image">
                <div class="post-content" lang="en">
                    <h4 style='color:#FFF;' class='slide_title'>No Blog</h4>
                    <p style='color:#FFF;' class='slide_description'>No blogs available yet. Please add blogs from the
                        admin panel.</p>
                    <button class='btn learn_more disabled'><i class="fas fa-plus"></i> Not Available</button>
                </div>
                <div class="overlay-1"></div>
            </div>
    </div>
    @endfor
    @endif
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
    @if($newWorkBlogs->count() > 0)
        <div class="end-of-list">
            You've reached the end
        </div>
    @endif
@endif
</div>