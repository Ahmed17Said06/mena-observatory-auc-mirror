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
                    {{-- Static Egypt Knowledge Hub Entries (only for Egypt, country_id = 5) --}}
                    @if($country->id == 5)
                    <div class='row my-3'>
                        <div class='col-lg-9'>
                            <h4 class="mb-4" style="color: #1a1a2e;">Featured Policy Briefs</h4>
                            
                            {{-- Entry 1: Women Informal Digital Entrepreneurs 2025 --}}
                            <article class='result-card' style="background: #fff; border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.06); border: 1px solid #f3f4f6;">
                                <div class='row g-3'>
                                    <div class='col-lg-12'>
                                        <div class="result-content">
                                            <a href="{{ asset('storage/UruWZb5OPVKOk88XSU7KzQbp2Gswyg-metaQTJLNEQgeCBGRVMgUG9saWN5IEJyaWVmLSBBdWd1c3QgMjAyNS5wZGY=-.pdf') }}" target="_blank" rel="noopener noreferrer" class="result-title" style="font-size: 1.25rem; font-weight: 700; color: #111827; text-decoration: none; display: block; margin-bottom: 0.75rem;">
                                                Women Informal Digital Entrepreneurs in Egypt - Skills Development and Capacity Building
                                            </a>
                                            <p class="result-description" style="color: #6b7280; font-size: 0.938rem; line-height: 1.6;">
                                                Policy Brief (2025) - A2K4D x FES. This policy brief explores skills development and capacity building for women informal digital entrepreneurs in Egypt.
                                            </p>
                                        </div>
                                        <div class="result-actions" style="display: flex; gap: 0.75rem; flex-wrap: wrap; margin-top: 1rem;">
                                            <a class="download-button" href="{{ asset('storage/UruWZb5OPVKOk88XSU7KzQbp2Gswyg-metaQTJLNEQgeCBGRVMgUG9saWN5IEJyaWVmLSBBdWd1c3QgMjAyNS5wZGY=-.pdf') }}" target="_blank" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.625rem 1.125rem; background: #fff; border: 2px solid #e5e7eb; border-radius: 8px; color: #374151; font-weight: 600; font-size: 0.875rem; text-decoration: none;">
                                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                                    <path d="M21 15V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V15M7 10L12 15M12 15L17 10M12 15V3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                                <span>Download PDF</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            
                            {{-- Entry 2: Women and Work Policy Brief 2023 --}}
                            <article class='result-card' style="background: #fff; border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.06); border: 1px solid #f3f4f6;">
                                <div class='row g-3'>
                                    <div class='col-lg-12'>
                                        <div class="result-content">
                                            <a href="https://egypt.fes.de/fileadmin/user_upload/documents/publication/A2K4DxFES_Policy_Brief_2023_EN.pdf" target="_blank" rel="noopener noreferrer" class="result-title" style="font-size: 1.25rem; font-weight: 700; color: #111827; text-decoration: none; display: block; margin-bottom: 0.75rem;">
                                                Women and Work in Egypt's Informal Digital Economy
                                            </a>
                                            <p class="result-description" style="color: #6b7280; font-size: 0.938rem; line-height: 1.6;">
                                                Policy Brief (2023) - A2K4D x FES. This policy brief examines women's participation and work conditions in Egypt's informal digital economy.
                                            </p>
                                        </div>
                                        <div class="result-actions" style="display: flex; gap: 0.75rem; flex-wrap: wrap; margin-top: 1rem;">
                                            <a class="download-button" href="https://egypt.fes.de/fileadmin/user_upload/documents/publication/A2K4DxFES_Policy_Brief_2023_EN.pdf" target="_blank" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.625rem 1.125rem; background: #fff; border: 2px solid #e5e7eb; border-radius: 8px; color: #374151; font-weight: 600; font-size: 0.875rem; text-decoration: none;">
                                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                                    <path d="M21 15V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V15M7 10L12 15M12 15L17 10M12 15V3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                                <span>Download PDF</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                    @endif
                    {{-- End Static Egypt Knowledge Hub Entries --}}
                    
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
