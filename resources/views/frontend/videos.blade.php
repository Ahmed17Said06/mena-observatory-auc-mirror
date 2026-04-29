@extends('layouts.frontend.app', ['class' => 'g-sidenav-show bg-gray-100'])
<style>
    #map_outer {
        display: none !important;
    }
</style>
@section('content')
    @include('layouts.navbars.guest.navbar', ['title' => 'Videos'])

    <div class="vd-page" @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl" @endif>

        {{-- ═══ HERO ═══ --}}
        <div class="vd-hero">
            <div class="vd-hero-overlay"></div>
            <div class="container vd-hero-content">
                <h1 class="vd-hero-title">@lang('translation.videos')</h1>
                <p class="vd-hero-sub">@lang('translation.videos-subtitle')</p>
            </div>
            <div class="vd-hero-wave">
                <svg viewBox="0 0 1440 70" preserveAspectRatio="none">
                    <path fill="#f5f6f8" d="M0,35 C480,65 960,10 1440,40 L1440,70 L0,70 Z" opacity="0.5"/>
                    <path fill="#f5f6f8" d="M0,45 C360,65 900,20 1440,45 L1440,70 L0,70 Z"/>
                </svg>
            </div>
        </div>

        <div class="container my-3 my-lg-5">

        @if($videos->count() > 0)
            <div class="row g-4">
                @foreach($videos as $video)
                    <div class="col-lg-6 col-md-6 mb-4">
                        <div class="video-card">
                            <div class="video-wrapper">
                                <iframe
                                    src="{{ $video->embed_url }}"
                                    title="{{ LaravelLocalization::getCurrentLocale() === 'ar' && $video->ar_title ? $video->ar_title : $video->title }}"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen
                                ></iframe>
                            </div>
                            <div class="video-info">
                                <h3 class="video-title">
                                    @if(LaravelLocalization::getCurrentLocale() === 'ar' && $video->ar_title)
                                        {{ $video->ar_title }}
                                    @else
                                        {{ $video->title }}
                                    @endif
                                </h3>
                                @if((LaravelLocalization::getCurrentLocale() === 'ar' && $video->ar_description) || (LaravelLocalization::getCurrentLocale() !== 'ar' && $video->description))
                                    <p class="video-description">
                                        @if(LaravelLocalization::getCurrentLocale() === 'ar' && $video->ar_description)
                                            {{ $video->ar_description }}
                                        @else
                                            {{ $video->description }}
                                        @endif
                                    </p>
                                @endif
                                <a href="{{ $video->youtube_url }}" target="_blank" rel="noopener noreferrer" class="video-link">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                        <path d="M10 6H6C4.89543 6 4 6.89543 4 8V18C4 19.1046 4.89543 20 6 20H16C17.1046 20 18 19.1046 18 18V14M14 4H20M20 4V10M20 4L10 14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    @lang('translation.watch-on-youtube')
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" style="color: #d1d5db; margin-bottom: 1rem;">
                    <path d="M15 10L19.5528 7.72361C20.2177 7.39116 21 7.87465 21 8.61803V15.382C21 16.1253 20.2177 16.6088 19.5528 16.2764L15 14M5 18H13C14.1046 18 15 17.1046 15 16V8C15 6.89543 14.1046 6 13 6H5C3.89543 6 3 6.89543 3 8V16C3 17.1046 3.89543 18 5 18Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <h4 style="color: #6b7280;">@lang('translation.no-videos')</h4>
            </div>
        @endif
        </div>
    </div>

    @include('layouts.footers.guest.footer')

    <style>
        .vd-page { background: #f5f6f8; min-height: 100vh; }
        .vd-hero {
            position: relative;
            background: linear-gradient(135deg, #022248 0%, #0a4a6e 50%, #c8870a 100%);
            background-size: 300% 300%;
            animation: vd-grad 12s ease infinite;
            padding: 3.5rem 0 0;
            overflow: hidden;
        }
        @keyframes vd-grad {
            0%   { background-position: 0% 50%; }
            50%  { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .vd-hero-overlay {
            position: absolute; inset: 0;
            background: radial-gradient(ellipse at 70% 40%, rgba(250,175,28,.25) 0%, transparent 65%);
            pointer-events: none;
        }
        .vd-hero-content { position: relative; z-index: 2; padding-bottom: 3rem; }
        .vd-hero-title {
            font-size: clamp(1.8rem, 4vw, 2.6rem);
            font-weight: 800; color: #fff; margin: 0 0 .6rem;
            letter-spacing: -.01em; line-height: 1.2;
        }
        .vd-hero-sub {
            font-size: 1rem;
            color: rgba(255,255,255,.78);
            margin: 0; max-width: 620px;
        }
        .vd-hero-wave { position: relative; z-index: 2; line-height: 0; margin-top: -1px; }
        .vd-hero-wave svg { display: block; width: 100%; height: 70px; }
        @media (max-width: 767px) {
            .vd-hero { padding-top: 2.5rem; }
            .vd-hero-title { font-size: 1.6rem; }
        }

        .video-card {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            border: 1px solid #f3f4f6;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .video-card:hover {
            box-shadow: 0 12px 32px rgba(0,0,0,0.15);
            transform: translateY(-4px);
        }

        .video-wrapper {
            position: relative;
            width: 100%;
            padding-top: 56.25%; /* 16:9 aspect ratio */
            background: #000;
        }

        .video-wrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .video-info {
            padding: 1.25rem 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .video-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1a1a2e;
            margin-bottom: 0.5rem;
            line-height: 1.4;
        }

        .video-description {
            color: #6b7280;
            font-size: 0.9rem;
            line-height: 1.6;
            margin-bottom: 1rem;
            flex: 1;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .video-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: #FAAF1C;
            font-weight: 600;
            font-size: 0.875rem;
            text-decoration: none;
            transition: all 0.2s ease;
            margin-top: auto;
        }

        .video-link:hover {
            color: #e89d0f;
            transform: translateX(3px);
        }

        .page-title {
            font-size: 2rem;
        }

        @media (max-width: 768px) {
            .video-card {
                margin-bottom: 1rem;
            }
            .page-title {
                font-size: 1.5rem;
            }
        }
    </style>
@endsection
