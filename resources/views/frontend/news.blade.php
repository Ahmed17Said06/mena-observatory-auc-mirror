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
            <h3>@lang('translation.news-heading')</h3>

            {{-- Main searchable news feed (continues the NEWS section) --}}
            <livewire:all-news />

            {{-- ─────────────── GLOBAL AI NEWS ─────────────── --}}
            @if(isset($globalAiNews) && $globalAiNews->count())
                <div class="col-12 mb-4">
                    <h3 @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl" @endif
                        style="color:#022448; font-weight:700; border-bottom:2px solid #e5e7eb; padding-bottom:.5rem; margin-bottom:1.5rem;">
                        {{ tr('Global AI News','أخبار الذكاء الاصطناعي العالمية') }}
                    </h3>
                    <div class="flex-column flex-md-row"
                        style="display: flex; flex-wrap: wrap; align-content: center; padding-bottom: 20px;">
                        @foreach($globalAiNews as $n)
                            @php
                                $gimg = $n->image
                                    ? (\Illuminate\Support\Str::startsWith($n->image, ['http://','https://']) ? $n->image : Storage::url($n->image))
                                    : '/img/card-placeholder.svg';
                            @endphp
                            <div class="post-container lazy-item">
                                <a href="{{ $n->data_link }}" target="_blank" rel="noopener">
                                    <div class="post-loop-events position-relative overflow-hidden">
                                        <img class="post-img" src="{{ $gimg }}" alt="{{ $n->title }}"
                                             onerror="this.onerror=null;this.src='/img/card-placeholder.svg'">
                                        <div class="post-content" lang="en">
                                            <h4 style='color:#FFF;' class='slide_title'>{{ $n->title }}</h4>
                                            <p style='color:#FFF;' class='slide_description'>
                                                {{ $n->description }}@if($n->date) · {{ \Carbon\Carbon::parse($n->date)->format('M d, Y') }}@endif
                                            </p>
                                            <button class='btn learn_more'><i class="fas fa-external-link-alt"></i> {{ tr('Read Article','اقرأ المقال') }}</button>
                                        </div>
                                        <div class="overlay-1"></div>
                                        <div class="overlay-news"></div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- ─────────────── EVENTS SECTION ─────────────── --}}
            {{-- (events-section renders its own "Events" heading, so none here to avoid a duplicate) --}}
            <div class="col-12 mt-5">
                <livewire:events-section />
            </div>

        </div>
    </div>

    @include('layouts.footers.guest.footer')
@endsection