@extends('layouts.frontend.app', ['class' => 'g-sidenav-show bg-gray-100'])
<style>
    #map_outer {
        display: none !important;
    }
</style>
@section('content')
    @include('layouts.navbars.guest.navbar', ['title' => 'Dashboard'])

    @if (is_null($isOurWork) && !isset($filterTag))
        {{-- ═══════════════════════════════════════════════ --}}
        {{-- KNOWLEDGE HUB — LANDING PAGE                   --}}
        {{-- ═══════════════════════════════════════════════ --}}
        <div class="kh-page" @if (LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl" @endif>

            {{-- Hero --}}
            <div class="kh-hero">
                <div class="container">
                    <span class="kh-label">
                        @if (LaravelLocalization::getCurrentLocale() == 'ar') مركز المعرفة @else Knowledge Hub @endif
                    </span>
                    <h1 class="kh-title" hreflang="{{ getLang() }}">
                        @if (LaravelLocalization::getCurrentLocale() == 'ar')
                            استكشف أبحاثنا ومواردنا
                        @else
                            Explore Our Research &amp; Resources
                        @endif
                    </h1>
                    <div class="kh-rule"></div>
                    {{-- @if ($intro)
                        <p class="kh-intro" hreflang="{{ getLang() }}">
                            @if (LaravelLocalization::getCurrentLocale() == 'ar')
                                {{ \Illuminate\Support\Str::limit(strip_tags($intro->ar_content), 200) }}
                            @else
                                {{ \Illuminate\Support\Str::limit(strip_tags($intro->content), 200) }}
                            @endif
                        </p>
                    @endif --}}
                </div>
            </div>

            {{-- Navigation Cards --}}
            <div class="kh-cards-section">
                <div class="container">
                    <div class="kh-cards-grid">

                        {{-- Our Work --}}
                        <a href="{{ route('regional.our_work') }}" class="kh-card" style="--c:#022448; --cl:rgba(2,36,72,.06);">
                            <div class="kh-card-top-bar"></div>
                            <div class="kh-card-body">
                                <div class="kh-card-icon">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M12 2L2 7l10 5 10-5-10-5z" />
                                        <path d="M2 17l10 5 10-5" />
                                        <path d="M2 12l10 5 10-5" />
                                    </svg>
                                </div>
                                <h3 class="kh-card-title">@lang('translation.our-work')</h3>
                                <p class="kh-card-desc">
                                    @php $kh_our_work_desc = \App\Models\static_content::where('key','kh_our_work_desc')->first() @endphp
                                    @if($kh_our_work_desc)
                                        {{ LaravelLocalization::getCurrentLocale() == 'ar' && $kh_our_work_desc->ar_content ? $kh_our_work_desc->ar_content : $kh_our_work_desc->content }}
                                    @elseif (LaravelLocalization::getCurrentLocale() == 'ar')
                                        أبحاث ومنشورات وتقارير أنتجها فريقنا حول الذكاء الاصطناعي المسؤول في المنطقة.
                                    @else
                                        Research, publications, and reports produced by our team on responsible AI in the MENA region.
                                    @endif
                                </p>
                            </div>
                            <div class="kh-card-foot">
                                <span class="kh-card-cta">
                                    @if (LaravelLocalization::getCurrentLocale() == 'ar') تصفح @else Browse @endif
                                </span>
                                <svg class="kh-card-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    @if (LaravelLocalization::getCurrentLocale() == 'ar')
                                        <path d="M19 12H5"/><path d="M12 5l-7 7 7 7"/>
                                    @else
                                        <path d="M5 12h14"/><path d="M12 5l7 7-7 7"/>
                                    @endif
                                </svg>
                            </div>
                        </a>

                        {{-- Regional Other Work --}}
                        <a href="{{ route('regional.regional_other_work') }}" class="kh-card" style="--c:#006644; --cl:rgba(0,102,68,.06);">
                            <div class="kh-card-top-bar"></div>
                            <div class="kh-card-body">
                                <div class="kh-card-icon">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10" />
                                        <path d="M12 2c0 0-4 5-4 10s4 10 4 10" />
                                        <path d="M12 2c0 0 4 5 4 10s-4 10-4 10" />
                                        <path d="M2 12h20" />
                                    </svg>
                                </div>
                                <h3 class="kh-card-title">
                                    @if (LaravelLocalization::getCurrentLocale() == 'ar') الموارد الإقليمية @else Regional Resources @endif
                                </h3>
                                <p class="kh-card-desc">
                                    @php $kh_regional_work_desc = \App\Models\static_content::where('key','kh_regional_work_desc')->first() @endphp
                                    @if($kh_regional_work_desc)
                                        {{ LaravelLocalization::getCurrentLocale() == 'ar' && $kh_regional_work_desc->ar_content ? $kh_regional_work_desc->ar_content : $kh_regional_work_desc->content }}
                                    @elseif (LaravelLocalization::getCurrentLocale() == 'ar')
                                        أبحاث ومصادر خارجية من المنطقة تتناول الذكاء الاصطناعي والبيانات.
                                    @else
                                        External research and resources from the MENA region on AI and data governance.
                                    @endif
                                </p>
                            </div>
                            <div class="kh-card-foot">
                                <span class="kh-card-cta">
                                    @if (LaravelLocalization::getCurrentLocale() == 'ar') تصفح @else Browse @endif
                                </span>
                                <svg class="kh-card-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    @if (LaravelLocalization::getCurrentLocale() == 'ar')
                                        <path d="M19 12H5"/><path d="M12 5l-7 7 7 7"/>
                                    @else
                                        <path d="M5 12h14"/><path d="M12 5l7 7-7 7"/>
                                    @endif
                                </svg>
                            </div>
                        </a>

                        {{-- Global Other Work --}}
                        <a href="{{ route('regional.global_other_work') }}" class="kh-card" style="--c:#c8870a; --cl:rgba(250,175,28,.06);">
                            <div class="kh-card-top-bar"></div>
                            <div class="kh-card-body">
                                <div class="kh-card-icon">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z" />
                                        <path d="M3.27 6.96L12 12.01l8.73-5.05" />
                                        <path d="M12 22.08V12" />
                                    </svg>
                                </div>
                                <h3 class="kh-card-title">
                                    @if (LaravelLocalization::getCurrentLocale() == 'ar') الموارد العالمية @else Global Resources @endif
                                </h3>
                                <p class="kh-card-desc">
                                    @php $kh_global_work_desc = \App\Models\static_content::where('key','kh_global_work_desc')->first() @endphp
                                    @if($kh_global_work_desc)
                                        {{ LaravelLocalization::getCurrentLocale() == 'ar' && $kh_global_work_desc->ar_content ? $kh_global_work_desc->ar_content : $kh_global_work_desc->content }}
                                    @elseif (LaravelLocalization::getCurrentLocale() == 'ar')
                                        مجموعة منسقة من الأبحاث والموارد الدولية حول الذكاء الاصطناعي المسؤول.
                                    @else
                                        A curated collection of international research and resources on responsible AI worldwide.
                                    @endif
                                </p>
                            </div>
                            <div class="kh-card-foot">
                                <span class="kh-card-cta">
                                    @if (LaravelLocalization::getCurrentLocale() == 'ar') تصفح @else Browse @endif
                                </span>
                                <svg class="kh-card-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    @if (LaravelLocalization::getCurrentLocale() == 'ar')
                                        <path d="M19 12H5"/><path d="M12 5l-7 7 7 7"/>
                                    @else
                                        <path d="M5 12h14"/><path d="M12 5l7 7-7 7"/>
                                    @endif
                                </svg>
                            </div>
                        </a>

                    </div>
                </div>
            </div>

        </div>{{-- /.kh-page --}}

        @include('layouts.footers.guest.footer')

        {{-- ═══════════ LANDING STYLES ═══════════ --}}
        <style>
            :root {
                --kh-navy:  #022448;
                --kh-gold:  #FAAF1C;
                --kh-gold-dark: #c8870a;
                --kh-bg:    #f8f9fb;
                --kh-text:  #111827;
                --kh-muted: #6b7280;
                --kh-border: rgba(0,0,0,.07);
            }

            /* ── Page shell ── */
            .kh-page {
                background: var(--kh-bg);
                min-height: calc(100vh - 64px);
                display: flex;
                flex-direction: column;
            }

            /* ── Hero ── */
            .kh-hero {
                background: #fff;
                border-bottom: 1px solid var(--kh-border);
                padding: 4rem 0 3.5rem;
                text-align: center;
                animation: kh-up .55s ease both;
            }

            .kh-label {
                display: inline-block;
                font-size: .7rem;
                font-weight: 700;
                letter-spacing: .14em;
                text-transform: uppercase;
                color: var(--kh-gold-dark);
                background: rgba(250,175,28,.08);
                border: 1px solid rgba(250,175,28,.2);
                border-radius: 100px;
                padding: 4px 14px;
                margin-bottom: 1.25rem;
            }

            .kh-title {
                font-size: 2.6rem;
                font-weight: 700;
                color: var(--kh-navy);
                line-height: 1.15;
                margin: 0 auto .1rem;
                max-width: 640px;
                letter-spacing: -.02em;
                animation: kh-up .55s ease .08s both;
            }

            .kh-rule {
                width: 40px;
                height: 3px;
                border-radius: 2px;
                background: var(--kh-gold);
                margin: 1.2rem auto 1.5rem;
                animation: kh-up .55s ease .14s both;
            }

            .kh-intro {
                font-size: .9rem;
                color: var(--kh-muted);
                line-height: 1.7;
                max-width: 520px;
                margin: 0 auto;
                animation: kh-up .55s ease .2s both;
            }

            /* ── Cards section ── */
            .kh-cards-section {
                flex: 1;
                padding: 3rem 0 4rem;
            }

            .kh-cards-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 1.5rem;
            }

            /* ── Card ── */
            .kh-card {
                display: flex;
                flex-direction: column;
                background: #fff;
                border: 1px solid var(--kh-border);
                border-radius: 14px;
                overflow: hidden;
                text-decoration: none !important;
                color: var(--kh-text);
                transition: transform .3s ease, box-shadow .3s ease, border-color .3s ease;
                animation: kh-up .5s ease both;
            }
            .kh-card:nth-child(1) { animation-delay: .1s; }
            .kh-card:nth-child(2) { animation-delay: .18s; }
            .kh-card:nth-child(3) { animation-delay: .26s; }

            .kh-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 12px 36px rgba(2,36,72,.09), 0 3px 10px rgba(0,0,0,.04);
                border-color: rgba(0,0,0,.1);
                text-decoration: none !important;
                color: var(--kh-text);
            }

            .kh-card-top-bar {
                height: 4px;
                background: var(--c);
                flex-shrink: 0;
            }

            .kh-card-body {
                flex: 1;
                padding: 1.75rem 1.75rem 1.25rem;
            }

            .kh-card-icon {
                width: 44px;
                height: 44px;
                border-radius: 10px;
                background: var(--cl);
                color: var(--c);
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 1.25rem;
                transition: transform .25s ease;
            }
            .kh-card:hover .kh-card-icon { transform: scale(1.07); }

            .kh-card-title {
                font-size: 1.05rem;
                font-weight: 700;
                color: var(--kh-navy);
                margin: 0 0 .6rem;
                line-height: 1.3;
            }

            .kh-card-desc {
                font-size: .85rem;
                color: var(--kh-muted);
                line-height: 1.65;
                margin: 0;
            }

            .kh-card-foot {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: .9rem 1.75rem 1.25rem;
                border-top: 1px solid var(--kh-border);
                margin-top: auto;
            }

            .kh-card-cta {
                font-size: .72rem;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: .09em;
                color: var(--c);
            }

            .kh-card-arrow {
                color: var(--c);
                opacity: .5;
                transition: opacity .25s ease, transform .25s ease;
            }
            .kh-card:hover .kh-card-arrow {
                opacity: 1;
                transform: translateX(3px);
            }
            [dir="rtl"] .kh-card:hover .kh-card-arrow {
                transform: translateX(-3px);
            }

            /* ── Fade-rise animation ── */
            @keyframes kh-up {
                from { opacity: 0; transform: translateY(16px); }
                to   { opacity: 1; transform: translateY(0); }
            }

            /* ── Responsive ── */
            @media (max-width: 991px) {
                .kh-hero { padding: 3rem 0 2.5rem; }
                .kh-title { font-size: 2rem; }
                .kh-cards-grid { grid-template-columns: repeat(2, 1fr); }
            }

            @media (max-width: 576px) {
                .kh-hero { padding: 2.5rem 0 2rem; }
                .kh-title { font-size: 1.65rem; }
                .kh-cards-grid { grid-template-columns: 1fr; gap: 1rem; }
                .kh-cards-section { padding: 2rem 0 3rem; }
            }
        </style>
    @else
        {{-- ═══════════════════════════════════════════════ --}}
        {{-- LIST PAGES — TWO-COLUMN HEADER + CONTENT       --}}
        {{-- ═══════════════════════════════════════════════ --}}
        @php
            if (isset($filterTag) && $filterTag === 'Gender') {
                $pageTitle    = 'Gender & AI Resources';
                $pageSubtitle = 'Knowledge Hub resources on Gender and Artificial Intelligence';
                $accentColor  = '#6d1b7b';
            } elseif ($isOurWork) {
                $pageTitle = __('translation.our-work');
                $pageSubtitle = 'Research, publications, and reports produced by our team';
                $accentColor = '#022448';
            } elseif (isset($isGlobal) && $isGlobal === true) {
                $pageTitle = 'Global Resources';
                $pageSubtitle = 'International research and resources on responsible AI';
                $accentColor = '#FAAF1C';
            } else {
                $pageTitle = 'Regional Resources';
                $pageSubtitle = 'External research and resources from the MENA region';
                $accentColor = '#006644';
            }
        @endphp

        <div class="kh-list-page" @if (LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl" @endif>
            <div class="kh-list-header" style="--accent:{{ $accentColor }}">
                <div class="kh-list-header-grain"></div>
                <div class="kh-list-header-bg"></div>
                <div class="kh-list-header-ring"></div>

                <div class="container position-relative" style="z-index:2">
                    <div class="kh-list-header-grid">
                        <div class="kh-list-header-left">
                            <nav class="kh-breadcrumb">
                                <a href="{{ route('regional') }}">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" style="margin-inline-end:4px;vertical-align:-1px;">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                                        <polyline points="9 22 9 12 15 12 15 22" />
                                    </svg>
                                    Knowledge Hub
                                </a>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path d="M9 18l6-6-6-6" />
                                </svg>
                                <span>{{ $pageTitle }}</span>
                            </nav>
                            <h1 class="kh-list-title">{{ $pageTitle }}</h1>
                            <div class="kh-list-accent-bar" style="background:{{ $accentColor }}"></div>
                        </div>
                        <div class="kh-list-header-right">
                            <p class="kh-list-subtitle">{{ $pageSubtitle }}</p>
                        </div>
                    </div>
                </div>

                <div class="kh-list-wave">
                    <svg viewBox="0 0 1440 70" preserveAspectRatio="none">
                        <path fill="#f5f6f8" d="M0,35 C480,65 960,10 1440,40 L1440,70 L0,70 Z" opacity="0.5" />
                        <path fill="#f5f6f8" d="M0,45 C360,65 900,20 1440,45 L1440,70 L0,70 Z" />
                    </svg>
                </div>
            </div>

            <div class="container kh-list-content">
                <livewire:repo-list
                    :isOurWork="$isOurWork"
                    :isGlobal="isset($isGlobal) ? $isGlobal : null"
                    :filterTag="isset($filterTag) ? $filterTag : null"
                />
            </div>
        </div>

        @include('layouts.footers.guest.footer')

        {{-- ═══════════ LIST PAGE STYLES ═══════════ --}}
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Geist:wght@400;500;600;700;800&display=swap');

            :root {
                --kh-navy: #022448;
                --kh-navy-deep: #01162e;
                --kh-navy-mid: #0a3a6e;
                --kh-gold: #FAAF1C;
                --kh-bg: #f5f6f8;
                --kh-text: #111827;
                --kh-muted: #6b7280;
                --kh-serif: 'Instrument Serif', Georgia, serif;
                --kh-sans: 'Geist', -apple-system, BlinkMacSystemFont, sans-serif;
            }

            .kh-list-page {
                background: var(--kh-bg);
                min-height: 100vh;
            }

            .kh-list-header {
                background: linear-gradient(170deg, var(--kh-navy-deep) 0%, var(--kh-navy) 50%, var(--kh-navy-mid) 100%);
                position: relative;
                overflow: hidden;
                padding: 60px 0 90px;
            }

            .kh-list-header-grain {
                position: absolute;
                inset: 0;
                opacity: .35;
                pointer-events: none;
                background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.7' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.035'/%3E%3C/svg%3E");
                background-size: 256px 256px;
            }

            .kh-list-header-bg {
                position: absolute;
                inset: 0;
                background:
                    radial-gradient(circle at 12% 60%, rgba(250, 175, 28, .05) 0%, transparent 45%),
                    radial-gradient(circle at 88% 30%, rgba(255, 255, 255, .03) 0%, transparent 40%);
            }

            .kh-list-header-ring {
                position: absolute;
                width: 240px;
                height: 240px;
                top: -60px;
                right: -40px;
                border-radius: 50%;
                border: 1px solid rgba(255, 255, 255, .04);
                animation: kh-drift 22s ease-in-out infinite;
            }

            @keyframes kh-drift {

                0%,
                100% {
                    transform: translate(0, 0);
                }

                50% {
                    transform: translate(8px, -12px);
                }
            }

            .kh-list-wave {
                position: absolute;
                bottom: -2px;
                left: 0;
                width: 100%;
                line-height: 0;
            }

            .kh-list-wave svg {
                width: 100%;
                height: 60px;
            }

            .kh-list-header-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 3rem;
                align-items: end;
            }

            .kh-breadcrumb {
                display: flex;
                align-items: center;
                gap: .5rem;
                font-family: var(--kh-sans);
                font-size: .8rem;
                margin-bottom: 1rem;
                animation: kh-fadeUp .6s ease both;
            }

            .kh-breadcrumb a {
                color: rgba(255, 255, 255, .4);
                text-decoration: none;
                transition: color .25s;
                display: inline-flex;
                align-items: center;
            }

            .kh-breadcrumb a:hover {
                color: var(--kh-gold);
            }

            .kh-breadcrumb svg {
                color: rgba(255, 255, 255, .2);
            }

            .kh-breadcrumb span {
                color: rgba(255, 255, 255, .8);
                font-weight: 600;
            }

            .kh-list-title {
                font-family: var(--kh-serif);
                color: #fff;
                font-size: 2.5rem;
                font-weight: 400;
                line-height: 1.15;
                margin: 0 0 1.25rem;
                animation: kh-fadeUp .6s ease .08s both;
            }

            .kh-list-accent-bar {
                width: 36px;
                height: 3px;
                border-radius: 2px;
                opacity: .8;
                animation: kh-fadeUp .6s ease .16s both;
            }

            .kh-list-subtitle {
                font-family: var(--kh-sans);
                color: rgba(255, 255, 255, .45);
                font-size: .9rem;
                line-height: 1.75;
                margin: 0;
                max-width: 360px;
                animation: kh-fadeUp .6s ease .2s both;
            }

            [dir="rtl"] .kh-list-header-right {
                text-align: left;
            }

            .kh-list-header-right {
                display: flex;
                align-items: flex-end;
                justify-content: flex-end;
            }

            @keyframes kh-fadeUp {
                from {
                    opacity: 0;
                    transform: translateY(14px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .kh-list-content {
                padding-top: 0;
                margin-top: -30px;
                position: relative;
                z-index: 2;
            }

            @media (max-width: 991px) {
                .kh-list-header-grid {
                    grid-template-columns: 1fr;
                    gap: 1rem;
                }

                .kh-list-header-right {
                    justify-content: flex-start;
                }

                [dir="rtl"] .kh-list-header-right {
                    text-align: right;
                }
            }

            @media (max-width: 768px) {
                .kh-list-header {
                    padding: 45px 0 75px;
                }

                .kh-list-title {
                    font-size: 1.9rem;
                }

                .kh-list-header-ring {
                    display: none;
                }
            }

            @media (max-width: 480px) {
                .kh-list-header {
                    padding: 35px 0 65px;
                }

                .kh-list-title {
                    font-size: 1.5rem;
                }
            }
        </style>
    @endif
@endsection
