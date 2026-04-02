@extends('layouts.frontend.app', ['class' => 'g-sidenav-show bg-gray-100'])
<style>#map_outer { display:none !important; }</style>

@section('content')
    @include('layouts.navbars.guest.navbar', ['title' => 'Webinars'])

    <div class="container my-4 my-lg-5" @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl" @endif>
        <div class="row mb-4">
            <div class="col-12">
                <h2 style="color:#022448; font-weight:800; margin-bottom:0.25rem;">Webinars</h2>
                <div style="width:40px; height:3px; background:#c8870a; border-radius:2px; margin-bottom:0.75rem;"></div>
                <p style="color:#6b7280;">Webinars and online sessions from the MENA Observatory on Responsible AI.</p>
            </div>
        </div>

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

    @include('layouts.footers.guest.footer')

    <style>
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
