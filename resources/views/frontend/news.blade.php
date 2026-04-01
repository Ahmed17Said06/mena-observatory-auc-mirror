@extends('layouts.frontend.app', ['class' => 'g-sidenav-show bg-gray-100'])
<style>
    #map_outer {
        display: none !important;
    }

    #blogs_pagination nav:first-child div:first-child,
    #blogs_pagination nav:first-child div:first-child {
        display: none;
    }

    #blogs_pagination,
    #blogs_pagination {
        text-align: center;
    }

    .overlay {
        position: absolute;
        /* Sit on top of the page content */
        width: 90%;
        /* Full width (cover the whole page) */
        height: 90%;
        /* Full height (cover the whole page) */
        top: 10%;
        left: 10%;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        /* Black background with opacity */
        z-index: 0;
        /* Specify a stack order in case you're using a different order for other elements */
    }
</style>
<!--<img src="https://demobasics.pixienop.net/img/tweetcarts/fallingsand.gif" width='100%' style='z-index:99;position:absolute;top:0;left:0;'>-->
@section('content')
    @include('layouts.navbars.guest.navbar', ['title' => 'Dashboard'])
    <div class="container">

        <div class='row'>
            <h3>News</h3>

            {{-- Static News Items --}}
            <div class="col-12 mb-4">
                <div class="flex-column flex-md-row"
                    style="display: flex; flex-wrap: wrap; align-content: center; padding-bottom: 20px;">

                    {{-- News 1: Final Call for Submissions --}}
                    <div class="post-container lazy-item">
                        <div class="post-loop-events position-relative overflow-hidden">
                            <img class="post-img" src="/img/placeholder-featured.jpg"
                                alt="Open Call for Applied Inclusive AI Solutions">
                            <div class="post-content" lang="en">
                                <h4 style='color:#FFF;' class='slide_title'>Final Call for Submissions Open Call for Applied
                                    Inclusive AI Solutions – MENA Region</h4>
                                <p style='color:#FFF;' class='slide_description'>This is the final reminder to submit
                                    proposals to the Open Call launched by the MENA Observatory on Responsible AI at A2K4D.
                                </p>
                                <a href='{{route("news.open-call-ai-solutions")}}'>
                                    <button class='btn learn_more'><i class="fas fa-plus"></i> Learn More</button>
                                </a>
                            </div>
                            <div class="overlay-1"></div>
                            <div class="overlay-news"></div>
                        </div>
                    </div>

                    {{-- News 2: Open Call for Responsible AI Use Cases --}}
                    <div class="post-container lazy-item">
                        <div class="post-loop-events position-relative overflow-hidden">
                            <img class="post-img" src="/img/placeholder-featured.jpg"
                                alt="Open Call for Responsible AI Use Cases">
                            <div class="post-content" lang="en">
                                <h4 style='color:#FFF;' class='slide_title'>Open Call for Responsible AI Use Cases - MENA
                                    Region</h4>
                                <p style='color:#FFF;' class='slide_description'>The MENA Observatory on Responsible AI is
                                    seeking proposals for practical, responsible AI solutions.</p>
                                <a href='{{route("news.open-call-rai-use-cases")}}'>
                                    <button class='btn learn_more'><i class="fas fa-plus"></i> Learn More</button>
                                </a>
                            </div>
                            <div class="overlay-1"></div>
                            <div class="overlay-news"></div>
                        </div>
                    </div>

                    {{-- News 3: Nagla Rizk Le Monde Article --}}
                    <div class="post-container lazy-item">
                        <div class="post-loop-events position-relative overflow-hidden">
                            <img class="post-img" src="/img/placeholder-featured.jpg" alt="Nagla Rizk Le Monde Article">
                            <div class="post-content" lang="en">
                                <h4 style='color:#FFF;' class='slide_title'>Nagla Rizk Contributes to Le Monde article on
                                    Education and AI Equity</h4>
                                <p style='color:#FFF;' class='slide_description'>AI could be a powerful lever to reduce
                                    inequalities between different socio-cultural backgrounds.</p>
                                <a href='https://www.lemonde.fr/idees/article/2025/10/29/l-ia-pourrait-representer-un-puissant-levier-pour-reduire-les-inegalites-entre-differents-milieux-socioculturels_6650132_3232.html'
                                    target="_blank">
                                    <button class='btn learn_more'><i class="fas fa-plus"></i> Read Article</button>
                                </a>
                            </div>
                            <div class="overlay-1"></div>
                            <div class="overlay-news"></div>
                        </div>
                    </div>

                </div>
            </div>
            {{-- End Static News Items --}}

            <livewire:all-news />
        </div>
    </div>

    @include('layouts.footers.guest.footer')
@endsection