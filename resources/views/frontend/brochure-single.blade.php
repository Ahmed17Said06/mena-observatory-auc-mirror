@extends('layouts.frontend.app', ['class' => 'g-sidenav-show bg-gray-100'])

@push('header')
    {{-- Open Graph / Social Media Meta Tags --}}
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ $brochure->title }}" />
    <meta property="og:description" content="{{ $brochure->description ?? '' }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    @if($brochure->image)
        <meta property="og:image" content="{{ Storage::url($brochure->image) }}" />
        <meta property="og:image:width" content="1200" />
        <meta property="og:image:height" content="630" />
    @endif
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $brochure->title }}" />
    <meta name="twitter:description" content="{{ $brochure->description ?? '' }}" />
    @if($brochure->image)
        <meta name="twitter:image" content="{{ Storage::url($brochure->image) }}" />
    @endif
    <title>{{ $brochure->title }} — MENA AI Observatory</title>
@endpush

<style>
    .brochure-hero {
        background: #f8f9fb;
        padding: 60px 0 40px;
        border-bottom: 1px solid #e8eaed;
    }
    .brochure-hero h1 {
        color: #022448;
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 12px;
    }
    .brochure-cover {
        width: 100%;
        max-height: 420px;
        object-fit: cover;
        border-radius: 10px;
        box-shadow: 0 4px 24px rgba(2,36,72,0.12);
        display: block;
        margin-bottom: 28px;
    }
    .brochure-description {
        color: #555;
        font-size: 1.05rem;
        line-height: 1.7;
        margin-bottom: 24px;
    }
    .brochure-download-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #c8870a;
        color: #fff;
        border: none;
        padding: 12px 28px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 1rem;
        text-decoration: none;
        transition: background 0.2s;
        margin-bottom: 36px;
    }
    .brochure-download-btn:hover {
        background: #a86f08;
        color: #fff;
        text-decoration: none;
    }
    .brochure-content {
        font-size: 1rem;
        line-height: 1.8;
        color: #333;
        padding-top: 8px;
    }
    .brochure-content img {
        max-width: 100%;
        height: auto;
        border-radius: 6px;
    }
</style>

@section('content')
    @include('layouts.navbars.guest.navbar', ['title' => $brochure->title])

    <div class="brochure-hero">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <h1>
                        @if(LaravelLocalization::getCurrentLocale() === 'ar' && $brochure->ar_title)
                            {{ $brochure->ar_title }}
                        @else
                            {{ $brochure->title }}
                        @endif
                    </h1>
                    @php
                        $desc = LaravelLocalization::getCurrentLocale() === 'ar' && $brochure->ar_description
                            ? $brochure->ar_description
                            : $brochure->description;
                    @endphp
                    @if($desc)
                        <p class="brochure-description">{{ $desc }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @if($brochure->image)
                    <img src="{{ Storage::url($brochure->image) }}"
                         alt="{{ $brochure->title }}"
                         class="brochure-cover">
                @endif

                @if($brochure->pdf_file)
                    <a href="{{ Storage::url($brochure->pdf_file) }}"
                       target="_blank"
                       class="brochure-download-btn">
                        <i class="fas fa-file-pdf"></i>
                        Download PDF
                    </a>
                @endif

                @php
                    $bodyContent = LaravelLocalization::getCurrentLocale() === 'ar' && $brochure->ar_content
                        ? $brochure->ar_content
                        : $brochure->content;
                @endphp

                @if($bodyContent)
                    <div class="brochure-content"
                         @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl" @endif>
                        {!! $bodyContent !!}
                    </div>
                @endif

            </div>
        </div>
    </div>

    @include('layouts.footers.guest.footer')
@endsection
