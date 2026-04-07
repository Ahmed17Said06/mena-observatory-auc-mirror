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
            <h2 class="ab-section__title js-reveal-up">Our Story</h2>

            <div class="ab-timeline">
                <div class="ab-timeline__line"></div>

                <div class="ab-timeline__item js-tl-item">
                    <div class="ab-timeline__dot"><span>2010</span></div>
                    <div class="ab-timeline__card">
                        <p>The <strong>Access to Knowledge for Development Center (A2K4D)</strong> based at The American University in Cairo's Onsi Sawiris School of Business operates the MENA Observatory on Responsible AI building on its history of advancing knowledge, technology and data for development in the region since inception in February 2010.</p>
                    </div>
                </div>

                <div class="ab-timeline__item js-tl-item">
                    <div class="ab-timeline__dot"><span>Feb 2024</span></div>
                    <div class="ab-timeline__card">
                        <p>The Observatory was initially developed by A2K4D and launched at the Center's 14th anniversary in February 2024 as the <strong>"MENA AI Observatory"</strong>. A2K4D established the Observatory as one of its outputs within the project <em>"Governing Responsible AI in the MENA Region"</em>, held in partnership with BirZeit University's Center for Continuing Education in Palestine and support from Canada's <strong>International Development Research Centre (IDRC)</strong>.</p>
                    </div>
                </div>

                <div class="ab-timeline__item js-tl-item">
                    <div class="ab-timeline__dot"><span>Dec 2024</span></div>
                    <div class="ab-timeline__card">
                        <p>In December 2024, the Observatory became a standalone project at A2K4D, with support from IDRC, carrying its current name, <strong>"The MENA Observatory on Responsible AI"</strong>. Since then, A2K4D has been working through Observatory on initiatives that capitalize on responsible data and AI for inclusion and achievement of the sustainable development goals in MENA, in collaboration with a host of local, regional and global partners.</p>
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
            <p class="ab-why__intro js-reveal-up">The Observatory was developed to address the following:</p>

            <div class="ab-why__grid">

                <div class="ab-why__card js-reveal-up">
                    <div class="ab-why__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/>
                        </svg>
                    </div>
                    <h4>Bottom-Up Approach</h4>
                    <p>The need to advance a bottom-up approach that highlights local experiences, community engagement, and inclusive practices in data collection and AI system development, addressing regional nuances, prioritizing gender perspectives and raising awareness about responsible data and AI usage.</p>
                </div>

                <div class="ab-why__card js-reveal-up">
                    <div class="ab-why__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/><path d="M12 2c0 0-4 5-4 10s4 10 4 10"/><path d="M12 2c0 0 4 5 4 10s-4 10-4 10"/><path d="M2 12h20"/>
                        </svg>
                    </div>
                    <h4>Stakeholder Focal Point</h4>
                    <p>The need to establish a focal point connecting various stakeholders—including researchers, policymakers, entrepreneurs, civil society, educators, and beneficiaries—by creating dynamic collaborative spaces that promote effective policy making and advance the responsible use of AI.</p>
                </div>

                <div class="ab-why__card js-reveal-up">
                    <div class="ab-why__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z"/><path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"/>
                        </svg>
                    </div>
                    <h4>Evidence-Based Research</h4>
                    <p>The need to further innovative evidence based research to impact policy, practice and people.</p>
                </div>

                <div class="ab-why__card js-reveal-up">
                    <div class="ab-why__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><path d="M3 9h18"/><path d="M9 21V9"/>
                        </svg>
                    </div>
                    <h4>Multistakeholder Collaboration</h4>
                    <p>The need to promote a multistakeholder approach to advance collaboration in responsible data and Artificial Intelligence for development.</p>
                </div>

                <div class="ab-why__card js-reveal-up">
                    <div class="ab-why__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                        </svg>
                    </div>
                    <h4>Global Visibility for MENA</h4>
                    <p>The need to enhance visibility and impact of MENA research and experiences in global policy-making spaces.</p>
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
                    As a dynamic, inclusive and locally-driven platform on responsible AI in MENA, the Observatory is envisioned to serve as a catalyst for change by being a tool for policy making, a hub for connecting stakeholders and communities and the go-to home for any and all knowledge on responsible AI as it pertains to the lives of everyone in the region.
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
                            <span>To inform, influence and monitor policy making and practice as it pertains to responsible AI for development and inclusion in MENA.</span>
                        </li>
                        <li class="js-reveal-up">
                            <span class="ab-mission__num">02</span>
                            <span>To promote a grounds-up inclusive approach, emphasizing local experiences, community engagement, and inclusion in all aspects of data collection and AI systems development.</span>
                        </li>
                        <li class="js-reveal-up">
                            <span class="ab-mission__num">03</span>
                            <span>To raise awareness and fill gaps in knowledge on the responsible use of data and AI in a way that is in line with the nuances of the region.</span>
                        </li>
                        <li class="js-reveal-up">
                            <span class="ab-mission__num">04</span>
                            <span>To connect communities – researchers, policy makers, entrepreneurs, civil society, educators, students and beneficiaries, by creating dynamic collaborative spaces that foster engagement between the different stakeholders to promote policy making that fulfills the promise of responsible AI for development.</span>
                        </li>
                        <li class="js-reveal-up">
                            <span class="ab-mission__num">05</span>
                            <span>To champion MENA voices, values, and standards in responsible data and AI governance, regionally and globally and share experiences accordingly.</span>
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
            <div class="ab-obj__subtitle js-reveal">Three Pillars of Impact</div>
            <h2 class="ab-section__title ab-section__title--light js-reveal-up">Objectives</h2>
            <p class="ab-obj__intro js-reveal">Rooted in the above-mentioned vision and mission, the overarching objective of the MENA Observatory on Responsible AI can be broken down into three main categories.</p>

            <div class="ab-obj__grid">
                <div class="ab-obj__card js-obj-card" style="--obj-c:#FAAF1C;">
                    <div class="ab-obj__num">01</div>
                    <div class="ab-obj__bar"></div>
                    <h3 class="ab-obj__title">Responsible AI<br>for Policy</h3>
                </div>
                <div class="ab-obj__card js-obj-card" style="--obj-c:#4EB89D;">
                    <div class="ab-obj__num">02</div>
                    <div class="ab-obj__bar"></div>
                    <h3 class="ab-obj__title">Responsible AI<br>for Practice</h3>
                </div>
                <div class="ab-obj__card js-obj-card" style="--obj-c:#6B9FD4;">
                    <div class="ab-obj__num">03</div>
                    <div class="ab-obj__bar"></div>
                    <h3 class="ab-obj__title">Responsible AI<br>for People</h3>
                </div>
            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════════ --}}
    {{-- SEND A MESSAGE                                    --}}
    {{-- ══════════════════════════════════════════════════ --}}
    <section class="ab-section ab-contact" id="contact">
        <div class="container">
            <div class="ab-contact__wrap">
                <div class="ab-contact__left">
                    <div class="ab-section__label js-reveal">Get in Touch</div>
                    <h2 class="ab-section__title js-reveal-up">Send Us<br>a Message</h2>
                    <div class="ab-accent-bar js-reveal"></div>
                    <p class="ab-contact__text js-reveal-up">Have a question, suggestion, or want to collaborate? We'd love to hear from you.</p>
                </div>
                <div class="ab-contact__right">
                    <form class="ab-contact__form js-reveal-up" action="#" method="POST">
                        @csrf
                        <div class="ab-contact__row">
                            <div class="ab-contact__field">
                                <label for="contact-name">Name</label>
                                <input type="text" id="contact-name" name="name" placeholder="Your name" required>
                            </div>
                            <div class="ab-contact__field">
                                <label for="contact-email">Email</label>
                                <input type="email" id="contact-email" name="email" placeholder="Your email" required>
                            </div>
                        </div>
                        <div class="ab-contact__field">
                            <label for="contact-message">Message</label>
                            <textarea id="contact-message" name="message" placeholder="Your message" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="ab-contact__btn">
                            <span>Send Message</span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

