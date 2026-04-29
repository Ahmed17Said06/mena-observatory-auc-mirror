@extends('layouts.frontend.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('title', 'Future of Work Resources | MENA Observatory')

@section('content')
@include('layouts.navbars.guest.navbar', ['title' => 'Future of Work Resources'])

<div class="gr-page">

    {{-- ═══ HERO ═══ --}}
    <div class="gr-hero">
        <div class="gr-hero-overlay"></div>
        <div class="container gr-hero-content">
            <nav class="gr-breadcrumb">
                <a href="{{ route('pw_mena') }}">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        style="vertical-align:-1px; margin-inline-end:4px;">
                        <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                        <polyline points="9 22 9 12 15 12 15 22"/>
                    </svg>
                    Future of Work MENA
                </a>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 18l6-6-6-6"/>
                </svg>
                <span>Future of Work Resources</span>
            </nav>
            <h1 class="gr-hero-title">Future of Work Resources</h1>
            <p class="gr-hero-sub">Knowledge Hub resources on the Future of Work in MENA</p>
        </div>
        <div class="gr-hero-wave">
            <svg viewBox="0 0 1440 70" preserveAspectRatio="none">
                <path fill="#f5f6f8" d="M0,35 C480,65 960,10 1440,40 L1440,70 L0,70 Z" opacity="0.5"/>
                <path fill="#f5f6f8" d="M0,45 C360,65 900,20 1440,45 L1440,70 L0,70 Z"/>
            </svg>
        </div>
    </div>

    {{-- ═══ TABS + LIST ═══ --}}
    <div class="container gr-body">
        <livewire:repo-list :filterTag="'fow'" />
    </div>

</div>

@include('layouts.footers.guest.footer')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Geist:wght@400;500;600;700;800&display=swap');

    /* ══════ PAGE TOKENS ══════ */
    .gr-page {
        --rl-navy:    #022448;
        --rl-gold:    #FAAF1C;
        --rl-gold-dk: #d4940a;
        --rl-text:    #111827;
        --rl-muted:   #6b7280;
        --rl-light:   #f5f6f8;
        --rl-border:  #eef0f3;
        --rl-surface: #ffffff;
        --rl-radius:  10px;
        --rl-sans:    'Geist', -apple-system, BlinkMacSystemFont, sans-serif;
        font-family: var(--rl-sans);
        background: #f5f6f8;
    }

    /* ══════ HERO ══════ */
    .gr-hero {
        position: relative;
        background: linear-gradient(135deg, #022248 0%, #0a4a6e 45%, #c8870a 100%);
        background-size: 300% 300%;
        animation: gr-grad 10s ease infinite;
        padding: 3.5rem 0 0;
        overflow: hidden;
    }

    @keyframes gr-grad {
        0%   { background-position: 0% 50%; }
        50%  { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .gr-hero-overlay {
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse at 70% 40%, rgba(250,175,28,.25) 0%, transparent 65%);
        pointer-events: none;
    }

    .gr-hero-content {
        position: relative;
        z-index: 2;
        padding-bottom: 3rem;
    }

    .gr-breadcrumb {
        display: flex;
        align-items: center;
        gap: .4rem;
        font-size: .8rem;
        font-weight: 600;
        color: rgba(255,255,255,.65);
        margin-bottom: 1.25rem;
    }

    .gr-breadcrumb a {
        color: rgba(255,255,255,.75);
        text-decoration: none;
        transition: color .2s;
    }

    .gr-breadcrumb a:hover { color: #fff; }
    .gr-breadcrumb span   { color: #fff; }

    .gr-hero-title {
        font-size: clamp(1.8rem, 4vw, 2.6rem);
        font-weight: 800;
        color: #fff;
        margin: 0 0 .6rem;
        letter-spacing: -.01em;
        line-height: 1.2;
    }

    .gr-hero-sub {
        font-size: 1rem;
        color: rgba(255,255,255,.72);
        margin: 0 0 1.75rem;
        max-width: 560px;
    }

    /* Jump links */
    .gr-jump-links {
        display: flex;
        flex-wrap: wrap;
        gap: .6rem;
    }

    .gr-jump {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        padding: .45rem 1rem;
        background: rgba(255,255,255,.12);
        border: 1px solid rgba(255,255,255,.2);
        border-radius: 20px;
        color: #fff;
        font-size: .8rem;
        font-weight: 600;
        text-decoration: none;
        transition: all .2s;
        backdrop-filter: blur(6px);
    }

    .gr-jump:hover {
        background: rgba(255,255,255,.22);
        color: #fff;
        text-decoration: none;
        transform: translateY(-1px);
    }

    .gr-jump-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .gr-hero-wave {
        position: relative;
        z-index: 2;
        line-height: 0;
        margin-top: -1px;
    }

    .gr-hero-wave svg {
        display: block;
        width: 100%;
        height: 70px;
    }

    /* ══════ BODY ══════ */
    .gr-body {
        padding: 2.5rem 1rem 4rem;
    }

    /* ══════ SECTION ══════ */
    .gr-section {
        margin-bottom: 3rem;
        scroll-margin-top: 5rem;
    }

    .gr-section-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        background: #fff;
        border: 1px solid var(--rl-border);
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 12px rgba(0,0,0,.04);
    }

    .gr-section-bar {
        width: 6px;
        align-self: stretch;
        background: var(--sc);
        flex-shrink: 0;
    }

    .gr-section-info {
        flex: 1;
        padding: 1.1rem .5rem 1.1rem 0;
    }

    .gr-section-title {
        font-size: 1.2rem;
        font-weight: 800;
        color: var(--rl-text);
        margin: 0 0 .2rem;
        letter-spacing: -.01em;
    }

    .gr-section-sub {
        font-size: .82rem;
        color: var(--rl-muted);
        margin: 0;
    }

    .gr-section-badge {
        margin-inline-end: 1.25rem;
        padding: .3rem .8rem;
        background: color-mix(in srgb, var(--sc) 10%, white);
        color: var(--sc);
        border: 1px solid color-mix(in srgb, var(--sc) 25%, white);
        border-radius: 20px;
        font-size: .75rem;
        font-weight: 700;
        white-space: nowrap;
        flex-shrink: 0;
    }

    /* ══════ TYPE GROUP ══════ */
    .gr-type-group {
        margin-bottom: 1.75rem;
    }

    .gr-type-header {
        display: flex;
        align-items: center;
        gap: .75rem;
        margin-bottom: .85rem;
        padding-bottom: .55rem;
        border-bottom: 2px solid color-mix(in srgb, var(--sc) 15%, white);
    }

    .gr-type-title {
        font-size: .82rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .08em;
        color: var(--sc);
        margin: 0;
    }

    .gr-type-count {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 22px;
        height: 22px;
        padding: 0 .5rem;
        background: var(--sc);
        color: #fff;
        border-radius: 11px;
        font-size: .7rem;
        font-weight: 700;
    }

    .gr-cards {
        display: flex;
        flex-direction: column;
        gap: 0;
    }

    /* ══════ EMPTY STATE ══════ */
    .gr-empty {
        text-align: center;
        padding: 2.5rem 1rem;
        color: var(--rl-muted);
        background: #fff;
        border: 1px dashed var(--rl-border);
        border-radius: 10px;
    }

    .gr-empty svg {
        color: #d1d5db;
        margin-bottom: .6rem;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    .gr-empty p {
        margin: 0;
        font-size: .9rem;
        font-weight: 600;
        color: #6b7280;
    }

    /* ══════ CARDS ══════ */
    .rl-card {
        background: var(--rl-surface);
        border: 1px solid var(--rl-border);
        border-radius: var(--rl-radius);
        overflow: hidden;
        margin-bottom: .75rem;
        transition: all .3s cubic-bezier(.22,.61,.36,1);
        position: relative;
        animation: rl-fadeIn .4s ease both;
    }

    @keyframes rl-fadeIn {
        from { opacity: 0; transform: translateY(8px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .rl-card::after {
        content: '';
        position: absolute;
        left: 0; top: 0; bottom: 0;
        width: 3px;
        background: transparent;
        transition: background .25s;
    }

    .rl-card:hover {
        box-shadow: 0 6px 24px rgba(2,36,72,.06);
        transform: translateY(-2px);
        border-color: #e0e2e6;
    }

    .rl-card:hover::after { background: var(--rl-gold); }

    .rl-card-img-link { display: block; text-decoration: none; height: 100%; }

    .rl-card-img {
        position: relative;
        width: 100%; height: 100%;
        min-height: 140px;
        overflow: hidden;
        background: var(--rl-light);
    }

    .rl-card-img-placeholder {
        width: 100%; height: 100%;
        min-height: 140px;
        display: flex; align-items: center; justify-content: center;
        background: linear-gradient(135deg, #f0f2f5 0%, #e8ebf0 100%);
        color: #b0b7c3;
    }

    .rl-card-img img {
        width: 100%; height: 100%;
        object-fit: cover;
        transition: transform .4s cubic-bezier(.22,.61,.36,1);
    }

    .rl-card-img-hover {
        position: absolute; inset: 0;
        background: rgba(2,36,72,.5);
        display: flex; align-items: center; justify-content: center;
        opacity: 0; transition: opacity .25s; color: #fff;
    }

    .rl-card-img:hover .rl-card-img-hover { opacity: 1; }
    .rl-card-img:hover img { transform: scale(1.05); }

    .rl-card-body {
        padding: 1.1rem 1.25rem;
        display: flex; flex-direction: column; height: 100%;
    }

    .rl-card-title {
        font-family: var(--rl-sans);
        font-size: 1rem; font-weight: 700;
        color: var(--rl-text);
        text-decoration: none;
        line-height: 1.4; margin-bottom: .4rem;
        transition: color .2s; display: block;
    }

    .rl-card-title:hover { color: var(--rl-gold); text-decoration: none; }

    .rl-card-desc {
        font-size: .82rem; color: var(--rl-muted);
        line-height: 1.6; margin: 0 0 .6rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden; flex: 1;
    }

    .rl-card-tags {
        display: flex; flex-wrap: wrap; gap: .3rem; margin-bottom: .6rem;
    }

    .rl-tag {
        padding: .2rem .55rem;
        background: var(--rl-light);
        border: 1px solid var(--rl-border);
        border-radius: 16px;
        font-size: .7rem; font-weight: 600;
        color: #4b5563; text-decoration: none;
        transition: all .2s;
    }

    .rl-tag:hover {
        background: var(--rl-navy);
        border-color: var(--rl-navy);
        color: #fff; text-decoration: none;
    }

    .rl-card-actions {
        display: flex; gap: .4rem; flex-wrap: wrap; margin-top: auto;
    }

    .rl-dl {
        display: inline-flex; align-items: center; gap: .3rem;
        padding: .35rem .7rem;
        background: var(--rl-light);
        border: 1px solid var(--rl-border);
        border-radius: 6px;
        color: #374151; font-weight: 600; font-size: .76rem;
        text-decoration: none; transition: all .2s;
    }

    .rl-dl:hover {
        border-color: var(--rl-gold); color: var(--rl-gold-dk);
        background: #fffdf5; text-decoration: none;
    }

    /* ══════ RESPONSIVE ══════ */
    @media (max-width: 767px) {
        .gr-hero { padding-top: 2.5rem; }
        .gr-hero-title { font-size: 1.6rem; }
        .gr-jump-links { gap: .4rem; }
        .gr-jump { font-size: .74rem; padding: .35rem .75rem; }
        .gr-section-header { flex-wrap: wrap; }
        .gr-section-badge { margin-bottom: .75rem; }
        .rl-card-body { padding: .85rem 1rem; }
        .rl-card-img { min-height: 120px; }
        .rl-card-title { font-size: .92rem; }
    }

    /* color-mix fallback for older browsers */
    @supports not (color: color-mix(in srgb, red 10%, white)) {
        .gr-section-badge { background: rgba(0,0,0,.06); color: inherit; border-color: rgba(0,0,0,.1); }
        .gr-type-header { border-bottom-color: #e5e7eb; }
    }
</style>

@endsection
