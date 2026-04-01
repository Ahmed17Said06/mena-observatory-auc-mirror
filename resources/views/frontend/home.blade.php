@extends('layouts.frontend.app', ['class' => 'g-sidenav-show bg-gray-100'])
<style>

    #map_outer {
        display: none !important;
    }
</style>
<!--<img src="https://demobasics.pixienop.net/img/tweetcarts/fallingsand.gif" width='100%' style='z-index:99;position:absolute;top:0;left:0;'>-->
@section('content')
    @include('layouts.navbars.guest.navbar', ['title' => 'Dashboard'])
    <script src="https://unpkg.com/@dotlottie/player-component@1.0.0/dist/dotlottie-player.js"></script>
    <div class="hero-home">
        <div class="bg-images home">
            <!-- Optimized: Reduced from 5 to 2 Lottie animations for better performance -->
            <dotlottie-player autoplay loop src="/img/top_left.lottie" class="lottie_top_left"></dotlottie-player>
            <dotlottie-player autoplay loop src="/img/top_right.lottie" class="lottie_top_right"></dotlottie-player>
        </div>
        <div hreflang="{{ getLang() }}" class="container" style="
    margin: 50px 0px;">
            <h1 hreflang="{{ getLang() }}" id='main_title'
                style='color:#FFF;text-align:center;'>@lang('translation.mena-ai-bbservatory')</h1>
            <div style='text-align:center;' id='intro'>
                @if(LaravelLocalization::getCurrentLocale()=='ar')
                    {!!  $intro->ar_content !!}
                @else
                    {!!  $intro->content !!}
                @endif
            </div>
            <a hreflang="{{ getLang() }}" class="btn btn-mena-hero" href='{{route("about_us")}}'>
                @lang('translation.learn-more')
            </a>
        </div>
        <a href="/home#Regional" style="
    position: absolute;
    bottom: 30px;
    left: calc(50% + -11px);">
            <svg width="22" height="14" viewBox="0 0 22 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M10.2031 12.9063C10.625 13.3281 11.3281 13.3281 11.75 12.9063L20.8906 3.8125C21.3125 3.34375 21.3125 2.64063 20.8906 2.21875L19.8125 1.14063C19.3906 0.71875 18.6875 0.71875 18.2188 1.14063L11 8.35938L3.73437 1.14063C3.26562 0.71875 2.5625 0.71875 2.14062 1.14063L1.0625 2.21875C0.640625 2.64062 0.640625 3.34375 1.0625 3.8125L10.2031 12.9063Z"
                    fill="#F4C465"/>
            </svg>
        </a>
    </div>
    
    <livewire:featured-page />

    <livewire:genderai-page />

  
    <div class="d-none container mt-5">
        <h3>NEWS & EVENTS</h3>
        <div class="flex-column flex-md-row" style='
    display: flex;
    flex-wrap: wrap;
    align-content: center;
    padding-bottom: 50px;'>

            @foreach($news_events as $n)

                <div class="post-container">
                    <div class="post-loop-news position-relative overflow-hidden">
                        <img class="post-img" src="{{Storage::url($n->image)}}">
                        @if ($n instanceof App\Models\News)
                            <div class="category-stamp news">
                                <span>NEWS</span>
                                @else
                                    <div class="category-stamp events">
                                        <span>EVENTS</span>
                                        @endif            </div>
                                    <div class="post-content" lang="en">
                                        <h4 style='color:#FFF;' class='slide_title'>{{$n->title}}</h4>
                                        <p style='color:#FFF;' class='slide_description'>{{$n->description}}</p>

                                    @if ($n instanceof App\Models\News)

                                            <a href='{{route("news", ["id" => $n->id])}}'>
                                                @else
                                                    <a href='{{route("events.single", ["id" => $n->id])}}'>

                                                        @endif
                                                        <button class='btn learn_more'><i class="fas fa-plus"></i> Read
                                                            More
                                                        </button>
                                                    </a>

                                    </div>

                                    <div class="overlay-1"></div>
                                    @if ($n instanceof App\Models\News)

                                        <div class="overlay-news"></div>
                                    @else
                                        <div class="overlay-event"></div>
                                    @endif
                            </div>
                    </div>
                    @endforeach
                </div>
        </div>




    <livewire:aswats/>
    
    <livewire:blogs-page />

    <div class='subs'>
        <dotlottie-player autoplay loop src="/img/top_right.lottie" class="lottie_top_right"></dotlottie-player>
        <div class="container">
            <h3 hreflang="{{ getLang() }}">@lang('translation.subscribe-newsletter')</h3>
            <div class='row'>
                <div class='col-md-7'>
                    <form method="POST" action="{{ route('subscribe') }}" style="display: flex; gap: 20px;" class="newsletter-form">
                        @csrf
                        <input type="email" name="email" placeholder="@lang('translation.your-email')" required class="newsletter-input">
                        <button type="submit" class="btn btn-mena-2">@lang('translation.subscribe')</button>
                    </form>
                    @if(session('subscribe_success'))
                        <div class="alert alert-success mt-3">{{ session('subscribe_success') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <style>
        .footer-divider {
            border: 0px
        }

    </style>
    @include('layouts.footers.guest.footer')
@endsection
