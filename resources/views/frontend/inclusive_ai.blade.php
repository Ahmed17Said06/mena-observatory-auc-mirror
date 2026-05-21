@extends('layouts.frontend.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('title', 'Inclusive AI Research Network | MENA Observatory')

@section('content')
@include('layouts.navbars.guest.navbar', ['title' => 'Inclusive AI Research Network'])

{{-- Hero --}}
<div class="iai-hero">
    <div class="iai-hero__overlay"></div>
    <div class="iai-hero__content container">
        <span class="iai-label">Inclusive AI Research Network</span>
        <h1 class="iai-hero__title">Inclusive AI Research Network</h1>
        <p class="iai-hero__sub">Building an inclusive, equitable AI research ecosystem across the MENA region.</p>
    </div>
    <div class="iai-hero__wave">
        <svg viewBox="0 0 1440 70" preserveAspectRatio="none">
            <path fill="#f5f6f8" d="M0,35 C480,65 960,10 1440,40 L1440,70 L0,70 Z" opacity="0.5"/>
            <path fill="#f5f6f8" d="M0,45 C360,65 900,20 1440,45 L1440,70 L0,70 Z"/>
        </svg>
    </div>
</div>

<div class="container iai-body">

    {{-- ── Intro ── --}}
    <section class="iai-intro">
        <p class="iai-intro__p">The <strong>Inclusive AI Research Network (IAIRN)</strong> is a global network supported by Canada's International Development Research Centre (IDRC), created with the goal of supporting community driven innovation and grounds up development of inclusive and human-centered AI technologies. In doing so, IAIRN aims to contribute to rectifying the biases and correcting inequities that are often reproduced and exacerbated by AI technologies, particularly towards women, youth and other marginalized groups. The network focuses on building scalable AI technologies that address local challenges with inclusion at the core of design, development and deployment.</p>
        <div class="iai-coming-soon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            Additional research content and network resources are <strong>coming soon</strong>. Check back for updates as the Network grows.
        </div>
    </section>

    {{-- ── Observatory Outputs ── --}}
    <section class="iai-sec mb-5">
        <div class="iai-sec__head">
            <span class="iai-sec__num" style="background:linear-gradient(135deg,#FAAF1C 0%,#c8870a 100%);">1</span>
            <div>
                <h2 class="iai-sec__title">Observatory Outputs</h2>
                <p class="iai-sec__sub">Research, webinars &amp; talks, and educational resources produced by the Observatory team.</p>
            </div>
        </div>

        {{-- a. Research --}}
        <div class="iai-subsec">
            <h3 class="iai-subsec__heading">
                <span class="iai-subsec__letter">a</span> Research
            </h3>
            @if($repoResearch->isEmpty())
                <div class="iai-empty">No research outputs have been added yet. Tag Repo items with <code>inclusive_ai</code> and set <code>is_our_work = true</code>.</div>
            @else
                <div class="iai-cards-grid">
                    @foreach($repoResearch as $r)
                        <a href="{{ route('repo.single', $r->id) }}" class="iai-card iai-card--research">
                            <div class="iai-card__icon">@include('frontend.partials._icon-doc')</div>
                            <div class="iai-card__title">{{ $r->title }}</div>
                            @if($r->description)<p class="iai-card__desc">{{ Str::limit($r->description, 120) }}</p>@endif
                            @if($r->publish_date)<div class="iai-card__tag">{{ \Carbon\Carbon::parse($r->publish_date)->format('Y') }}</div>@endif
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- b. Webinars and Talks --}}
        <div class="iai-subsec">
            <h3 class="iai-subsec__heading">
                <span class="iai-subsec__letter">b</span> Webinars and Talks
            </h3>
            @if($repoWebinars->isEmpty())
                <div class="iai-empty">No webinars or talks have been added yet.</div>
            @else
                <div class="iai-cards-grid">
                    @foreach($repoWebinars as $r)
                        <a href="{{ route('repo.single', $r->id) }}" class="iai-card iai-card--webinar">
                            <div class="iai-card__icon">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2" ry="2"/></svg>
                            </div>
                            <div class="iai-card__title">{{ $r->title }}</div>
                            @if($r->description)<p class="iai-card__desc">{{ Str::limit($r->description, 120) }}</p>@endif
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- c. Educational Resources --}}
        <div class="iai-subsec">
            <h3 class="iai-subsec__heading">
                <span class="iai-subsec__letter">c</span> Educational Resources
            </h3>
            @if($repoEdu->isEmpty())
                <div class="iai-empty">No educational resources have been added yet.</div>
            @else
                <div class="iai-cards-grid">
                    @foreach($repoEdu as $r)
                        <a href="{{ route('repo.single', $r->id) }}" class="iai-card iai-card--edu">
                            <div class="iai-card__icon">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                            </div>
                            <div class="iai-card__title">{{ $r->title }}</div>
                            @if($r->description)<p class="iai-card__desc">{{ Str::limit($r->description, 120) }}</p>@endif
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <hr class="iai-divider">

    {{-- ── Regional Resources ── --}}
    <section class="iai-sec mb-5">
        <div class="iai-sec__head">
            <span class="iai-sec__num" style="background:linear-gradient(135deg,#4caf8a 0%,#006644 100%);">2</span>
            <div>
                <h2 class="iai-sec__title" style="color:#006644;">Regional Resources</h2>
                <p class="iai-sec__sub">External research and resources from the MENA region on inclusive AI.</p>
            </div>
        </div>
        @if($regionalRepos->isEmpty())
            <div class="iai-empty">No regional resources have been tagged yet. Tag Repo items with <code>inclusive_ai</code>, <code>is_our_work = false</code>, and <code>is_global = false</code>.</div>
        @else
            <div class="iai-cards-grid">
                @foreach($regionalRepos as $r)
                    <a href="{{ route('repo.single', $r->id) }}" class="iai-card iai-card--regional">
                        <div class="iai-card__icon">@include('frontend.partials._icon-doc')</div>
                        <div class="iai-card__title">{{ $r->title }}</div>
                        @if($r->description)<p class="iai-card__desc">{{ Str::limit($r->description, 120) }}</p>@endif
                    </a>
                @endforeach
            </div>
        @endif
    </section>

    <hr class="iai-divider">

    {{-- ── Global Resources ── --}}
    <section class="iai-sec mb-5">
        <div class="iai-sec__head">
            <span class="iai-sec__num" style="background:linear-gradient(135deg,#e09a10 0%,#c8870a 100%);">3</span>
            <div>
                <h2 class="iai-sec__title" style="color:#c8870a;">Global Resources</h2>
                <p class="iai-sec__sub">International research and resources on inclusive AI worldwide.</p>
            </div>
        </div>
        @if($globalRepos->isEmpty())
            <div class="iai-empty">No global resources have been tagged yet. Tag Repo items with <code>inclusive_ai</code>, <code>is_our_work = false</code>, and <code>is_global = true</code>.</div>
        @else
            <div class="iai-cards-grid">
                @foreach($globalRepos as $r)
                    <a href="{{ route('repo.single', $r->id) }}" class="iai-card iai-card--global">
                        <div class="iai-card__icon">@include('frontend.partials._icon-doc')</div>
                        <div class="iai-card__title">{{ $r->title }}</div>
                        @if($r->description)<p class="iai-card__desc">{{ Str::limit($r->description, 120) }}</p>@endif
                    </a>
                @endforeach
            </div>
        @endif
    </section>

