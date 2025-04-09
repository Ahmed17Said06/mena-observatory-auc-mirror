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

        <div class="container">
            <div class='row'>
                <h1 class='big-title' hreflang="{{ getLang() }}">@lang('translation.mena-ai-bbservatory')</h1>
            </div>
        </div>
        <div class="container d-flex justify-content-center py-4">
            <div class='row w-100 w-lg-90'>
                <div class='col-12'>
                    <video controls muted autoplay class="video">
                        {{--                        <source src="{{ asset('/img/video.mp4') }}" type="video/mp4">--}}
                        <source src="{{ url($video_content->media) }}" type="video/mp4">
                        Your browser does not support the video tag.
                        <track src="{{asset('subtitle/A2K4D - Mena AI - About Us Video - Subs AR.vtt')}}" label="Arabic"
                               kind="captions" srclang="ar" default>
                        <track src="{{asset('subtitle/A2K4D - Mena AI - About Us Video - Subs ENG.vtt')}}"
                               label="English" kind="captions" srclang="en">

                    </video>
                </div>
            </div>
        </div>

        <!-- Your existing HTML with some modifications -->
        <div class="container d-flex justify-content-center py-4">
            <div class='row w-100 m-lg-0 w-lg-90'>
                <h3 class='col-lg-4 mt-3' hreflang="{{ getLang() }}">@lang('translation.our-story')</h3>
                <div class='col-lg-8 my-lg-3'>
                    <div class="text-container" id="textContainer1">
                        <div hreflang="{{ getLang() }}" class="text-content add-read-more show-less-content">
                            @if(LaravelLocalization::getCurrentLocale()=='ar')
                                {!!  $story->ar_content !!}
                            @else
                                {!!  $story->content !!}
                            @endif
                        </div>
                    </div>
                    <span class="read-more-btn" onclick="toggleText('textContainer1', this)">@lang('translation.read-more+')</span>

                </div>
            </div>
        </div>

        <div class="container d-flex justify-content-center">
            <div class='row w-100 m-lg-0 w-lg-90'>
                <h3 class='col-lg-4 mt-3' hreflang="{{ getLang() }}">@lang('translation.why-a-mena-ai-observatory')</h3>
                <div class='col-lg-8 my-lg-3'>
                    <div class="text-container" id="textContainer2">
                        <div hreflang="{{ getLang() }}" class="text-content add-read-more show-less-content">
                            @if(LaravelLocalization::getCurrentLocale()=='ar')
                                {!!  $intro->ar_content !!}
                            @else
                                {!!  $intro->content !!}
                            @endif
                        </div>
                    </div>
                    <span class="read-more-btn" onclick="toggleText('textContainer2', this)">@lang('translation.read-more+')</span>

                </div>
            </div>
        </div>

        <div class="container d-flex justify-content-center">
            <div style="margin-top:0px; margin-bottom: 40px;" class="row w-100 mx-lg-0 w-lg-90">
                <h3 class='col-lg-4 mt-3' hreflang="{{ getLang() }}">@lang('translation.vision')</h3>
                <div class='col-lg-8 my-lg-3'>
                    <div class="text-container" id="textContainer3">
                        <div hreflang="{{ getLang() }}" class="text-content add-read-more show-less-content">
                            @if(LaravelLocalization::getCurrentLocale()=='ar')
                                {!!  $vision->ar_content !!}
                            @else
                                {!!  $vision->content !!}
                            @endif
                        </div>
                    </div>
                    <span class="read-more-btn" onclick="toggleText('textContainer3', this)">@lang('translation.read-more+')</span>

                </div>
            </div>
        </div>

        <!-- The script -->
        <script>
            function toggleText(containerId, button) {
                var textContainer = document.getElementById(containerId);

                if (textContainer.style.maxHeight) {
                    textContainer.style.maxHeight = null;
                    button.innerHTML = '@lang('translation.read-more+')';
                } else {
                    textContainer.style.maxHeight = "max-content";
                    button.innerHTML = '@lang('translation.read-less-')';
                }
            }

            document.addEventListener('DOMContentLoaded', function () {
                var textContainers = document.querySelectorAll('.text-container');

                textContainers.forEach(function (textContainer) {
                    var readMoreBtn = textContainer.nextElementSibling;

                    // Check if the content is greater than 90px
                    if (textContainer.scrollHeight > textContainer.clientHeight) {
                        readMoreBtn.style.display = 'block';
                    }
                });
            });
        </script>

{{--        <script>--}}
{{--            function toggleText(containerId) {--}}
{{--                var textContainer = document.getElementById(containerId);--}}
{{--                var readMoreBtn = textContainer.nextElementSibling;--}}

{{--                if (textContainer.style.maxHeight) {--}}
{{--                    textContainer.style.maxHeight = null;--}}
{{--                    readMoreBtn.innerHTML = '@lang('translation.read-more+')';--}}
{{--                } else {--}}
{{--                    textContainer.style.maxHeight = "max-content";--}}
{{--                    readMoreBtn.innerHTML = '@lang('translation.read-less-')';--}}
{{--                }--}}
{{--            }--}}

