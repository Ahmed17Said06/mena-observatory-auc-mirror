@extends('layouts.frontend.app', ['class' => 'g-sidenav-show bg-gray-100'])
<style>#map_outer { display: none !important; }</style>
@section('content')
@include('layouts.navbars.guest.navbar', ['title' => 'About'])

<div class="about-page" @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl" @endif>

    {{-- ══════════════════════════════════════════════════ --}}
    {{-- HERO                                              --}}
    {{-- ══════════════════════════════════════════════════ --}}
    <section class="ab-hero">
        <div class="ab-hero__bg"></div>
        <div class="ab-hero__noise"></div>
        <div class="ab-hero__ring ab-hero__ring--1"></div>
        <div class="ab-hero__ring ab-hero__ring--2"></div>
        <div class="container position-relative" style="z-index:2">
            <span class="ab-eyebrow js-reveal">About Us</span>
            <h1 class="ab-hero__title js-split-title">
                MENA Observatory<br>on Responsible AI
            </h1>
            <div class="ab-hero__rule js-reveal"></div>
            <div class="ab-hero__sub js-reveal">
                @if(isset($intro) && $intro)
                    @if(LaravelLocalization::getCurrentLocale() === 'ar' && $intro->ar_content)
                        {!! $intro->ar_content !!}
                    @else
                        {!! $intro->content !!}
                    @endif
                @else
                    Advancing responsible AI for development and inclusion across the MENA region.
                @endif
            </div>
            <div class="ab-hero__scroll-cue js-reveal">
                <span></span>
            </div>
        </div>
        <div class="ab-hero__wave">
            <svg viewBox="0 0 1440 80" preserveAspectRatio="none">
                <path fill="#f8f9fb" d="M0,40 C360,80 1080,0 1440,40 L1440,80 L0,80 Z"/>
            </svg>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════════ --}}
    {{-- VIDEO                                             --}}
    {{-- ══════════════════════════════════════════════════ --}}
    <section class="ab-video-section">
        <div class="container">
            <div class="ab-video-wrap js-reveal-up">
                <video controls muted autoplay class="ab-video">
                    <source src="{{ url($video_content->media) }}" type="video/mp4">
                    Your browser does not support the video tag.
                    <track src="{{ asset('subtitle/A2K4D - Mena AI - About Us Video - Subs AR.vtt') }}" label="Arabic" kind="captions" srclang="ar" default>
                    <track src="{{ asset('subtitle/A2K4D - Mena AI - About Us Video - Subs ENG.vtt') }}" label="English" kind="captions" srclang="en">
                </video>
            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════════ --}}
    {{-- OUR STORY                                         --}}
    {{-- ══════════════════════════════════════════════════ --}}
    <section class="ab-section ab-story" id="our-story">
        <div class="container">
            <div class="ab-section__label js-reveal">Our Story</div>
            <h2 class="ab-section__title js-reveal-up">Building the Observatory</h2>

            <div class="ab-timeline">
                <div class="ab-timeline__line"></div>

                <div class="ab-timeline__item js-tl-item">
                    <div class="ab-timeline__dot"><span>2010</span></div>
                    <div class="ab-timeline__card">
                        <p>The <strong>Access to Knowledge for Development Center (A2K4D)</strong> at The American University in Cairo's Onsi Sawiris School of Business is established, building a history of advancing knowledge, technology and data for development in the region.</p>
                    </div>
                </div>

                <div class="ab-timeline__item js-tl-item">
                    <div class="ab-timeline__dot"><span>Feb 2024</span></div>
                    <div class="ab-timeline__card">
                        <p>A2K4D launches the <strong>"MENA AI Observatory"</strong> at the Center's 14th anniversary — an output within the project <em>"Governing Responsible AI in the MENA Region"</em>, held in partnership with BirZeit University's Center for Continuing Education and supported by Canada's <strong>IDRC</strong>.</p>
                    </div>
                </div>

                <div class="ab-timeline__item js-tl-item">
                    <div class="ab-timeline__dot"><span>Dec 2024</span></div>
                    <div class="ab-timeline__card">
                        <p>The Observatory becomes a standalone project at A2K4D with continued IDRC support, adopting its current name: <strong>"The MENA Observatory on Responsible AI"</strong>. A2K4D now works through the Observatory on initiatives that capitalize on responsible data and AI for inclusion and achievement of the SDGs across MENA — in collaboration with local, regional, and global partners.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════════ --}}
    {{-- WHY                                               --}}
    {{-- ══════════════════════════════════════════════════ --}}
    <section class="ab-section ab-why" id="why">
        <div class="container">
            <div class="ab-section__label js-reveal">Our Purpose</div>
            <h2 class="ab-section__title js-reveal-up">Why a MENA Observatory<br>on Responsible AI?</h2>

            <div class="ab-why__grid">

                <div class="ab-why__card js-reveal-up">
                    <div class="ab-why__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/>
                        </svg>
                    </div>
                    <h4>Bottom-Up Approach</h4>
                    <p>Highlighting local experiences, community engagement, and inclusive practices — addressing regional nuances, prioritizing gender perspectives, and raising awareness about responsible data and AI usage.</p>
                </div>

                <div class="ab-why__card js-reveal-up">
                    <div class="ab-why__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/><path d="M12 2c0 0-4 5-4 10s4 10 4 10"/><path d="M12 2c0 0 4 5 4 10s-4 10-4 10"/><path d="M2 12h20"/>
                        </svg>
                    </div>
                    <h4>Stakeholder Focal Point</h4>
                    <p>Connecting researchers, policymakers, entrepreneurs, civil society, educators, and beneficiaries — creating dynamic collaborative spaces that promote effective policy making and responsible AI use.</p>
                </div>

                <div class="ab-why__card js-reveal-up">
                    <div class="ab-why__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z"/><path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"/>
                        </svg>
                    </div>
                    <h4>Evidence-Based Research</h4>
                    <p>Furthering innovative, evidence-based research designed to impact policy, practice, and people across the region.</p>
                </div>

                <div class="ab-why__card js-reveal-up">
                    <div class="ab-why__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><path d="M3 9h18"/><path d="M9 21V9"/>
                        </svg>
                    </div>
                    <h4>Multistakeholder Collaboration</h4>
                    <p>Promoting a multistakeholder approach to advance collaboration in responsible data and AI for development across the MENA region.</p>
                </div>

                <div class="ab-why__card js-reveal-up">
                    <div class="ab-why__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                        </svg>
                    </div>
                    <h4>Global Visibility for MENA</h4>
                    <p>Enhancing the visibility and impact of MENA research and experiences in global policy-making spaces, championing regional voices and standards.</p>
                </div>

            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════════ --}}
    {{-- VISION                                            --}}
    {{-- ══════════════════════════════════════════════════ --}}
    <section class="ab-vision" id="vision">
        <div class="ab-vision__bg"></div>
        <div class="container position-relative" style="z-index:2">
            <div class="ab-vision__inner">
                <div class="ab-vision__tag js-reveal">Vision</div>
                <blockquote class="ab-vision__quote js-reveal-up">
                    @if(isset($vision) && $vision)
                        @if(LaravelLocalization::getCurrentLocale() === 'ar' && $vision->ar_content)
                            {!! $vision->ar_content !!}
                        @else
                            {!! $vision->content !!}
                        @endif
                    @else
                        "A dynamic, inclusive and locally-driven platform on responsible AI in MENA — a catalyst for change: a tool for policy making, a hub for connecting stakeholders, and the go-to home for knowledge on responsible AI as it pertains to everyone in the region."
                    @endif
                </blockquote>
            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════════ --}}
    {{-- MISSION                                           --}}
    {{-- ══════════════════════════════════════════════════ --}}
    <section class="ab-section ab-mission" id="mission">
        <div class="container">
            <div class="ab-two-col">
                <div class="ab-two-col__left">
                    <div class="ab-section__label js-reveal">Mission</div>
                    <h2 class="ab-section__title js-reveal-up">What We<br>Set Out to Do</h2>
                    <div class="ab-accent-bar js-reveal"></div>
                </div>
                <div class="ab-two-col__right">
                    <ul class="ab-mission__list">
                        <li class="js-reveal-up">
                            <span class="ab-mission__num">01</span>
                            <span>Inform, influence and monitor policy making and practice as it pertains to responsible AI for development and inclusion in MENA.</span>
                        </li>
                        <li class="js-reveal-up">
                            <span class="ab-mission__num">02</span>
                            <span>Promote a grounds-up inclusive approach, emphasizing local experiences, community engagement, and inclusion in all aspects of data collection and AI systems development.</span>
                        </li>
                        <li class="js-reveal-up">
                            <span class="ab-mission__num">03</span>
                            <span>Raise awareness and fill gaps in knowledge on the responsible use of data and AI in a way that is in line with the nuances of the region.</span>
                        </li>
                        <li class="js-reveal-up">
                            <span class="ab-mission__num">04</span>
                            <span>Connect communities — researchers, policy makers, entrepreneurs, civil society, educators, students and beneficiaries — by creating dynamic collaborative spaces that foster engagement to promote responsible AI for development.</span>
                        </li>
                        <li class="js-reveal-up">
                            <span class="ab-mission__num">05</span>
                            <span>Champion MENA voices, values, and standards in responsible data and AI governance, regionally and globally.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════════ --}}
    {{-- OBJECTIVES                                        --}}
    {{-- ══════════════════════════════════════════════════ --}}
    <section class="ab-objectives" id="objectives">
        <div class="container">
            <div class="ab-section__label ab-section__label--light js-reveal">Objectives</div>
            <h2 class="ab-section__title ab-section__title--light js-reveal-up">Three Pillars of Impact</h2>

            <div class="ab-obj__grid">
                <div class="ab-obj__card js-reveal-up" style="--obj-c:#FAAF1C;">
                    <div class="ab-obj__num">01</div>
                    <div class="ab-obj__bar"></div>
                    <h3 class="ab-obj__title">Responsible AI<br>for Policy</h3>
                    <div class="ab-obj__desc">
                        @if(isset($objective_1) && $objective_1)
                            {!! LaravelLocalization::getCurrentLocale() === 'ar' && $objective_1->ar_content ? $objective_1->ar_content : $objective_1->content !!}
                        @else
                            Informing and influencing evidence-based policy making on responsible data and AI, ensuring MENA perspectives shape governance frameworks regionally and globally.
                        @endif
                    </div>
                </div>
                <div class="ab-obj__card js-reveal-up" style="--obj-c:#4EB89D;">
                    <div class="ab-obj__num">02</div>
                    <div class="ab-obj__bar"></div>
                    <h3 class="ab-obj__title">Responsible AI<br>for Practice</h3>
                    <div class="ab-obj__desc">
                        @if(isset($objective_2) && $objective_2)
                            {!! LaravelLocalization::getCurrentLocale() === 'ar' && $objective_2->ar_content ? $objective_2->ar_content : $objective_2->content !!}
                        @else
                            Advancing inclusive, community-driven approaches to AI development that reflect regional nuances, promote gender equity, and support sustainable development goals.
                        @endif
                    </div>
                </div>
                <div class="ab-obj__card js-reveal-up" style="--obj-c:#6B9FD4;">
                    <div class="ab-obj__num">03</div>
                    <div class="ab-obj__bar"></div>
                    <h3 class="ab-obj__title">Responsible AI<br>for People</h3>
                    <div class="ab-obj__desc">
                        @if(isset($objective_3) && $objective_3)
                            {!! LaravelLocalization::getCurrentLocale() === 'ar' && $objective_3->ar_content ? $objective_3->ar_content : $objective_3->content !!}
                        @else
                            Connecting communities, raising awareness, and empowering individuals — from researchers and policymakers to civil society and beneficiaries — to engage with and benefit from responsible AI.
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Partners section moved to /en/collaborators --}}

