@extends('layouts.frontend.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('title', 'Gender & AI Resources | MENA Observatory')

@section('content')
@include('layouts.navbars.guest.navbar', ['title' => 'Gender & AI Resources'])

<div class="gr-page">

    {{-- ═══ HERO ═══ --}}
    <div class="gr-hero">
        <div class="gr-hero-overlay"></div>
        <div class="container gr-hero-content">
            <nav class="gr-breadcrumb">
                <a href="{{ route('feminist_ai') }}">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        style="vertical-align:-1px; margin-inline-end:4px;">
                        <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                        <polyline points="9 22 9 12 15 12 15 22"/>
                    </svg>
                    Feminist AI
                </a>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 18l6-6-6-6"/>
                </svg>
                <span>Gender & AI Resources</span>
            </nav>
            <h1 class="gr-hero-title">Gender & AI Resources</h1>
            <p class="gr-hero-sub">Knowledge Hub resources on Gender and Artificial Intelligence</p>

            {{-- Section jump links --}}
            <div class="gr-jump-links">
                <a href="#observatory" class="gr-jump" style="--jc:#6d9fc9;">
                    <span class="gr-jump-dot" style="background:#022448;"></span>
                    Observatory Outputs
                </a>
                <a href="#regional" class="gr-jump" style="--jc:#4caf8a;">
                    <span class="gr-jump-dot" style="background:#006644;"></span>
                    Regional Resources
                </a>
                <a href="#global" class="gr-jump" style="--jc:#e8a83e;">
                    <span class="gr-jump-dot" style="background:#c8870a;"></span>
                    Global Resources
                </a>
            </div>
        </div>
        <div class="gr-hero-wave">
            <svg viewBox="0 0 1440 70" preserveAspectRatio="none">
                <path fill="#f5f6f8" d="M0,35 C480,65 960,10 1440,40 L1440,70 L0,70 Z" opacity="0.5"/>
                <path fill="#f5f6f8" d="M0,45 C360,65 900,20 1440,45 L1440,70 L0,70 Z"/>
            </svg>
        </div>
    </div>

    {{-- ═══ SECTIONS ═══ --}}
    <div class="container gr-body">

        @foreach($sections as $section)
        <section class="gr-section" id="{{ $section['key'] }}">

            {{-- Section header --}}
            <div class="gr-section-header" style="--sc: {{ $section['color'] }};">
                <div class="gr-section-bar"></div>
                <div class="gr-section-info">
                    <h2 class="gr-section-title">{{ $section['title'] }}</h2>
                    <p class="gr-section-sub">{{ $section['subtitle'] }}</p>
                </div>
                @php $totalCount = $section['repos']->flatten(1)->count(); @endphp
                @if($totalCount > 0)
                    <span class="gr-section-badge">{{ $totalCount }} {{ Str::plural('resource', $totalCount) }}</span>
                @endif
            </div>

            @if($section['repos']->isEmpty())
                <div class="gr-empty">
                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
                    </svg>
                    <p>No resources in this section yet</p>
                </div>
            @else
                @foreach($section['repos'] as $typeName => $typeRepos)
                <div class="gr-type-group">
                    <div class="gr-type-header" style="--sc: {{ $section['color'] }};">
                        <h3 class="gr-type-title">{{ $typeName }}</h3>
                        <span class="gr-type-count">{{ $typeRepos->count() }}</span>
                    </div>

                    <div class="gr-cards">
                        @foreach($typeRepos as $index => $r)
                            @php $detailUrl = route('repo.single', $r->id); @endphp
                            <article class="rl-card" style="animation-delay: {{ $index * 40 }}ms">
                                <div class="row g-0">
                                    <div class="col-md-3">
                                        <a href="{{ $detailUrl }}" class="rl-card-img-link">
                                            <div class="rl-card-img">
                                                @if($r->image && Storage::exists($r->image))
                                                    <img src="{{ Storage::url($r->image) }}" alt="{{ $r->title }}" loading="lazy">
                                                @else
                                                    <div class="rl-card-img-placeholder">
                                                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="1.5"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                                                            <polyline points="14 2 14 8 20 8"/>
                                                            <line x1="16" y1="13" x2="8" y2="13"/>
                                                            <line x1="16" y1="17" x2="8" y2="17"/>
                                                            <polyline points="10 9 9 9 8 9"/>
                                                        </svg>
                                                    </div>
                                                @endif
                                                <div class="rl-card-img-hover">
                                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                        <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                    </svg>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="rl-card-body">
                                            <a href="{{ $detailUrl }}" class="rl-card-title">{{ $r->title }}</a>
                                            <p class="rl-card-desc">{{ $r->description }}</p>
                                            @if(count($r->tags) > 0)
                                                <div class="rl-card-tags">
                                                    @foreach($r->tags as $tag)
                                                        <a class="rl-tag" href="/search?tag={{ $tag->name }}">{{ $tag->name }}</a>
                                                    @endforeach
                                                </div>
                                            @endif
                                            <div class="rl-card-actions">
                                                @if($r->data_link)
                                                    <a class="rl-dl" href="{{ $r->data_link }}" target="_blank">
                                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/>
                                                            <polyline points="15 3 21 3 21 9"/>
                                                            <line x1="10" y1="14" x2="21" y2="3"/>
                                                        </svg>
                                                        Link
                                                    </a>
                                                @endif
                                                @if($r->ar_pdf)
                                                    <a class="rl-dl" href="{{ Storage::url($r->ar_pdf) }}" target="_blank">
                                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/>
                                                            <polyline points="7 10 12 15 17 10"/>
                                                            <line x1="12" y1="15" x2="12" y2="3"/>
                                                        </svg>
                                                        Arabic
                                                    </a>
                                                @endif
                                                @if($r->en_pdf)
                                                    <a class="rl-dl" href="{{ Storage::url($r->en_pdf) }}" target="_blank">
                                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/>
                                                            <polyline points="7 10 12 15 17 10"/>
                                                            <line x1="12" y1="15" x2="12" y2="3"/>
                                                        </svg>
                                                        English
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
                @endforeach
            @endif

        </section>
        @endforeach

    </div>{{-- /.container --}}

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
        background: linear-gradient(135deg, #1a0a2e 0%, #6d1b7b 45%, #022248 100%);
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
        background: radial-gradient(ellipse at 70% 40%, rgba(109,27,123,.35) 0%, transparent 65%);
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

    /* ══════ CARDS (shared with repo-list) ══════ */
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
