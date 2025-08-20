<div class="container">
    <h3 class="mb-4" @if(LaravelLocalization::getCurrentLocale()==='ar' ) dir="rtl" @endif>
        @lang('translation.blogs')
    </h3>

    <div style='overflow: hidden; display: flex; flex-wrap: wrap; justify-content: center;'>
        @if($newWorkBlogs && $newWorkBlogs->count() > 0)
        @foreach($newWorkBlogs as $blog)
        <div class="post-container">
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

@if($newWorkBlogs->hasPages())
<div class="d-flex justify-content-center">
    {{ $newWorkBlogs->links() }}
</div>
@endif
</div>