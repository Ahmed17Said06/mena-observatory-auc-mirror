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
            <div class="col-lg-4">
                <img class="community-img" src="{{Storage::url($community->image)}}">
            </div>
            <div class="col-lg-8">
                <h3 class="mt-3 mt-lg-0">
                    {{$community->name}}
                </h3>
                <p>
                    {{$community->description}}

                </p>
                <div class="d-flex flex-column flex-lg-row my-3">
                    @foreach($community->interests as $interest)
                        <div class="tag">
                            {{$interest->name}}
                        </div>
                    @endforeach
                </div>
                <p>
                    {!! $community->content !!}
                </p>
                <div class="d-flex social-icons" style='margin-top:15px;'>
                    @if($community->twitter_link)
                        <a href="{{$community->twitter_link}}" class="fa fa-twitter"></a>
                    @endif
                    @if($community->facebook_link)
                        <a href="{{$community->facebook_link}}" class="fa fa-facebook"></a>
                    @endif
                    @if($community->linkedin_link)
                        <a href="{{$community->linkedin_link}}" class="fa fa-linkedin"></a>
                    @endif
                </div>
            </div>
        </div>
        {{--        <div class="d-none container">--}}
        @if($community->repos->count() > 0)
            <div class='row mt-5'>
                <h3 @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl"
                    @endif hreflang="{{ getLang() }}">@lang('translation.additional-resources')</h3>
                <livewire:show-community-repos wire:key='data1' :community="$community"/>
            </div>
        @endif
        {{--        </div>--}}
        <div class="d-none container">
            <div class='row mt-5'>
                <h3>News</h3>
                <livewire:featured-news wire:key='data2' :community="$community"/>
            </div>
        </div>
        @include('layouts.footers.guest.footer')
        <!-- Swiper JS -->
        <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

        <!-- Initialize Swiper -->

        <script>
            var swiper1 = new Swiper(".projects", {
                breakpoints: {
                    // when window width is >= 320px
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 15
                    },
                    // when window width is >= 480px
                    480: {
                        slidesPerView: 2,
                        spaceBetween: 20
                    },
                    // when window width is >= 1024px
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 30
                    }
                },

            });
        </script>

@endsection
