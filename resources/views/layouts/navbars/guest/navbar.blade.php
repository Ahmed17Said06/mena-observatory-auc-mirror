<style>
    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%280, 0, 0, 0.85%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e") !important;
    }
</style>
<header class="container d-none d-lg-block">


    <div class='row' style='height:125px'>
        <div class='col-md-3 align-self-center'>
            <a class="navbar-brand" href="/">
                <img src='/img/logo2.svg' height='50px' style='height:50%;'>
            </a>
        </div>
        <div class='col-md-9'>
            <div class='d-flex float-end col-12 justify-content-end align-items-center' style="text-align: right;
    margin-right: 1.4rem;
    margin-top: 1rem;
    gap: 12px">
                <div class="col-4">
                    <div class="search-box">
                        <form method="GET" action="{{route('search')}}">
                            <input class="search" type="text" placeholder="Search.." name="search">
                            <button type="submit">
                                <svg width="20" height="20" viewBox="0 0 15 15" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_703_6664)">
                                        <path
                                            d="M5.80292 11.413C2.62774 11.413 0 8.91304 0 5.76087C0 2.6087 2.62774 0 5.80292 0C8.9781 0 11.6058 2.6087 11.6058 5.76087C11.6058 8.91304 8.9781 11.413 5.80292 11.413ZM5.80292 1.08696C3.17518 1.08696 1.09489 3.15217 1.09489 5.76087C1.09489 8.36957 3.17518 10.4348 5.80292 10.4348C8.43066 10.4348 10.5109 8.36957 10.5109 5.76087C10.5109 3.15217 8.32117 1.08696 5.80292 1.08696Z"
                                            fill="#FAAF1C"/>
                                        <path
                                            d="M9.68313 8.99118L8.90894 9.75977L14.2509 15.063L15.0251 14.2944L9.68313 8.99118Z"
                                            fill="#FAAF1C"/>
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
                <div style="width: fit-content" class="">
                </div>
                <div style="width: fit-content" class="">
                    <a href='{{route("collaborate")}}'>
                        <button hreflang="{{ getLang() }}"
                                class='btn btn-mena-3'>@lang('translation.collaborate')</button>
                    </a>
                </div>
                {{--            @guest--}}
                {{--                    <div style="width: fit-content" class="">--}}
                {{--                        <a href='{{route("login")}}'>--}}
                {{--                            <button class='btn btn-mena-2'>LOGIN</button>--}}
                {{--                        </a>--}}

                {{--                    </div>--}}
                {{--                    <div style="width: fit-content" class="">--}}
                {{--                        <a href='{{route("register")}}'>--}}
                {{--                            <button class='btn btn-mena-2 register'>REGISTER</button>--}}
                {{--                        </a>--}}
                {{--                    </div>--}}
                {{--                @endguest--}}
                {{--                @auth--}}
                {{--                    <div style="width: fit-content">--}}
                {{--                        <form role="form" method="post" action="{{ route('logout') }}" id="logout-form"--}}
                {{--                              style='margin:0px;'>--}}
                {{--                            @csrf--}}
                {{--                            <button href="{{ route('logout') }}"--}}
                {{--                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"--}}
                {{--                                    class='btn btn-mena-2 register'>Log out--}}
                {{--                            </button>--}}
                {{--                        </form>--}}
                {{--                    </div>--}}
                {{--                    <div style="width: fit-content" class="">--}}
                {{--                        <a href='{{route("profile")}}'>--}}
                {{--                            <button class='btn btn-mena-2'>Profile</button>--}}
                {{--                        </a>--}}
                {{--                    </div>--}}
                {{--                @endauth--}}
                <div class="language-switcher">
                    @php
                        $locales = LaravelLocalization::getSupportedLocales();
                        $totalLocales = count($locales);
                        $currentLocaleIndex = 0;
                    @endphp
                    @foreach($locales as $localeCode => $properties)
                        <a rel="alternate"
                           @if(LaravelLocalization::getCurrentLocale() === $localeCode) class="active"
                           @endif hreflang="{{ $localeCode }}"
                           href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $properties['native'] }}
                        </a>
                        @if (++$currentLocaleIndex < $totalLocales)
                            <svg xmlns="http://www.w3.org/2000/svg" width="2" height="17"
                                 viewBox="0 0 2 17" fill="none">
                                <path d="M1 0V17" stroke="#022248"/>
                            </svg>
                        @endif
                    @endforeach
                    {{--                                        <a href="#">--}}
                    {{--                                            EN--}}
                    {{--                                        </a>--}}
                    {{--                                        <svg xmlns="http://www.w3.org/2000/svg" width="2" height="17" viewBox="0 0 2 17" fill="none">--}}
                    {{--                                            <path d="M1 0V17" stroke="#022248"/>--}}
                    {{--                                        </svg>--}}
                    {{--                                        <a href="#" class="arabic">--}}
                    {{--                                            عربي--}}
                    {{--                                        </a>--}}
                </div>


                {{--    <div style="width: fit-content">--}}
                {{--        <div class="dropdown language-switcher">--}}
                {{--            <a class="dropdown-toggle" href="#" id="Dropdown" role="button" data-mdb-toggle="dropdown" aria-expanded="false">--}}
                {{--            EN--}}
                {{--            </a>--}}
                {{--            <ul class="dropdown-menu" aria-labelledby="Dropdown">--}}
                {{--                <li>--}}
                {{--                    <a class="dropdown-item" href="#">English <i class="fa fa-check text-success ms-2"></i></a>--}}
                {{--                </li>--}}
                {{--                <li><hr class="dropdown-divider" /></li>--}}
                {{--                <li>--}}
                {{--                    <a class="dropdown-item" href="#">Polski</a>--}}
                {{--                </li>--}}
                {{--                <li><hr class="dropdown-divider" /></li>--}}
                {{--            </ul>--}}
                {{--        </div>--}}
                {{--    </div>--}}
            </div>
            <div class='row col-12'>
                <nav class="navbar navbar-expand-lg navbar-light"
                     style='box-shadow:none;background-color:transparent !important;'>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl"
                         @endif hreflang="{{ getLang() }}" class="collapse navbar-collapse" style='flex-grow:0; margin-left:auto;
    box-shadow: inset 0px -1px 0px #E1E3E5;' id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item @if(str(Route::current()->getName())->contains('about_us')) active @endif">
                                <a hreflang="{{ getLang() }}" class="nav-link"
                                   href="{{route('about_us')}}">@lang('translation.about-us')
                                    <span
                                        class="sr-only">(current)</span></a>
                            </li>
                            <li class="d-flex align-items-center nav-item dropdown @if(str(Route::current()->getName())->contains('regional')) active @endif">
                                <a class="nav-link" href="{{route('regional')}}">@lang('translation.knowledge-hub')</a>
                                <i class="dropbtn fa fa-caret-down"></i>
                                <div class="dropdown-content"
                                     @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl" @endif>
                                    <a class="nav-link"
                                       href="{{route('regional.country',5)}}">@lang('translation.egypt')
                                        <span class="sr-only">(current)</span></a>
                                    <a class="nav-link"
                                       href="{{route('regional.country',7)}}">@lang('translation.jordan')
                                        <span class="sr-only">(current)</span></a>
                                    <a class="nav-link"
                                       href="{{route('regional.country',9)}}">@lang('translation.lebanon')
                                        <span class="sr-only">(current)</span></a>
                                    <a class="nav-link"
                                       href="{{route('regional.country',20)}}">@lang('translation.tunisia')
                                        <span class="sr-only">(current)</span></a>
                                    <a class="nav-link"
                                       href="{{route('regional.country',11)}}">@lang('translation.morocco')
                                        <span class="sr-only">(current)</span></a>
                                    <a class="nav-link"
                                       href="{{route('regional.country',14)}}">@lang('translation.palestine')
                                        <span class="sr-only">(current)</span></a>
                                    <a class="nav-link"
                                       href="{{route('regional.country',3)}}">@lang('translation.mena-regions')
                                        <span class="sr-only">(current)</span></a>
                                </div>
                            </li>
                            <li class="nav-item @if(str(Route::current()->getName())->contains('community')) active @endif">
                                <a class="nav-link" href="{{route('community')}}">@lang('translation.community')</a>
                            </li>
                            <li class="d-none nav-item @if(str(Route::current()->getName())->contains('news_events')) active @endif">
                                <a class="nav-link" href="{{route('news_events')}}">@lang('translation.news-events')</a>
                            </li>
                            <li class="nav-item @if(str(Route::current()->getName())->contains('blogs')) active @endif">
                                <a class="nav-link" href="{{route('blogs')}}">@lang('translation.recent-posts')</a>
                            </li>
                            <li class="nav-item @if(str(Route::current()->getName())->contains('contact_us')) active @endif">
                                <a class="nav-link" href="{{route('contact_us')}}">@lang('translation.contact-us')</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>

        </div>
    </div>
