@extends('layouts.frontend.app', ['class' => 'g-sidenav-show bg-gray-100'])
<style>

    #map_outer {
        display: none !important;
    }
</style>
@section('content')
    @include('layouts.navbars.guest.navbar', ['title' => 'Dashboard'])
    <div class="w-100 my-3 my-lg-5 position-relative"
         @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl" @endif>
        <div class="bg-images contactus">
            <script src="https://unpkg.com/@dotlottie/player-component@1.0.0/dist/dotlottie-player.js"></script>
            <dotlottie-player autoplay loop src="/img/about_bot_left.lottie" class="about_bot_left"></dotlottie-player>
            <dotlottie-player autoplay loop src="/img/about_bot_right.lottie"
                              class="about_bot_right"></dotlottie-player>
            <dotlottie-player autoplay loop src="/img/about_top_left_mid.lottie"
                              class="about_top_left_mid"></dotlottie-player>
            <dotlottie-player autoplay loop src="/img/about_top_left.lottie" class="about_top_left"></dotlottie-player>
            <dotlottie-player autoplay loop src="/img/about_top_right.lottie"
                              class="about_top_right"></dotlottie-player>
        </div>

        <div class="container my-3 my-lg-5">
            <div class='row'>
                <h3 hreflang="{{ getLang() }}"
                    @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl" @endif>
                    @lang('translation.collaborate-with-us')</h3>
                <div class="col-lg-10" hreflang="{{ getLang() }}">
                    @if(LaravelLocalization::getCurrentLocale()=='ar')
                        {!!  $header_collaboration->ar_content !!}
                    @else
                        {!!  $header_collaboration->content !!}
                    @endif
                </div>
            </div>
        </div>
        <div class="container-lg-fluid bg-gray" hreflang="{{ getLang() }}"
             @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl"
                @endif>
            <div class="container py-3 py-lg-5">
                <div class="d-flex flex-column gap-3">
                    <div class="">
                        <div class="row gap-0 mx-md-5 justify-content-center">
                            <div class="col-12 col-md-4 text-break">
                                <div class="text-content text-center" hreflang="{{ getLang() }}">
                                    <p class="small-title">
                                        @lang('translation.find-partners')
                                    </p>
                                    <p>
                                        @if(getLang()==='ar')
                                            {!! $find_partners->ar_content !!}
                                        @else
                                            {!! $find_partners->content !!}
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 text-break">
                                <div class="text-content text-center" hreflang="{{ getLang() }}">
                                    <p class="small-title">
                                        @lang('translation.share-relevant')
                                    </p>
                                    <p>
                                        @if(getLang()==='ar')
                                            {!! $share_relevant->ar_content !!}
                                        @else
                                            {!! $share_relevant->content !!}
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="col-12 col-md-4  text-break">
                                <div class="text-content text-center" hreflang="{{ getLang() }}">
                                    <p class="small-title">
                                        @lang('translation.share-work')
                                    </p>
                                    <p>
                                        @if(getLang()==='ar')
                                            {!! $share_work->ar_content !!}
                                        @else
                                            {!! $share_work->content !!}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-lg-fluid" hreflang="{{ getLang() }}"
             @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl"
                @endif>
            <div class="container py-3 py-lg-5">
                <div class="d-flex flex-column gap-3">
                    <div class="">
                        <div class="row gap-5">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-lg-9">
                                        <div class="text-content" hreflang="{{ getLang() }}">
                                            <p class="small-title">
                                                @lang('translation.want-to-work')
                                            </p>
                                            <p>
                                                @if(getLang()==='ar')
                                                    {!! $want_to_work->ar_content !!}
                                                @else
                                                    {!! $want_to_work->content !!}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="h-100 d-flex align-items-end justify-content-end">
                                            <a href='{{route("work_together")}}'>
                                                <button class="btn btn-mena-3 float-end">
                                                    @lang('translation.work_together')
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-lg-9">
                                        <div class="text-content" hreflang="{{ getLang() }}">
                                            <p class="small-title">
                                                @lang('translation.want_share_event')
                                            </p>
                                            <p>
                                                @if(getLang()==='ar')
                                                    {!! $want_share_event->ar_content !!}
                                                @else
                                                    {!! $want_share_event->content !!}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="h-100 d-flex align-items-end justify-content-end">
                                            <a href='{{route("submit_an_event")}}'>
                                                <button class="btn btn-mena-3 float-end">
                                                    @lang('translation.submit_event')
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-lg-9">
                                        <div class="text-content" hreflang="{{ getLang() }}">
                                            <p class="small-title">
                                                @lang('translation.want_share_work')
                                            </p>
                                            <p>
                                                @if(getLang()==='ar')
                                                    {!! $want_share_work->ar_content !!}
                                                @else
                                                    {!! $want_share_work->content !!}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="h-100 d-flex align-items-end justify-content-end">
                                            <a href='{{route("submit_your_work")}}'>
                                                <button class="btn btn-mena-3">
                                                    @lang('translation.submit_work')
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container my-3 my-lg-5">
            <div class='row'>
                <h3 hreflang="{{ getLang() }}"
                    @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl" @endif>
                    @lang('translation.join-the-conversation')
                </h3>
                <div class="col-lg-10" hreflang="{{ getLang() }}">
                    @if(LaravelLocalization::getCurrentLocale()=='ar')
                        {!!  $footer_collaboration->ar_content !!}
                    @else
                        {!!  $footer_collaboration->content !!}
                    @endif
                </div>
            </div>
        </div>

    </div>
    @include('layouts.footers.guest.footer')
@endsection
