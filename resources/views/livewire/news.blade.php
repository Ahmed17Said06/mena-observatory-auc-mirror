<div class='col-12'>
    <div class='row' @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl" @endif>
        <div class="col-9">
            <div class="search-box event">
                <form>
                    <input class="search" type="text" placeholder="@lang('translation.search-posts')"
                           name="blogs_keywords" wire:keyup="updateSearch" wire:model="search" id='blogs_keywords'>
                    <button type="submit"><svg width="20" height="20" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_703_6664)">
                                <path d="M5.80292 11.413C2.62774 11.413 0 8.91304 0 5.76087C0 2.6087 2.62774 0 5.80292 0C8.9781 0 11.6058 2.6087 11.6058 5.76087C11.6058 8.91304 8.9781 11.413 5.80292 11.413ZM5.80292 1.08696C3.17518 1.08696 1.09489 3.15217 1.09489 5.76087C1.09489 8.36957 3.17518 10.4348 5.80292 10.4348C8.43066 10.4348 10.5109 8.36957 10.5109 5.76087C10.5109 3.15217 8.32117 1.08696 5.80292 1.08696Z" fill="#FAAF1C"/>
                                <path d="M9.68313 8.99118L8.90894 9.75977L14.2509 15.063L15.0251 14.2944L9.68313 8.99118Z" fill="#FAAF1C"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_703_6664">
                                    <rect width="15" height="15" fill="white"/>
                                </clipPath>
                            </defs>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">



            </div>
        </div>
    </div>
    <div id="blogs">
        <div class="flex-column flex-md-row" style='
    display: flex;
    flex-wrap: wrap;
    align-content: center;
    padding-bottom: 50px;'>
            @foreach($blogs as $n)
                <div class="post-container">
                    <div class="post-loop-events position-relative overflow-hidden">
                        <img class="post-img" src="{{Storage::url($n->image)}}">
                        <div class="post-content" lang="en">
                            <h4 style='color:#FFF;' class='slide_title'>{{$n->title}}</h4>
                            <p style='color:#FFF;' class='slide_description'>{{$n->description}}</p>

                            <a href='{{route("blogs.single", ["id" => $n->id])}}'><button class='btn learn_more'><i class="fas fa-plus"></i> Learn More</button></a>
                        </div>

                        <div class="overlay-1"></div>
                        <div class="overlay-news"></div>
                    </div>

                </div>
            @endforeach
        </div>
        {{$blogs->links()}}


    </div>
</div>