</div>

@include('layouts.footers.guest.footer')

{{-- GSAP --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

<script>
gsap.registerPlugin(ScrollTrigger);

document.addEventListener('DOMContentLoaded', function () {

    // ── Hero title fade ────────────────────────────────────────────
    const heroTitle = document.querySelector('.ab-hero__title');
    if (heroTitle) {
        gsap.from(heroTitle, {
            opacity: 0,
            y: 40,
            duration: 0.9,
            ease: 'power3.out',
            delay: 0.2
        });
    }

    // ── Generic fade-up helper ─────────────────────────────────────
    function revealUp(selector) {
        gsap.utils.toArray(selector).forEach(function (el) {
            gsap.from(el, {
                scrollTrigger: { trigger: el, start: 'top 88%', toggleActions: 'play none none none' },
                opacity: 0, y: 30, duration: 0.75, ease: 'power2.out',
                immediateRender: false
            });
        });
    }

    // ── Generic fade-in ────────────────────────────────────────────
    gsap.utils.toArray('.js-reveal').forEach(function (el) {
        gsap.from(el, {
            scrollTrigger: { trigger: el, start: 'top 90%', toggleActions: 'play none none none' },
            opacity: 0, duration: 0.6, ease: 'power2.out',
            immediateRender: false
        });
    });

    revealUp('.js-reveal-up');

    // ── Hero eyebrow + sub ─────────────────────────────────────────
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
        opacity: 0, y: 36, stagger: 0.1, duration: 0.65, ease: 'power2.out',
        immediateRender: false
    });

    // ── Objectives stagger ─────────────────────────────────────────
    gsap.from('.ab-obj__card', {
        scrollTrigger: { trigger: '.ab-obj__grid', start: 'top 90%', toggleActions: 'play none none none' },
        opacity: 0, y: 40, stagger: 0.15, duration: 0.7, ease: 'power2.out',
        immediateRender: false
    });

    // ── Timeline line draw ─────────────────────────────────────────
    gsap.from('.ab-timeline__line', {
        scrollTrigger: { trigger: '.ab-timeline', start: 'top 80%', end: 'bottom 60%', scrub: 1 },
        scaleY: 0, transformOrigin: 'top center'
    });

    // ── Vision quote fade ─────────────────────────────────────────
    const vq = document.querySelector('.ab-vision__quote');
    if (vq) {
        gsap.from(vq, {
            scrollTrigger: { trigger: vq, start: 'top 80%' },
            opacity: 0, y: 20, duration: 0.8, ease: 'power2.out',
            immediateRender: false
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
.ab-section__label--light { color: rgba(255,255,255,.75); }
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
    position: absolute; bottom: calc(100% + 8px); left: 50%;
    transform: translateX(-50%);
    font-size: .7rem; font-weight: 700; color: var(--gold-d);
    white-space: nowrap; letter-spacing: .04em;
    background: rgba(250,175,28,.12); border: 1px solid rgba(250,175,28,.3);
    padding: 2px 10px; border-radius: 100px;
    z-index: 2;
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
.ab-why__intro {
    font-size: .95rem; color: var(--muted); line-height: 1.7;
    margin: -1.5rem 0 2rem; max-width: 700px;
}
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
.ab-mission .ab-section__label {
    font-size: 1.1rem; letter-spacing: .08em;
}
.ab-mission .ab-section__title {
    font-size: clamp(1.1rem, 2vw, 1.6rem);
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
.ab-obj__intro {
    font-size: .88rem; color: rgba(255,255,255,.65); line-height: 1.7;
    margin: -1.5rem 0 2.5rem; max-width: 700px;
}
.ab-obj__subtitle {
    font-size: .7rem; font-weight: 700; letter-spacing: .14em;
    text-transform: uppercase; color: rgba(255,255,255,.5);
    margin-bottom: .75rem;
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
    opacity: .55; line-height: 1; margin-bottom: 1rem;
    letter-spacing: -.04em;
}
.ab-obj__bar {
    width: 30px; height: 3px; border-radius: 2px;
    background: var(--obj-c); margin-bottom: 1.25rem;
}
.ab-obj__title {
    font-size: 1.1rem; font-weight: 700; color: rgba(255,255,255,.95);
    line-height: 1.3; margin: 0 0 .75rem; text-transform: uppercase; letter-spacing: .04em;
}
/* ═══════════════════════════════════════════════════════════
   CONTACT / SEND A MESSAGE
═══════════════════════════════════════════════════════════ */
.ab-contact { background: var(--bg) !important; }
.ab-contact__wrap {
    display: grid; grid-template-columns: 280px 1fr; gap: 4rem; align-items: start;
}
.ab-contact__text {
    font-size: .9rem; color: var(--muted); line-height: 1.7; margin: 0;
}
.ab-contact__form {
    display: flex; flex-direction: column; gap: 1.25rem;
}
.ab-contact__row {
    display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;
}
.ab-contact__field {
    display: flex; flex-direction: column; gap: .4rem;
}
.ab-contact__field label {
    font-size: .75rem; font-weight: 600; color: var(--navy);
    letter-spacing: .03em; text-transform: uppercase;
}
.ab-contact__field input,
.ab-contact__field textarea {
    font-family: inherit;
    font-size: .9rem; color: var(--text);
    padding: .75rem 1rem;
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 10px;
    outline: none;
    transition: border-color .25s, box-shadow .25s;
}
.ab-contact__field input:focus,
.ab-contact__field textarea:focus {
    border-color: var(--gold);
    box-shadow: 0 0 0 3px rgba(250,175,28,.12);
}
.ab-contact__field textarea { resize: vertical; min-height: 110px; }
.ab-contact__btn {
    align-self: flex-start;
    display: inline-flex; align-items: center; gap: .6rem;
    padding: .7rem 1.75rem;
    font-family: inherit; font-size: .85rem; font-weight: 700;
    color: #fff; background: var(--navy);
    border: none; border-radius: 10px; cursor: pointer;
    transition: background .25s, transform .2s, box-shadow .25s;
}
.ab-contact__btn:hover {
    background: var(--gold);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(250,175,28,.25);
}

/* ═══════════════════════════════════════════════════════════
   RESPONSIVE
═══════════════════════════════════════════════════════════ */
@media (max-width: 1100px) {
    .ab-why__grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 991px) {
    .ab-two-col { grid-template-columns: 1fr; gap: 2rem; }
    .ab-contact__wrap { grid-template-columns: 1fr; gap: 2rem; }
    .ab-obj__grid { grid-template-columns: 1fr; gap: 1rem; }
    .ab-hero { padding: 50px 0 70px; }
}
@media (max-width: 640px) {
    .ab-why__grid { grid-template-columns: 1fr; }
    .ab-timeline { padding-left: 1.5rem; }
    .ab-timeline__dot { left: -1.5rem; }
    .ab-timeline__dot span { display: none; }
    .ab-hero { padding: 40px 0 60px; }
    .ab-contact__row { grid-template-columns: 1fr; }
}

/* RTL adjustments */
[dir="rtl"] .ab-timeline { padding-left: 0; padding-right: 2.5rem; }
[dir="rtl"] .ab-timeline__line { left: auto; right: 9px; }
[dir="rtl"] .ab-timeline__dot { left: auto; right: -2.5rem; margin-right: 0; margin-left: -20px; }
[dir="rtl"] .ab-timeline__dot span { left: auto; right: calc(100% + 10px); }
[dir="rtl"] .ab-hero__rule { margin-left: auto; margin-right: auto; }
[dir="rtl"] .ab-accent-bar { margin-left: 0; }
[dir="rtl"] .ab-contact__btn { align-self: flex-end; }
</style>

@endsection
