@extends('layouts.frontend.app', ['class' => 'g-sidenav-show bg-gray-100'])
<style>

    #map_outer {
        display: none !important;
    }
</style>
@section('content')
    @include('layouts.navbars.guest.navbar', ['title' => 'Dashboard'])
    <div class="container my-3 my-lg-5">
        <div class='row'>
            <div class="col-md-8">
                <div class="post-loop-inner position-relative"
                     style='background-image:url({{Storage::url($blog->image)}});'>
                    <div class="post-content" lang="en">
                        <h6 style='color:#FFF;' class=''>
                            {{$blog->title}}
                        </h6>
                        <p class="post-date">
                            {{$blog->publish_date}}
                        </p>
                    </div>
                    <div class="overlay-1"></div>
                </div>
                <div class="d-flex flex-column flex-lg-row">
                    <div class="col-12 col-lg-10 d-flex gap-3 flex-wrap">
                        @foreach($blog->tags as $tag)
                            <a class="tag" href="/search?tag={{ urlencode($tag->name) }}">
                                {{$tag->name}}
                            </a>
                        @endforeach
                    </div>
                    <div class="col-lg-2 col-12 pt-3 pt-lg-0">
                        <!-- Views counter - center aligned -->
                        <div class="d-flex align-items-center justify-content-center">
                            <img style="object-fit: contain;max-width: 29px; margin-right: 15px"
                                 src="/img/Views_Icon.svg">
                            <span style="white-space: nowrap;">{{$blog->views}} Views</span>
                        </div>

                        <!-- Social Share Buttons - increased vertical spacing and centered -->
                        <div class="social-share-buttons d-flex flex-column align-items-center mt-5" style="margin-left: 0;">
                            <!-- Share title above the logos, centered -->
                            <span class="text-center" style="margin-bottom: 8px; white-space: nowrap;">Share</span>
                            
                            <!-- Icons in their own row with center alignment -->
                            <div class="d-flex justify-content-center">
                                <!-- Facebook -->
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                   target="_blank" class="fa-brands fa-facebook-f" aria-label="Share on Facebook"
                                   style="background: #3b5998; font-size: 14px; width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; margin-right: 8px; border-radius: 50%; color: white;"></a>
                                
                                <!-- X (Twitter) -->
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}" 
                                   target="_blank" class="fa-brands fa-x-twitter" aria-label="Share on X"
                                   style="background: #000000; font-size: 14px; width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; margin-right: 8px; border-radius: 50%; color: white;"></a>
                                
                                <!-- LinkedIn -->
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}"
                                   target="_blank" class="fa-brands fa-linkedin-in" aria-label="Share on LinkedIn"
                                   style="background: #0077b5; font-size: 14px; width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; margin-right: 8px; border-radius: 50%; color: white;"></a>
                                
                                <!-- WhatsApp -->
                                <a href="https://api.whatsapp.com/send?text={{ urlencode($blog->title) }}%20{{ urlencode(url()->current()) }}" 
                                   target="_blank" class="fa-brands fa-whatsapp" aria-label="Share on WhatsApp"
                                   style="background: #25D366; font-size: 14px; width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; margin-right: 8px; border-radius: 50%; color: white;"></a>
                                   
                                <!-- Copy Link -->
                                <a href="#" id="copy-link-button" class="fa-solid fa-link" aria-label="Copy link"
                                   style="background: #6c757d; font-size: 14px; width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; border-radius: 50%; color: white; cursor: pointer;"
                                   data-url="{{ url()->current() }}"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='blog-content'>
                    <p>{!! $blog->content !!}</p>
                </div>
            </div>
            <div class='col-md-4'>
                <h6>Related Posts</h6>
                @foreach($relatedBlogs as $post)
                    <div class="post-loop-featured position-relative"
                         style='background-image:url({{Storage::url($post->image)}});'>

                        <div class="post-content" lang="en">
                        <a href='{{route("new-work-blogs.single", ["id" => $post->id])}}'><h4 style='color:#FFF;' class='slide_title'>{{$post->title}}</h4></a>
                            
                            <p style='color:#FFF;' class='slide_description'>{{$post->description}}</p>
                            <a href='{{route("new-work-blogs.single", ["id" => $post->id])}}'>
                                <button class='btn learn_more'><i class="fas fa-plus"></i> Learn More</button>
                            </a>
                        </div>

                        <div class="overlay-1"></div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @include('layouts.footers.guest.footer')

    <!-- Add JavaScript for copy link functionality -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const copyButton = document.getElementById('copy-link-button');
        
        copyButton.addEventListener('click', function(e) {
            e.preventDefault();
            const url = this.getAttribute('data-url');
            
            navigator.clipboard.writeText(url).then(() => {
                // Show success feedback
                const originalBackground = this.style.background;
                const originalIcon = this.className;
                
                this.style.background = '#28a745';
                this.className = 'fa-solid fa-check';
                
                setTimeout(() => {
                    this.style.background = originalBackground;
                    this.className = originalIcon;
                }, 1500);
            });
        });
    });
    </script>
@endsection