{{--            document.addEventListener('DOMContentLoaded', function () {--}}
{{--                var textContainers = document.querySelectorAll('.text-container');--}}

{{--                textContainers.forEach(function (textContainer) {--}}
{{--                    var readMoreBtn = textContainer.nextElementSibling;--}}

{{--                    // Check if the height of the content is less than 225px--}}
{{--                    if (textContainer.clientHeight < 215) {--}}
{{--                        readMoreBtn.style.display = 'none'; // Hide the "Read more" button--}}
{{--                    } else if (textContainer.scrollHeight > textContainer.clientHeight) {--}}
{{--                        readMoreBtn.style.display = 'block';--}}
{{--                    }--}}
{{--                });--}}

{{--                // Delay the execution of the function by 100 milliseconds--}}
{{--                setTimeout(function () {--}}
{{--                    var textContainers = document.querySelectorAll('.text-container');--}}

{{--                    textContainers.forEach(function (textContainer) {--}}
{{--                        var readMoreBtn = textContainer.nextElementSibling;--}}

{{--                        // Check if the height of the content is less than 225px--}}
{{--                        if (textContainer.clientHeight < 215) {--}}
{{--                            readMoreBtn.style.display = 'none'; // Hide the "Read more" button--}}
{{--                        } else if (textContainer.scrollHeight > textContainer.clientHeight) {--}}
{{--                            readMoreBtn.style.display = 'block';--}}
{{--                        }--}}
{{--                    });--}}
{{--                }, 100);--}}
{{--            });--}}
{{--        </script>--}}

{{--        <script>--}}
{{--            function getNumberOfLines(element) {--}}
{{--                var lineHeight = parseFloat(window.getComputedStyle(element).lineHeight);--}}
{{--                var containerHeight = element.clientHeight;--}}
{{--                return Math.round(containerHeight / lineHeight);--}}
{{--            }--}}

{{--            function toggleText(containerId) {--}}
{{--                var container = document.getElementById(containerId);--}}
{{--                container.classList.toggle('expanded');--}}
{{--                var btn = container.nextElementSibling;--}}
{{--                var textContent = container.querySelector('.text-content');--}}
{{--                var lineHeight = parseFloat(window.getComputedStyle(textContent).lineHeight);--}}
{{--                var maxHeight = lineHeight * 7; // Assuming 8 lines is the limit--}}
{{--                if (container.classList.contains('expanded') || textContent.clientHeight > maxHeight) {--}}
{{--                    btn.style.display = 'none';--}}
{{--                } else {--}}
{{--                    btn.style.display = 'inline-block';--}}
{{--                }--}}
{{--                if (container.classList.contains('expanded')) {--}}
{{--                    btn.textContent = 'Read Less';--}}
{{--                } else {--}}
{{--                    btn.textContent = 'Read More';--}}
{{--                }--}}
{{--            }--}}
{{--        </script>--}}
        <div class='container-fluid blue-bg py-lg-3 py-3' style='padding-bottom: 30px;'>
            <div class="container py-5">
                <h3 style='color:#FFF;' hreflang="{{ getLang() }}">@lang('translation.objectives')</h3>
            </div>
            <div class="container obj-con">
                @foreach([$objective_1, $objective_2, $objective_3, $objective_4,$objective_5] as $obj)
                    <div style='text-align: center; padding:0px 20px'>
                        <div class="objectives-images">
                            <dotlottie-player autoplay loop
                                              src='{{asset("/img/$loop->index-icon.lottie")}}'></dotlottie-player>
                            {{--                            <img src='{{Storage::url($obj->media)}}'>--}}
                            <div class="objectives-text" hreflang="{{ getLang() }}">
                                @if(LaravelLocalization::getCurrentLocale()=='ar')
                                    {!! $obj->ar_content !!}
                                @else
                                    {!! $obj->content !!}
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
        <div class="container">
            <div class='row' style='overflow-x: scroll; padding-bottom: 80px; padding-top: 40px;'>
                <h3 hreflang="{{ getLang() }}">@lang('translation.partners')</h3>
                <div class="d-grid column partners-imgs">
                    <div class="square-holder">
                        <a href="https://business.aucegypt.edu/research/centers/a2k4d">
                            <img src="{{ asset('/img/AUCLogo_BUS_A2K4D_blueCMYK_High-01 (1).png') }}">
                        </a>
                    </div>
                    <div class="square-holder">
                        <a href="https://www.birzeit.edu/en/community-affairs/institutes-centers/center-continuing-education">
                            <img src="{{ asset('/img/BZU_CCE_Logo.jpg') }}">
                        </a>
                    </div>
                    <div class="square-holder">
                        <a href="https://idrc-crdi.ca/en">
                            <img src="{{ asset('/img/logo2.png') }}">
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!--		<div class='row menasec sec-bg' style='margin-top:25px;'>
                <div class='col-md-6'><h3>CONTACT US</h3></div>
                <form class='col-md-6'>
                    <input class='form-control' placeholder='Name' style='margin-bottom:25px;'>
                    <input class='form-control' placeholder='Email' style='margin-bottom:25px;'>
                    <textarea class='form-control' placeholder='Message'></textarea>

                </form>
            </div>
    </div>-->
    @include('layouts.footers.guest.footer')
@endsection