</div>

@include('layouts.footers.guest.footer')

{{-- GSAP --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/SplitText.min.js"></script>

<script>
gsap.registerPlugin(ScrollTrigger, SplitText);

document.addEventListener('DOMContentLoaded', function () {

    // ── Hero title word split ──────────────────────────────────────
    const heroTitle = document.querySelector('.ab-hero__title');
    if (heroTitle) {
        const split = new SplitText(heroTitle, { type: 'words' });
        gsap.from(split.words, {
            opacity: 0,
            y: 40,
            stagger: 0.07,
            duration: 0.9,
            ease: 'power3.out',
            delay: 0.2
        });
    }

    // ── Generic fade-up helper ─────────────────────────────────────
    function revealUp(selector, stagger) {
        gsap.utils.toArray(selector).forEach(function (el) {
            gsap.from(el, {
                scrollTrigger: { trigger: el, start: 'top 88%', toggleActions: 'play none none none' },
                opacity: 0,
                y: 30,
                duration: 0.75,
                ease: 'power2.out',
                stagger: stagger || 0
            });
        });
    }

    // ── Generic fade-in ────────────────────────────────────────────
    gsap.utils.toArray('.js-reveal').forEach(function (el) {
        gsap.from(el, {
            scrollTrigger: { trigger: el, start: 'top 90%', toggleActions: 'play none none none' },
            opacity: 0,
            duration: 0.6,
            ease: 'power2.out'
        });
    });

    revealUp('.js-reveal-up');

    // ── Hero eyebrow + sub ─────────────────────────────────────────
    gsap.from('.ab-hero__sub', { opacity: 0, y: 20, duration: 0.8, delay: 0.9, ease: 'power2.out' });
    gsap.from('.ab-hero__rule', { scaleX: 0, duration: 0.7, delay: 0.75, transformOrigin: 'left center', ease: 'power3.out' });
    gsap.from('.ab-hero__scroll-cue', { opacity: 0, duration: 0.6, delay: 1.3 });

    // ── Timeline items stagger ─────────────────────────────────────
    gsap.utils.toArray('.js-tl-item').forEach(function (item, i) {
        const dot  = item.querySelector('.ab-timeline__dot');
        const card = item.querySelector('.ab-timeline__card');
        const tl   = gsap.timeline({
            scrollTrigger: { trigger: item, start: 'top 85%', toggleActions: 'play none none none' }
        });
        tl.from(dot,  { scale: 0, opacity: 0, duration: 0.45, ease: 'back.out(1.7)' })
          .from(card, { opacity: 0, x: 30, duration: 0.55, ease: 'power2.out' }, '-=0.2');
    });

    // ── Why cards stagger ──────────────────────────────────────────
    gsap.from('.ab-why__card', {
        scrollTrigger: { trigger: '.ab-why__grid', start: 'top 85%' },
        opacity: 0, y: 36, stagger: 0.1, duration: 0.65, ease: 'power2.out'
    });

    // ── Objectives stagger ─────────────────────────────────────────
    gsap.from('.ab-obj__card', {
        scrollTrigger: { trigger: '.ab-obj__grid', start: 'top 85%' },
        opacity: 0, y: 40, stagger: 0.15, duration: 0.7, ease: 'power2.out'
    });

    // ── Timeline line draw ─────────────────────────────────────────
    gsap.from('.ab-timeline__line', {
        scrollTrigger: { trigger: '.ab-timeline', start: 'top 80%', end: 'bottom 60%', scrub: 1 },
        scaleY: 0, transformOrigin: 'top center'
    });

    // ── Vision quote word reveal ───────────────────────────────────
    const vq = document.querySelector('.ab-vision__quote');
    if (vq) {
        const vSplit = new SplitText(vq, { type: 'words' });
        gsap.from(vSplit.words, {
            scrollTrigger: { trigger: vq, start: 'top 80%' },
            opacity: 0, y: 20, stagger: 0.04, duration: 0.6, ease: 'power2.out'
        });
    }

    // ── Hero rings float ──────────────────────────────────────────
    gsap.to('.ab-hero__ring--1', { y: -18, duration: 6, repeat: -1, yoyo: true, ease: 'sine.inOut' });
    gsap.to('.ab-hero__ring--2', { y: 14, duration: 8, repeat: -1, yoyo: true, ease: 'sine.inOut', delay: 2 });

});

</script>

<style>
/* ═══════════════════════════════════════════════════════════
   TOKENS
═══════════════════════════════════════════════════════════ */
:root {
    --navy:   #022448;
    --navy-d: #01162e;
    --gold:   #FAAF1C;
    --gold-d: #c8870a;
    --bg:     #f8f9fb;
    --text:   #111827;
    --muted:  #6b7280;
    --border: rgba(0,0,0,.07);
}

.about-page { background: var(--bg); overflow-x: hidden; }

/* ── EYEBROW ── */
.ab-eyebrow {
    display: inline-block;
    font-size: .7rem; font-weight: 700; letter-spacing: .14em;
    text-transform: uppercase;
    color: var(--gold);
    background: rgba(250,175,28,.12);
    border: 1px solid rgba(250,175,28,.25);
    border-radius: 100px;
    padding: 4px 14px;
    margin-bottom: 1.4rem;
}

/* ═══════════════════════════════════════════════════════════
   HERO
═══════════════════════════════════════════════════════════ */
.ab-hero {
    position: relative;
    background: linear-gradient(160deg, var(--navy-d) 0%, var(--navy) 55%, #0a3a6e 100%);
    padding: 60px 0 80px;
    text-align: center;
    overflow: hidden;
}
.ab-hero__bg {
    position: absolute; inset: 0;
    background:
        radial-gradient(circle at 20% 70%, rgba(250,175,28,.06) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255,255,255,.03) 0%, transparent 45%);
}
.ab-hero__noise {
    position: absolute; inset: 0; opacity: .3; pointer-events: none;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.04'/%3E%3C/svg%3E");
    background-size: 256px;
}
.ab-hero__ring {
    position: absolute; border-radius: 50%;
    border: 1px solid rgba(255,255,255,.05);
    pointer-events: none;
}
.ab-hero__ring--1 { width: 480px; height: 480px; top: -160px; right: -120px; }
.ab-hero__ring--2 { width: 320px; height: 320px; bottom: -80px; left: -60px; }

.ab-hero__title {
    font-size: clamp(1.6rem, 4vw, 2.8rem);
    font-weight: 800; color: #fff; line-height: 1.1;
    letter-spacing: -.03em; margin: 0 auto .1rem;
    max-width: 780px;
}
.ab-hero__rule {
    width: 40px; height: 3px; border-radius: 2px;
    background: var(--gold); margin: .9rem auto 1.2rem;
}
.ab-hero__sub {
    font-size: 1rem; color: rgba(255,255,255,.75);
    max-width: 680px; margin: 0 auto; line-height: 1.8;
    text-align: left;
}
.ab-hero__sub *,
.ab-hero__sub p,
.ab-hero__sub li,
.ab-hero__sub span,
.ab-hero__sub strong,
.ab-hero__sub em,
.ab-hero__sub a {
    color: rgba(255,255,255,.85) !important;
}
.ab-hero__sub strong, .ab-hero__sub b {
    color: #fff !important;
    font-weight: 700;
}
.ab-hero__sub ul,
.ab-hero__sub ol {
    list-style: none;
    padding: 0;
    margin: 1.25rem 0 0;
    display: flex;
    flex-direction: column;
    gap: .85rem;
}
.ab-hero__sub ul li,
.ab-hero__sub ol li {
    display: flex;
    align-items: flex-start;
    gap: .75rem;
    font-size: .96rem;
    line-height: 1.7;
    color: rgba(255,255,255,.75);
    padding: .75rem 1rem;
    background: rgba(255,255,255,.05);
    border: 1px solid rgba(255,255,255,.08);
    border-radius: 10px;
    transition: background .25s;
}
.ab-hero__sub ul li::before {
    content: '';
    display: inline-block;
    width: 6px; height: 6px;
    border-radius: 50%;
    background: var(--gold);
    flex-shrink: 0;
    margin-top: .55rem;
}
.ab-hero__scroll-cue {
    margin-top: 3rem;
}
.ab-hero__scroll-cue span {
    display: block; width: 24px; height: 38px;
    border: 2px solid rgba(255,255,255,.2); border-radius: 100px;
    margin: 0 auto; position: relative;
}
.ab-hero__scroll-cue span::after {
    content: '';
    position: absolute; width: 4px; height: 8px;
    background: rgba(255,255,255,.4); border-radius: 2px;
    left: 50%; top: 6px; transform: translateX(-50%);
    animation: ab-scroll 2s ease infinite;
}
@keyframes ab-scroll {
    0%   { opacity: 1; top: 6px; }
    100% { opacity: 0; top: 18px; }
}
.ab-hero__wave {
    position: absolute; bottom: -2px; left: 0; width: 100%; line-height: 0;
}
.ab-hero__wave svg { width: 100%; height: 70px; }

/* ═══════════════════════════════════════════════════════════
   VIDEO
═══════════════════════════════════════════════════════════ */
.ab-video-section { padding: 4rem 0 3rem; background: var(--bg); }
.ab-video-wrap {
    border-radius: 16px; overflow: hidden;
    box-shadow: 0 20px 60px rgba(2,36,72,.12);
    max-width: 900px; margin: 0 auto;
}
.ab-video { width: 100%; display: block; }

/* ═══════════════════════════════════════════════════════════
   COMMON SECTION CHROME
═══════════════════════════════════════════════════════════ */
.ab-section { padding: 5rem 0; background: #fff; }
.ab-section + .ab-section { border-top: 1px solid var(--border); }
.ab-section__label {
    font-size: .7rem; font-weight: 700; letter-spacing: .14em;
    text-transform: uppercase; color: var(--gold-d);
    margin-bottom: .75rem;
}
.ab-section__label--light { color: rgba(255,255,255,.5); }
.ab-section__title {
    font-size: clamp(1.6rem, 3vw, 2.4rem);
    font-weight: 800; color: var(--navy);
    line-height: 1.15; margin: 0 0 2.5rem;
    letter-spacing: -.02em;
}
.ab-section__title--light { color: #fff; }
.ab-accent-bar {
    width: 36px; height: 3px; border-radius: 2px;
    background: var(--gold); margin-bottom: 2.5rem;
}

/* ═══════════════════════════════════════════════════════════
   OUR STORY — TIMELINE
═══════════════════════════════════════════════════════════ */
.ab-story { background: var(--bg) !important; }
.ab-timeline { position: relative; padding: 1rem 0 1rem 2.5rem; }
.ab-timeline__line {
    position: absolute; left: 9px; top: 0; bottom: 0;
    width: 2px; background: linear-gradient(to bottom, var(--gold), rgba(250,175,28,.15));
    border-radius: 1px;
}
.ab-timeline__item {
    display: flex; gap: 1.75rem; margin-bottom: 2.75rem; align-items: flex-start;
    position: relative;
}
.ab-timeline__item:last-child { margin-bottom: 0; }
.ab-timeline__dot {
    flex-shrink: 0; width: 20px; height: 20px; border-radius: 50%;
    background: var(--navy); border: 3px solid var(--gold);
    display: flex; align-items: center; justify-content: center;
    position: relative; left: -2.5rem; margin-right: -20px; margin-top: 4px;
}
.ab-timeline__dot span {
    position: absolute; left: calc(100% + 10px); top: 50%;
    transform: translateY(-50%);
    font-size: .7rem; font-weight: 700; color: var(--gold-d);
    white-space: nowrap; letter-spacing: .04em;
    background: rgba(250,175,28,.08); border: 1px solid rgba(250,175,28,.18);
    padding: 2px 10px; border-radius: 100px;
}
.ab-timeline__card {
    background: #fff; border: 1px solid var(--border);
    border-radius: 12px; padding: 1.5rem 1.75rem;
    flex: 1; box-shadow: 0 2px 12px rgba(2,36,72,.05);
}
.ab-timeline__card p {
    font-size: .92rem; color: var(--muted); line-height: 1.75; margin: 0;
}
.ab-timeline__card strong { color: var(--navy); }

/* ═══════════════════════════════════════════════════════════
   WHY
═══════════════════════════════════════════════════════════ */
.ab-why__grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.25rem;
}
.ab-why__card {
    background: #fff; border: 1px solid var(--border);
    border-radius: 14px; padding: 1.75rem 1.5rem;
    transition: transform .3s, box-shadow .3s;
}
.ab-why__card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 32px rgba(2,36,72,.08);
}
.ab-why__icon {
    width: 48px; height: 48px; border-radius: 12px;
    background: rgba(2,36,72,.05); color: var(--navy);
    display: flex; align-items: center; justify-content: center;
    margin-bottom: 1rem;
}
.ab-why__card h4 {
    font-size: .95rem; font-weight: 700; color: var(--navy); margin: 0 0 .5rem;
}
.ab-why__card p {
    font-size: .85rem; color: var(--muted); line-height: 1.65; margin: 0;
}

/* ═══════════════════════════════════════════════════════════
   VISION
═══════════════════════════════════════════════════════════ */
.ab-vision {
    position: relative;
    background: linear-gradient(135deg, var(--navy-d) 0%, var(--navy) 100%);
    padding: 6rem 0;
    overflow: hidden;
}
.ab-vision__bg {
    position: absolute; inset: 0;
    background: radial-gradient(ellipse at 80% 50%, rgba(250,175,28,.07) 0%, transparent 60%);
}
.ab-vision__inner { max-width: 800px; margin: 0 auto; text-align: center; }
.ab-vision__tag {
    font-size: .7rem; font-weight: 700; letter-spacing: .14em;
    text-transform: uppercase; color: var(--gold);
    display: inline-block; margin-bottom: 2rem;
    background: rgba(250,175,28,.1); border: 1px solid rgba(250,175,28,.2);
    padding: 4px 14px; border-radius: 100px;
}
.ab-vision__quote {
    font-size: clamp(1.2rem, 2.5vw, 1.65rem);
    font-weight: 400; color: rgba(255,255,255,.88);
    line-height: 1.7; font-style: italic;
    border: none; padding: 0; margin: 0;
    quotes: none;
}

/* ═══════════════════════════════════════════════════════════
   MISSION
═══════════════════════════════════════════════════════════ */
.ab-two-col {
    display: grid; grid-template-columns: 280px 1fr; gap: 4rem; align-items: start;
}
.ab-mission__list {
    list-style: none; padding: 0; margin: 0;
    display: flex; flex-direction: column; gap: 1.5rem;
}
.ab-mission__list li {
    display: flex; gap: 1.25rem; align-items: flex-start;
    padding-bottom: 1.5rem; border-bottom: 1px solid var(--border);
}
.ab-mission__list li:last-child { border-bottom: none; padding-bottom: 0; }
.ab-mission__num {
    font-size: 1.35rem; font-weight: 800; color: var(--gold);
    line-height: 1; flex-shrink: 0; width: 32px; padding-top: 2px;
    letter-spacing: -.02em;
}
.ab-mission__list span:last-child {
    font-size: .9rem; color: var(--muted); line-height: 1.7;
}

/* ═══════════════════════════════════════════════════════════
   OBJECTIVES
═══════════════════════════════════════════════════════════ */
.ab-objectives {
    background: var(--navy);
    padding: 5rem 0 6rem;
}
.ab-obj__grid {
    display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem;
    margin-top: 1rem;
}
.ab-obj__card {
    background: rgba(255,255,255,.04);
    border: 1px solid rgba(255,255,255,.08);
    border-radius: 16px; padding: 2.25rem 2rem;
    transition: background .3s, transform .3s;
}
.ab-obj__card:hover {
    background: rgba(255,255,255,.07);
    transform: translateY(-4px);
}
.ab-obj__num {
    font-size: 2.5rem; font-weight: 900; color: var(--obj-c);
    opacity: .25; line-height: 1; margin-bottom: 1rem;
    letter-spacing: -.04em;
}
.ab-obj__bar {
    width: 30px; height: 3px; border-radius: 2px;
    background: var(--obj-c); margin-bottom: 1.25rem;
}
.ab-obj__title {
    font-size: 1.1rem; font-weight: 700; color: #fff;
    line-height: 1.3; margin: 0 0 .75rem;
}
.ab-obj__desc {
    font-size: .85rem; color: rgba(255,255,255,.85) !important; line-height: 1.7; margin: 0;
}
.ab-obj__desc *,
.ab-obj__desc p,
.ab-obj__desc li,
.ab-obj__desc span {
    color: rgba(255,255,255,.85) !important;
}


/* ═══════════════════════════════════════════════════════════
   RESPONSIVE
═══════════════════════════════════════════════════════════ */
@media (max-width: 1100px) {
    .ab-why__grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 991px) {
    .ab-two-col { grid-template-columns: 1fr; gap: 2rem; }
    .ab-obj__grid { grid-template-columns: 1fr; gap: 1rem; }
    .ab-hero { padding: 50px 0 70px; }
}
@media (max-width: 640px) {
    .ab-why__grid { grid-template-columns: 1fr; }
    .ab-timeline { padding-left: 1.5rem; }
    .ab-timeline__dot { left: -1.5rem; }
    .ab-timeline__dot span { display: none; }
    .ab-hero { padding: 40px 0 60px; }
}

/* RTL adjustments */
[dir="rtl"] .ab-timeline { padding-left: 0; padding-right: 2.5rem; }
[dir="rtl"] .ab-timeline__line { left: auto; right: 9px; }
[dir="rtl"] .ab-timeline__dot { left: auto; right: -2.5rem; margin-right: 0; margin-left: -20px; }
[dir="rtl"] .ab-timeline__dot span { left: auto; right: calc(100% + 10px); }
[dir="rtl"] .ab-hero__rule { margin-left: auto; margin-right: auto; }
[dir="rtl"] .ab-accent-bar { margin-left: 0; }
</style>

@endsection
