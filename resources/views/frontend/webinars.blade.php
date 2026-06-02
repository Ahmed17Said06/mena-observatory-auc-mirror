@extends('layouts.frontend.app', ['class' => 'g-sidenav-show bg-gray-100'])
<style>#map_outer { display:none !important; }</style>

@section('content')
    @include('layouts.navbars.guest.navbar', ['title' => 'Webinars'])

    <div class="wb-page" @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl" @endif>

        {{-- ═══ HERO ═══ --}}
        <div class="wb-hero">
            <div class="wb-hero-overlay"></div>
            <div class="container wb-hero-content">
                <h1 class="wb-hero-title">@lang('translation.talks-webinars')</h1>
                <p class="wb-hero-sub">Webinars, talks and online sessions from the MENA Observatory on Responsible AI.</p>
            </div>
            <div class="wb-hero-wave">
                <svg viewBox="0 0 1440 70" preserveAspectRatio="none">
                    <path fill="#f5f6f8" d="M0,35 C480,65 960,10 1440,40 L1440,70 L0,70 Z" opacity="0.5"/>
                    <path fill="#f5f6f8" d="M0,45 C360,65 900,20 1440,45 L1440,70 L0,70 Z"/>
                </svg>
            </div>
        </div>

        <div class="container my-4 my-lg-5">

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
                                @if((LaravelLocalization::getCurrentLocale() === 'ar' && $video->ar_description) || $video->description)
                                    <p class="video-description">
                                        {{ LaravelLocalization::getCurrentLocale() === 'ar' && $video->ar_description ? $video->ar_description : $video->description }}
                                    </p>
                                @endif
                                <a href="{{ $video->youtube_url }}" target="_blank" rel="noopener noreferrer" class="video-link">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                        <path d="M10 6H6C4.89543 6 4 6.89543 4 8V18C4 19.1046 4.89543 20 6 20H16C17.1046 20 18 19.1046 18 18V14M14 4H20M20 4V10M20 4L10 14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    Watch on YouTube
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5" style="color:#9ca3af;">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                     style="margin-bottom:1rem; opacity:.4;">
                    <path d="M15 10L19.5528 7.72361C20.2177 7.39116 21 7.87465 21 8.61803V15.382C21 16.1253 20.2177 16.6088 19.5528 16.2764L15 14M5 18H13C14.1046 18 15 17.1046 15 16V8C15 6.89543 14.1046 6 13 6H5C3.89543 6 3 6.89543 3 8V16C3 17.1046 18 5 18Z"/>
                </svg>
                <h5>No webinars available yet.</h5>
            </div>
        @endif

        {{-- Also show Repo items tagged Webinar --}}
        @if($repoWebinars->count() > 0)
            <div class="mt-5">
                <h4 style="color:#022448; font-weight:700; margin-bottom:1rem; border-bottom:2px solid #e5e7eb; padding-bottom:.5rem;">
                    Related Resources
                </h4>
                @foreach($repoWebinars as $r)
                    <article class="trl-card mb-3">
                        <div class="p-3">
                            <h5 class="mb-1" style="font-size:1rem; font-weight:700; color:#022248;">
                                <a href="{{ route('repo.single', $r->id) }}" style="color:inherit; text-decoration:none;">
                                    {{ $r->title }}
                                </a>
                            </h5>
                            @if($r->description)
                                <p class="mb-1" style="font-size:0.88rem; color:#6b7280;">
                                    {{ \Illuminate\Support\Str::limit($r->description, 160) }}
                                </p>
                            @endif
                            <a href="{{ route('repo.single', $r->id) }}"
                               style="font-size:0.85rem; color:#c8870a; font-weight:600; text-decoration:none;">
                                View →
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
        </div>
    </div>

    @include('layouts.footers.guest.footer')

    <style>
        .wb-page {
            background: #f5f6f8;
            min-height: 100vh;
        }

        .wb-hero {
            position: relative;
            background: linear-gradient(135deg, #022248 0%, #0a4a6e 50%, #c8870a 100%);
            background-size: 300% 300%;
            animation: wb-grad 12s ease infinite;
            padding: 3.5rem 0 0;
            overflow: hidden;
        }

        @keyframes wb-grad {
            0%   { background-position: 0% 50%; }
            50%  { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .wb-hero-overlay {
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at 70% 40%, rgba(250,175,28,.25) 0%, transparent 65%);
            pointer-events: none;
        }

        .wb-hero-content {
            position: relative;
            z-index: 2;
            padding-bottom: 3rem;
        }

        .wb-hero-title {
            font-size: clamp(1.8rem, 4vw, 2.6rem);
            font-weight: 800;
            color: #fff;
            margin: 0 0 .6rem;
            letter-spacing: -.01em;
            line-height: 1.2;
        }

        .wb-hero-sub {
            font-size: 1rem;
            color: rgba(255,255,255,.78);
            margin: 0;
            max-width: 620px;
        }

        .wb-hero-wave {
            position: relative;
            z-index: 2;
            line-height: 0;
            margin-top: -1px;
        }

        .wb-hero-wave svg {
            display: block;
            width: 100%;
            height: 70px;
        }

        @media (max-width: 767px) {
            .wb-hero { padding-top: 2.5rem; }
            .wb-hero-title { font-size: 1.6rem; }
        }

        .video-card {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0,0,0,.08);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .video-card:hover { transform: translateY(-4px); box-shadow: 0 8px 28px rgba(0,0,0,.13); }
        .video-wrapper {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
        }
        .video-wrapper iframe {
            position: absolute; top:0; left:0; width:100%; height:100%;
        }
        .video-info { padding: 1.25rem; }
        .video-title { font-size: 1rem; font-weight: 700; color: #022448; margin-bottom: 0.5rem; }
        .video-description { font-size: 0.9rem; color: #6b7280; line-height: 1.6; margin-bottom: 0.75rem; }
        .video-link { font-size: 0.85rem; color: #c8870a; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 5px; }
        .video-link:hover { color: #a86f08; }
        .trl-card { background:#fff; border-radius:10px; border:1px solid #e5e7eb; overflow:hidden; transition:box-shadow 0.2s; }
        .trl-card:hover { box-shadow: 0 4px 20px rgba(2,36,72,.10); }
    </style>
@endsection
