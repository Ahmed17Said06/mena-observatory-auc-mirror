<div class="container">
    <h3 class="mb-4" @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl" @endif>
        @lang('translation.blogs')
    </h3>

    <div style='overflow: hidden; display: flex; flex-wrap: wrap; justify-content: center;'>
        @if($newWorkBlogs && $newWorkBlogs->count() > 0)
            @foreach($newWorkBlogs as $blog)
                <div class="post-container">
                    <div class="post-loop position-relative overflow-hidden">
                        @if($blog->image_path)
                            <img class="post-img" src="{{ asset('storage/' . $blog->image_path) }}" alt="{{ $blog->title }}">
                        @else
                            <img class="post-img" src="{{ asset('img/placeholder.png') }}" alt="Blog Image">
                        @endif

                        <div class="post-content" lang="en">
                            <h4 style='color:#FFF;' class='slide_title'>{{ $blog->title }}</h4>
                            <p style='color:#FFF;' class='slide_description'>{{ Str::limit(strip_tags($blog->description), 80) }}</p>
                            @if($blog->file_path)
                                <a href="{{ asset('storage/' . $blog->file_path) }}" target="_blank">
                                    <button class='btn learn_more'><i class="fas fa-plus"></i> Read More</button>
                                </a>
                            @else
                                <button class='btn learn_more disabled'><i class="fas fa-plus"></i> Not Available</button>
                            @endif
                        </div>
                        <div class="overlay-1"></div>
                    </div>
                </div>
            @endforeach
        @else
            @for($i = 0; $i < 3; $i++)
                <div class="post-container">
                    <div class="post-loop position-relative overflow-hidden">
                        <img class="post-img" src="{{ asset('img/placeholder.png') }}" alt="Blog Image">
                        <div class="post-content" lang="en">
                            <h4 style='color:#FFF;' class='slide_title'>No Blog</h4>
                            <p style='color:#FFF;' class='slide_description'>No blogs available yet. Please add blogs from the admin panel.</p>
                            <button class='btn learn_more disabled'><i class="fas fa-plus"></i> Not Available</button>
                        </div>
                        <div class="overlay-1"></div>
                    </div>
                </div>
            @endfor
        @endif
    </div>

    @if($newWorkBlogs->hasPages())
        <div class="d-flex justify-content-center">
            {{ $newWorkBlogs->links() }}
        </div>
    @endif
</div>
