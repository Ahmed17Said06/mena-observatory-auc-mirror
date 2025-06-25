@extends('layouts.frontend.app', ['class' => 'g-sidenav-show bg-gray-100'])
<style>

    #map_outer {
        display: none !important;
    }
</style>
<!--<img src="https://demobasics.pixienop.net/img/tweetcarts/fallingsand.gif" width='100%' style='z-index:99;position:absolute;top:0;left:0;'>-->
@section('content')
    @include('layouts.navbars.guest.navbar', ['title' => 'Dashboard'])
    <div class="container my-3 my-lg-5" id="country">
        <div class='row'>
            @if(getLang()=='en')
                <h3>{{$country->name}}</h3>
            @else
                <h3>{{$country->ar_name}}</h3>
            @endif
            <div class="w-100 d-flex justify-content-center">
                {{--                <img class="country-img" src="/images/countries/{{$country->id}}.svg">--}}
                @if($country->id===3)
                    {{--                            <img src="{{asset('/img/Group 2070.png')}}">--}}
                    <div class="position-relative map_content">
                        <div class="map_container">
                            <div style='margin-top:10%;' id="map">
                            </div>
                        </div>
                    </div>
                @else
                    <script
                        src="https://unpkg.com/@dotlottie/player-component@1.0.0/dist/dotlottie-player.js"></script>
                    <dotlottie-player autoplay loop src="/images/countries/{{$country->id}}.lottie"
                                      class="country-img"></dotlottie-player>
                @endif
            </div>
        </div>
    </div>
    @if(getLang()=='ar')
        @if(!empty($country->ar_intro) || !empty($country->ar_right_intro))
            <div class="container-lg-fluid bg-gray" hreflang="{{ getLang() }}" dir="rtl">
                <div class="container py-3 py-lg-5">
                    <div class="d-flex flex-column gap-3">
                        <div id="textContainer" class="text-container">
                            <div class="row">
                                <div class="col-lg-9 text-break">
                                    <div class="text-content add-read-more show-less-content left"
                                         hreflang="{{ getLang() }}">
                                        {!! $country->ar_intro !!}
                                    </div>
                                </div>
                                <div class="col-lg-3 text-break">
                                    <div class="text-content right hreflang="{{ getLang() }}"">
                                    {!! $country->ar_right_intro !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <span hreflang="{{ getLang() }}" class="read-more-btn"
                          onclick="toggleText()">@lang('translation.read-more+')</span>

                </div>
                {{--            <script>--}}
                {{--                function AddReadMore() {--}}
                {{--                    // This limit you can set after how much characters you want to show Read More.--}}
                {{--                    var charLimit = 200;--}}
                {{--                    // Text to show when text is collapsed--}}
                {{--                    var readMoreTxt = "+ READ MORE";--}}
                {{--                    // Text to show when text is expanded--}}
                {{--                    var readLessTxt = "- READ LESS";--}}

                {{--                    // Traverse all selectors with this class and manipulate HTML part to show Read More--}}
                {{--                    $(".add-read-more").each(function () {--}}
                {{--                        if ($(this).find(".first-section").length)--}}
                {{--                            return;--}}

                {{--                        var allStr = $(this).text();--}}
                {{--                        if (allStr.length > charLimit) {--}}
                {{--                            var firstSet = allStr.substring(0, charLimit);--}}
                {{--                            var lastSpace = firstSet.lastIndexOf(" ");--}}
                {{--                            var firstPart = allStr.substring(0, lastSpace);--}}
                {{--                            var secondPart = allStr.substring(lastSpace + 1, allStr.length);--}}
                {{--                            var strToAdd = firstPart + "<span class='second-section'>" + secondPart + "</span><span class='read-more'  title='Click to Show More'>" + readMoreTxt + "</span><span class='read-less' title='Click to Show Less'>" + readLessTxt + "</span>";--}}
                {{--                            $(this).html(strToAdd);--}}
                {{--                        }--}}
                {{--                    });--}}

                {{--                    // Read More and Read Less Click Event binding--}}
                {{--                    $(document).on("click", ".read-more,.read-less", function () {--}}
                {{--                        $(this).closest(".add-read-more").toggleClass("show-less-content show-more-content");--}}
                {{--                    });--}}
                {{--                }--}}

                {{--                AddReadMore();--}}
                {{--            </script>--}}

                @endif
                @else
                    @if(!empty($country->intro) || !empty($country->right_intro))
                        <div class="container-lg-fluid bg-gray" hreflang="{{ getLang() }}"
                             @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl"
                            @endif>
                            <div class="container py-3 py-lg-5">
                                <div class="d-flex flex-column gap-3">
                                    <div id="textContainer" class="text-container">
                                        <div class="row">
                                            <div class="col-lg-9 text-break">
                                                <div class="text-content add-read-more show-less-content left"
                                                     hreflang="{{ getLang() }}">
                                                    {!! $country->intro !!}
                                                </div>
                                            </div>
                                            <div class="col-lg-3 text-break">
                                                <div class="text-content right" hreflang="{{ getLang() }}">
                                                    {!! $country->right_intro !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <span hreflang="{{ getLang() }}" class="read-more-btn"
                                          onclick="toggleText()">@lang('translation.read-more+')</span>
                                    {{--                        <script>--}}
                                    {{--                            function AddReadMore() {--}}
                                    {{--                                // This limit you can set after how much characters you want to show Read More.--}}
                                    {{--                                var charLimit = 865;--}}
                                    {{--                                // Text to show when text is collapsed--}}
                                    {{--                                var readMoreTxt = "+ READ MORE";--}}
                                    {{--                                // Text to show when text is expanded--}}
                                    {{--                                var readLessTxt = "- READ LESS";--}}

                                    {{--                                // Traverse all selectors with this class and manipulate HTML part to show Read More--}}
                                    {{--                                $(".add-read-more").each(function () {--}}
                                    {{--                                    if ($(this).find(".first-section").length)--}}
                                    {{--                                        return;--}}

                                    {{--                                    var allStr = $(this).text();--}}
                                    {{--                                    if (allStr.length > charLimit) {--}}
                                    {{--                                        var firstSet = allStr.substring(0, charLimit);--}}
                                    {{--                                        var lastSpace = firstSet.lastIndexOf(" ");--}}
                                    {{--                                        var firstPart = allStr.substring(0, lastSpace);--}}
                                    {{--                                        var secondPart = allStr.substring(lastSpace + 1, allStr.length);--}}
                                    {{--                                        var strToAdd = firstPart + "<span class='second-section'>" + secondPart + "</span><span class='read-more'  title='Click to Show More'>" + readMoreTxt + "</span><span class='read-less' title='Click to Show Less'>" + readLessTxt + "</span>";--}}
                                    {{--                                        $(this).html(strToAdd);--}}
                                    {{--                                    }--}}
                                    {{--                                });--}}

                                    {{--                                // Read More and Read Less Click Event binding--}}
                                    {{--                                $(document).on("click", ".read-more,.read-less", function () {--}}
                                    {{--                                    $(this).closest(".add-read-more").toggleClass("show-less-content show-more-content");--}}
                                    {{--                                });--}}
                                    {{--                            }--}}

                                    {{--                            AddReadMore();--}}
                                    {{--                        </script>--}}

                                </div>
                            </div>
                        </div>
                    @endif
                @endif
                <script>
                    function toggleText() {
                        var textContainer = document.getElementById('textContainer');
                        var readMoreBtn = document.querySelector('.read-more-btn');
                        if (textContainer.style.maxHeight) {
                            textContainer.style.maxHeight = null;
                            readMoreBtn.innerHTML = '@lang('translation.read-more+')';
                        } else {
                            textContainer.style.maxHeight = "max-content";
                            readMoreBtn.innerHTML = '@lang('translation.read-less-')';
                        }
                    }

                    document.addEventListener('DOMContentLoaded', function () {
                        var textContainer = document.getElementById('textContainer');
                        var readMoreBtn = document.querySelector('.read-more-btn');

                        // Check if the content is greater than 90px
                        if (textContainer.scrollHeight > textContainer.clientHeight) {
                            readMoreBtn.style.display = 'block';
                        }
                    });
                </script>

                <div class="container my-3 my-lg-5">
                    <!-- Replace the existing repos section with Livewire component -->
                    <livewire:country-repo-list :country_id="$country->id" />
                </div>

                @include('layouts.footers.guest.footer')

                <!-- Remove the old AJAX script -->
                {{-- 
                <script>
                    function repos_page_change(page = 0) {
                        $.ajax('{{route("regional.html_list", ["country_id" => $country->id])}}', {
                            dataType: 'json',
                            success: function (data, status, xhr) {
                                $('#repos').html(data.html);
                            }
                        })
                    }

                    repos_page_change();
                </script>
                --}}
            @endsection
