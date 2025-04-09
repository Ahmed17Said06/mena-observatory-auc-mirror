@extends('layouts.frontend.app', ['class' => 'g-sidenav-show bg-gray-100'])
<style>

    #map_outer{
        display:none !important;
    }
</style>
<!--<img src="https://demobasics.pixienop.net/img/tweetcarts/fallingsand.gif" width='100%' style='z-index:99;position:absolute;top:0;left:0;'>-->
@section('content')
    @include('layouts.navbars.guest.navbar', ['title' => 'Dashboard'])
    <div class="bg-images contactus">
        <img style="top:426px;" src="/img/Vector-1.png">
        <img style="top: 0px;right: 0px;" src="/img/Vector-6.png">
        <img style="top: 226px;" src="/img/Vector-3.png">
        <img style="top: -19px;" src="/img/Vector-4.png">
        <img style="top: 317px;right: 0px;" src="/img/Vector-5.png">
    </div>

    <div class="container py-3">
        <div class="row">
            <div class="search-box w-100">
                <form>
                    <input class="search" type="text" value="{{ old('search') }}" placeholder="Search.." name="search">
                    <input hidden class="search" type="text" value="{{ old('tag') }}" placeholder="Search.." name="tag">

                    <button type="submit"><svg width="20" height="20" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_703_6664)">
                                <path d="M5.80292 11.413C2.62774 11.413 0 8.91304 0 5.76087C0 2.6087 2.62774 0 5.80292 0C8.9781 0 11.6058 2.6087 11.6058 5.76087C11.6058 8.91304 8.9781 11.413 5.80292 11.413ZM5.80292 1.08696C3.17518 1.08696 1.09489 3.15217 1.09489 5.76087C1.09489 8.36957 3.17518 10.4348 5.80292 10.4348C8.43066 10.4348 10.5109 8.36957 10.5109 5.76087C10.5109 3.15217 8.32117 1.08696 5.80292 1.08696Z" fill="#FAAF1C"></path>
                                <path d="M9.68313 8.99118L8.90894 9.75977L14.2509 15.063L15.0251 14.2944L9.68313 8.99118Z" fill="#FAAF1C"></path>
                            </g>
                            <defs>
                                <clipPath id="clip0_703_6664">
                                    <rect width="15" height="15" fill="white"></rect>
                                </clipPath>
                            </defs>
                        </svg>
                    </button>
                </form>
            </div>

            <div class='py-3'>
                <h3>{{$count}} Results found for : {{old('search')}}</h3>
                <h3 @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl"
                    @endif hreflang="{{ getLang() }}">@lang('translation.events')</h3>

                <div class="flex-column flex-md-row" style='
    display: flex;
    flex-wrap: wrap;
    align-content: center;
    padding-bottom: 50px;'>
                    @foreach($events as $n)

                        <div class="post-container">
                            <div class="post-loop-news position-relative overflow-hidden">
                                <img class="post-img" src="{{Storage::url($n->image)}}">
                                <div class="overlay-1"></div>
                                <div class="post-content" lang="en">
                                                <h4 style='color:#FFF;' class='slide_title'>{{$n->title}}</h4>
                                    <p style='color:#FFF;' class='slide_description'>{{$n->description}}</p>

                                                            <a href='{{route("events.single", ["id" => $n->id])}}'>
                                                                <button class='btn learn_more'><i class="fas fa-plus"></i> Read More</button></a>

                                            </div>
                                            <div class="overlay-1"></div>

                                                <div class="overlay-event"></div>
                                    </div>
                            </div>
                            @endforeach
                </div>
            <div class='py-3'>
                <h3 @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl"
                    @endif hreflang="{{ getLang() }}">@lang('translation.articles')</h3>
                <div class="flex-column flex-md-row" style='
    display: flex;
    flex-wrap: wrap;
    align-content: center;
    padding-bottom: 50px;'>
                    @foreach($news as $n)
                        <div class="post-container">
                            <div class="post-loop-events position-relative overflow-hidden">
                                <div class="overlay-1"></div>
                                <img class="post-img" src="{{Storage::url($n->image)}}">
                                <div class="post-content" lang="en">
                                    <h4 style='color:#FFF;' class='slide_title'>{{$n->title}}</h4>
                                    <p style='color:#FFF;' class='slide_description'>{{$n->description}}</p>

                                    <a href='{{route("news", ["id" => $n->id])}}'><button class='btn learn_more'><i class="fas fa-plus"></i> Learn More</button></a>
                                </div>

                                <div class="overlay-1"></div>
                                <div class="overlay-news"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class='py-3'>
                <h3 @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl"
                    @endif hreflang="{{ getLang() }}">@lang('translation.posts')</h3>
                <div class="flex-column flex-md-row" style='
    display: flex;
    flex-wrap: wrap;
    align-content: center;
    padding-bottom: 50px;'>
                    @foreach($blogs as $n)
                        <div class="post-container">
                            <div class="post-loop-events position-relative overflow-hidden">
                                <div class="overlay-1"></div>
                                <img class="post-img" src="{{Storage::url($n->image)}}">
                                <div class="post-content" lang="en">
                                    <h4 style='color:#FFF;' class='slide_title'>{{$n->title}}</h4>
                                    <p style='color:#FFF;' class='slide_description'>{{$n->description}}</p>

                                    <a href='{{route("blogs.single", ["id" => $n->id])}}'><button class='btn learn_more'><i class="fas fa-plus"></i> Learn More</button></a>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
                <div class='py-3'>
                    <h3 @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl"
                        @endif hreflang="{{ getLang() }}">@lang('translation.projects')</h3>
                    <div class="flex-column flex-md-row" style='
    display: flex;
    flex-wrap: wrap;
    align-content: center;
    padding-bottom: 50px;'>
                        @foreach($projects as $n)
                            <div class="post-container">
                                <div class="post-loop-events position-relative overflow-hidden">
                                    <div class="overlay-1"></div>
                                    <img class="post-img" src="{{Storage::url($n->image)}}">

                                    <div class="post-content" lang="en">
                                        <h4 style='color:#FFF;' class='slide_title'>{{$n->title}}</h4>
                                        <p style='color:#FFF;' class='slide_description'>{{$n->description}}</p>

                                        <a href='{{route("repo.single", ["id" => $n->id])}}'><button class='btn learn_more'><i class="fas fa-plus"></i> Learn More</button></a>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
        </div>
    </div>
    @include('layouts.footers.guest.footer')
@endsection