</header>
<header class="container d-flex d-lg-none p-3">
    <div class="col-6">
        <a class="navbar-brand" href="/">
            <img src='/img/logo2.svg'>
        </a>
    </div>
    <div class="col-6">
    <span style="font-size:30px;cursor:pointer;
    float: right;margin-top: 6px;color: var(--menablue);" onclick="openNav()">&#9776;</span>
        <div id="myNav" class="mobile-menu">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <div class="mobile-menu-content">
                <div class="search-box">
                    <form method="GET" action="{{route('search')}}">
                        <input class="search" type="text" placeholder="Search.." name="search">
                        <button type="submit">
                            <svg width="20" height="20" viewBox="0 0 15 15" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_703_6664)">
                                    <path
                                        d="M5.80292 11.413C2.62774 11.413 0 8.91304 0 5.76087C0 2.6087 2.62774 0 5.80292 0C8.9781 0 11.6058 2.6087 11.6058 5.76087C11.6058 8.91304 8.9781 11.413 5.80292 11.413ZM5.80292 1.08696C3.17518 1.08696 1.09489 3.15217 1.09489 5.76087C1.09489 8.36957 3.17518 10.4348 5.80292 10.4348C8.43066 10.4348 10.5109 8.36957 10.5109 5.76087C10.5109 3.15217 8.32117 1.08696 5.80292 1.08696Z"
                                        fill="#FAAF1C"/>
                                    <path
                                        d="M9.68313 8.99118L8.90894 9.75977L14.2509 15.063L15.0251 14.2944L9.68313 8.99118Z"
                                        fill="#FAAF1C"/>
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
                <div class="nav-menu">
                    <ul class="navbar-nav">
                        <li class="nav-item @if(str(Route::current()->getName())->contains('about_us')) active @endif">
                            <a class="nav-link" href="{{route('about_us')}}">@lang('translation.about-us')
                                <span
                                    class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item @if(str(Route::current()->getName())->contains('regional')) active @endif">
                            <a class="nav-link" href="{{route('regional')}}">@lang('translation.knowledge-hub')</a>
                        </li>
                        <li class="nav-item @if(str(Route::current()->getName())->contains('community')) active @endif">
                            <a class="nav-link" href="{{route('community')}}">@lang('translation.community')</a>
                        </li>
{{--                        <li class="nav-item @if(str(Route::current()->getName())->contains('news_events')) active @endif">--}}
{{--                            <a class="nav-link" href="{{route('news_events')}}">@lang('translation.news-events')</a>--}}
{{--                        </li>--}}
                        <li class="nav-item @if(str(Route::current()->getName())->contains('blogs')) active @endif">
                            <a class="nav-link" href="{{route('blogs')}}">@lang('translation.posts')</a>
                        </li>
                        <li class="nav-item @if(str(Route::current()->getName())->contains('contact_us')) active @endif">
                            <a class="nav-link" href="{{route('contact_us')}}">@lang('translation.contact-us')</a>
                        </li>
                    </ul>
                    <div class="language-switcher">
                        @php
                            $locales = LaravelLocalization::getSupportedLocales();
                            $totalLocales = count($locales);
                            $currentLocaleIndex = 0;
                        @endphp
                        @foreach($locales as $localeCode => $properties)
                            <a rel="alternate"
                               @if(LaravelLocalization::getCurrentLocale() === $localeCode) class="active"
                               @endif hreflang="{{ $localeCode }}"
                               href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                {{ $properties['native'] }}
                            </a>
{{--                            @if (++$currentLocaleIndex < $totalLocales)--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" width="2" height="17"--}}
{{--                                     viewBox="0 0 2 17" fill="none">--}}
{{--                                    <path d="M1 0V17" stroke="#022248"/>--}}
{{--                                </svg>--}}
{{--                            @endif--}}
                        @endforeach
                    </div>
                    <a href='{{route("collaborate")}}'>
                        <button hreflang="{{ getLang() }}"
                                class='btn btn-mena-3'>@lang('translation.collaborate')</button>
                    </a>

                </div>
                {{--                <div class="py-4 align-items-center justify-content-center d-flex whitespace-nowrap">--}}
                {{--                    @guest--}}
                {{--                        <div style="width: fit-content;--}}
                {{--    white-space: nowrap;" class="">--}}
                {{--                            <a href='{{route("login")}}'>--}}
                {{--                                <button class='btn btn-mena-2'>LOGIN</button>--}}
                {{--                            </a>--}}

                {{--                        </div>--}}
                {{--                        <div style="width: fit-content;--}}
                {{--    white-space: nowrap;" class="">--}}
                {{--                            <a href='{{route("login")}}'>--}}
                {{--                                <button class='btn btn-mena-2 register'>REGISTER</button>--}}
                {{--                            </a>--}}

                {{--                        </div>--}}
                {{--                    @endguest--}}
                {{--                    @auth--}}
                {{--                        <div style="width: fit-content;--}}
                {{--    white-space: nowrap;">--}}
                {{--                            <form role="form" method="post" action="{{ route('logout') }}" id="logout-form"--}}
                {{--                                  style='margin:0px;'>--}}
                {{--                                @csrf--}}
                {{--                                <button href="{{ route('logout') }}"--}}
                {{--                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"--}}
                {{--                                        class='btn btn-mena-2 register'>Log out--}}
                {{--                                </button>--}}
                {{--                            </form>--}}
                {{--                        </div>--}}
                {{--                        <div style="width: fit-content;--}}
                {{--    white-space: nowrap;" class="">--}}
                {{--                            <a href='{{route("profile")}}'>--}}
                {{--                                <button class='btn btn-mena-2'>Profile</button>--}}
                {{--                            </a>--}}

                {{--                        </div>--}}

                {{--                    @endauth--}}

                {{--                </div>--}}
            </div>
        </div>
        <script>
            function openNav() {
                document.getElementById("myNav").style.width = "100%";
            }

            function closeNav() {
                document.getElementById("myNav").style.width = "0%";
            }
        </script>
    </div>
</header>