</div>

<style>
    /* ── Hero ── */
    .iai-hero {
        background: linear-gradient(170deg, #01162e 0%, #022248 50%, #0a3a6e 100%);
        position: relative;
        overflow: hidden;
        padding: 60px 0 90px;
        text-align: center;
    }

    .iai-hero__overlay {
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 70% 40%, rgba(250,175,28,.06) 0%, transparent 50%);
    }

    .iai-hero__content {
        position: relative;
        z-index: 1;
    }

    .iai-label {
        display: inline-block;
        font-size: .7rem;
        font-weight: 700;
        letter-spacing: .14em;
        text-transform: uppercase;
        color: #FAAF1C;
        background: rgba(250,175,28,.1);
        border: 1px solid rgba(250,175,28,.25);
        border-radius: 100px;
        padding: 4px 14px;
        margin-bottom: 1.25rem;
    }

    .iai-hero__title {
        font-size: clamp(1.8rem, 4vw, 2.8rem);
        font-weight: 700;
        color: #fff;
        margin-bottom: .75rem;
        letter-spacing: -.02em;
    }

    .iai-hero__sub {
        font-size: .95rem;
        color: rgba(255,255,255,.55);
        max-width: 540px;
        margin: 0 auto;
        line-height: 1.7;
    }

    .iai-hero__wave {
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 100%;
        line-height: 0;
    }

    .iai-hero__wave svg { width: 100%; height: 60px; }

    /* ── Body ── */
    .iai-body {
        padding-top: 2.5rem;
        padding-bottom: 4rem;
    }

    /* ── Intro ── */
    .iai-intro {
        max-width: 820px;
        margin: 0 auto 3rem;
        padding: 2rem 2.25rem;
        background: #fff;
        border: 1px solid #eef0f3;
        border-left: 4px solid #FAAF1C;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0,0,0,.04);
    }

    .iai-intro__p {
        font-size: .95rem;
        line-height: 1.8;
        color: #374151;
        margin: 0 0 1rem;
    }

    .iai-intro__p:last-of-type { margin-bottom: 0; }

    .iai-coming-soon {
        display: flex;
        align-items: flex-start;
        gap: .6rem;
        margin-top: 1.25rem;
        padding: .85rem 1.1rem;
        background: #fffbeb;
        border: 1px solid #fde68a;
        border-radius: 8px;
        font-size: .87rem;
        color: #92400e;
        line-height: 1.55;
    }

    .iai-coming-soon svg {
        flex-shrink: 0;
        margin-top: .1rem;
        color: #d97706;
    }

    /* ── Section ── */
    .iai-sec__head {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        margin-bottom: 1.5rem;
        padding: 1rem 1.25rem;
        background: #fff;
        border: 1px solid #eef0f3;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0,0,0,.04);
    }

    .iai-sec__num {
        flex: 0 0 44px;
        height: 44px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 1.1rem;
        color: #fff;
    }

    .iai-sec__title {
        font-size: 1.3rem;
        font-weight: 800;
        color: #022248;
        margin: 0 0 .15rem;
        letter-spacing: -.01em;
    }

    .iai-sec__sub {
        font-size: .85rem;
        color: #6b7280;
        margin: 0;
    }

    /* ── Sub-sections ── */
    .iai-subsec {
        padding-inline-start: 1.5rem;
        border-inline-start: 2px dashed #eef0f3;
        margin-inline-start: 1.4rem;
        margin-bottom: 1.75rem;
    }

    .iai-subsec__heading {
        display: flex;
        align-items: center;
        gap: .6rem;
        font-size: 1rem;
        font-weight: 700;
        color: #022248;
        margin-bottom: 1rem;
        padding-bottom: .6rem;
        border-bottom: 2px solid #f0f2f5;
        text-transform: uppercase;
        letter-spacing: .05em;
    }

    .iai-subsec__letter {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 26px;
        height: 26px;
        border-radius: 50%;
        background: #fef9ee;
        color: #c8870a;
        font-weight: 800;
        font-size: .8rem;
        flex-shrink: 0;
    }

    /* ── Cards grid ── */
    .iai-cards-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.25rem;
    }

    .iai-card {
        display: flex;
        flex-direction: column;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 1.5rem;
        text-decoration: none;
        color: #022248;
        position: relative;
        transition: all 0.3s ease;
        min-height: 130px;
    }

    .iai-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(0,0,0,.1);
        text-decoration: none;
        color: #022248;
    }

    .iai-card--research { border-top: 3px solid #FAAF1C; }
    .iai-card--webinar  { border-top: 3px solid #0d9488; }
    .iai-card--edu      { border-top: 3px solid #7c3aed; }
    .iai-card--regional { border-top: 3px solid #006644; }
    .iai-card--global   { border-top: 3px solid #c8870a; }

    .iai-card__icon {
        margin-bottom: .75rem;
    }
    .iai-card--research .iai-card__icon { color: #FAAF1C; }
    .iai-card--webinar  .iai-card__icon { color: #0d9488; }
    .iai-card--edu      .iai-card__icon { color: #7c3aed; }
    .iai-card--regional .iai-card__icon { color: #006644; }
    .iai-card--global   .iai-card__icon { color: #c8870a; }

    .iai-card__title {
        font-size: .95rem;
        font-weight: 600;
        line-height: 1.5;
        flex: 1;
    }

    .iai-card__desc {
        font-size: .82rem;
        color: #6b7280;
        line-height: 1.55;
        margin: .5rem 0 0;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .iai-card__tag {
        display: inline-block;
        background: #f3f4f6;
        color: #6b7280;
        font-size: .75rem;
        font-weight: 600;
        padding: .2rem .65rem;
        border-radius: 20px;
        margin-top: .75rem;
        width: fit-content;
    }

    /* ── Empty state ── */
    .iai-empty {
        padding: 2rem;
        text-align: center;
        color: #9ca3af;
        font-size: .9rem;
        background: #f9fafb;
        border: 1px dashed #e5e7eb;
        border-radius: 10px;
    }

    .iai-empty code {
        background: #f3f4f6;
        padding: .1rem .4rem;
        border-radius: 4px;
        font-size: .82rem;
        color: #374151;
    }

    /* ── Divider ── */
    .iai-divider {
        border: none;
        border-top: 2px solid #e5e7eb;
        margin: 2.5rem 0 3rem;
    }

    /* ── Responsive ── */
    @media (max-width: 992px) {
        .iai-cards-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 576px) {
        .iai-cards-grid { grid-template-columns: 1fr; }
        .iai-hero { padding: 45px 0 75px; }
        .iai-subsec { padding-inline-start: 1rem; margin-inline-start: .8rem; }
    }
</style>

@include('layouts.footers.guest.footer')
@endsection
