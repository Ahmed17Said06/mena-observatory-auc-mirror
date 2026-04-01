<div>

<style>
:root {
    --p-navy: #022248;
    --p-gold: #FAAF1C;
    --p-gold-d: #c8870a;
    --p-border: #e8eaed;
    --p-bg: #f8f9fb;
}

.pt-page {
    background: #fff;
    padding-bottom: 4rem;
}

/* ── Hero ─────────────────────────────────────────────── */
.pt-hero {
    background: var(--p-bg);
    padding: 4rem 0 3rem;
    text-align: center;
    border-bottom: 1px solid var(--p-border);
}
.pt-hero__label {
    display: inline-block;
    font-size: .7rem; font-weight: 700; letter-spacing: .14em;
    text-transform: uppercase; color: var(--p-gold-d);
    background: rgba(200,135,10,.08);
    border: 1px solid rgba(200,135,10,.2);
    padding: 4px 14px; border-radius: 20px;
    margin-bottom: 1rem;
}
.pt-hero__title {
    font-size: clamp(1.8rem, 3.5vw, 2.8rem);
    font-weight: 800; color: var(--p-navy);
    line-height: 1.15; letter-spacing: -.02em;
    margin: 0 0 1rem;
}
.pt-hero__line {
    width: 40px; height: 3px;
    background: var(--p-gold); border-radius: 2px;
    margin: 0 auto 1.25rem;
}
.pt-hero__desc {
    font-size: 1rem; color: #555; max-width: 560px;
    margin: 0 auto; line-height: 1.7;
}

/* ── Tabs ─────────────────────────────────────────────── */
.pt-tabs {
    display: flex; flex-wrap: wrap; justify-content: center;
    gap: .5rem; padding: 2rem 1rem 0;
}
.pt-tab {
    font-size: .78rem; font-weight: 600; letter-spacing: .06em;
    text-transform: uppercase; color: #666;
    background: var(--p-bg); border: 1px solid var(--p-border);
    padding: 7px 18px; border-radius: 20px;
    cursor: pointer; transition: all .25s;
    text-decoration: none;
}
.pt-tab:hover, .pt-tab.active {
    background: var(--p-navy); color: #fff;
    border-color: var(--p-navy);
}

/* ── Groups ───────────────────────────────────────────── */
.pt-section {
    padding: 3rem 0 1rem;
}
.pt-group {
    margin-bottom: 3.5rem;
    scroll-margin-top: 80px;
}
.pt-group__title {
    font-size: .75rem; font-weight: 700; letter-spacing: .14em;
    text-transform: uppercase; color: var(--p-navy);
    border-bottom: 2px solid var(--p-gold); display: inline-block;
    padding-bottom: 5px; margin-bottom: 2rem;
}
.pt-group__title-bar {
    display: flex; align-items: center; gap: 1rem;
    margin-bottom: 2rem;
}
.pt-group__title-bar::after {
    content: ''; flex: 1; height: 1px; background: var(--p-border);
}

/* ── Logo grid ────────────────────────────────────────── */
.pt-logos {
    display: flex; flex-wrap: wrap;
    align-items: center; justify-content: center;
    gap: 1.5rem 2.5rem;
}
.pt-logo {
    display: flex; align-items: center; justify-content: center;
    width: 140px; height: 80px;
    background: #fff;
    border: 1px solid var(--p-border);
    border-radius: 8px;
    padding: 12px;
    transition: box-shadow .25s, transform .25s, border-color .25s;
}
.pt-logo:hover {
    box-shadow: 0 4px 16px rgba(2,34,72,.1);
    transform: translateY(-3px);
    border-color: rgba(200,135,10,.4);
}
.pt-logo img {
    max-width: 100%; max-height: 100%;
    width: auto; height: auto;
    object-fit: contain;
    filter: grayscale(20%);
    transition: filter .25s;
}
.pt-logo:hover img { filter: grayscale(0%); }

@media (max-width: 576px) {
    .pt-logo { width: 110px; height: 64px; }
    .pt-tabs { padding-top: 1.5rem; }
}
</style>

<div class="pt-page">

    {{-- Hero --}}
    <div class="pt-hero">
        <div class="container">
            <span class="pt-hero__label">Network</span>
            <h1 class="pt-hero__title">Our Collaborators &amp; Partners</h1>
            <div class="pt-hero__line"></div>
            <p class="pt-hero__desc">We work with a wide network of national, regional, and global organisations committed to responsible AI and digital inclusion across the MENA region and beyond.</p>
        </div>
    </div>

    {{-- Quick-jump tabs --}}
    <div class="container">
        <div class="pt-tabs">
            <a class="pt-tab" href="#networks">Networks &amp; Initiatives</a>
            <a class="pt-tab" href="#national">National Partners</a>
            <a class="pt-tab" href="#regional">Regional Partners</a>
            <a class="pt-tab" href="#global">Global Research Partners</a>
            <a class="pt-tab" href="#funding">Research Funding</a>
        </div>
    </div>

    <div class="pt-section">
        <div class="container">

            {{-- ── Networks & Initiatives ─────────────────────── --}}
            <div class="pt-group" id="networks">
                <div class="pt-group__title-bar">
                    <span class="pt-group__title">Networks &amp; Initiatives</span>
                </div>
                <div class="pt-logos">
                    <div class="pt-logo"><img src="/img/partners/image1.png"  alt="A2KGA"></div>
                    <div class="pt-logo"><img src="/img/partners/image2.png"  alt="openAIR"></div>
                    <div class="pt-logo"><img src="/img/partners/image3.jpg"  alt="Fairwork"></div>
                    <div class="pt-logo"><img src="/img/partners/image4.png"  alt="A+ Alliance"></div>
                    <div class="pt-logo"><img src="/img/partners/image5.png"  alt="CopyrightX"></div>
                    <div class="pt-logo"><img src="/img/partners/image6.png"  alt="D4D.net"></div>
                    <div class="pt-logo"><img src="/img/partners/image7.png"  alt="Feminist AI Research Network"></div>
                    <div class="pt-logo"><img src="/img/partners/image8.png"  alt="Global AI Narratives MENA"></div>
                    <div class="pt-logo"><img src="/img/partners/image9.png"  alt="Global AI Narratives"></div>
                    <div class="pt-logo"><img src="/img/partners/image10.png" alt="EQUALS Global Partnership"></div>
                    <div class="pt-logo"><img src="/img/partners/image11.png" alt="AUC A2K4D"></div>
                    <div class="pt-logo"><img src="/img/partners/image12.png" alt="Global Index on Responsible AI"></div>
                    <div class="pt-logo"><img src="/img/partners/image13.png" alt="Open for Good"></div>
                    <div class="pt-logo"><img src="/img/partners/image14.png" alt="IASEAI"></div>
                    <div class="pt-logo"><img src="/img/partners/image15.png" alt="NoC"></div>
                    <div class="pt-logo"><img src="/img/partners/image16.png" alt="iRAISE"></div>
                </div>
            </div>

            {{-- ── National Partners ──────────────────────────── --}}
            <div class="pt-group" id="national">
                <div class="pt-group__title-bar">
                    <span class="pt-group__title">National Partners</span>
                </div>
                <div class="pt-logos">
                    <div class="pt-logo"><img src="/img/partners/image17.png" alt="Synapse Analytics"></div>
                    <div class="pt-logo"><img src="/img/partners/image18.png" alt="Ideas GYM Studio"></div>
                    <div class="pt-logo"><img src="/img/partners/image19.png" alt="Shamseya"></div>
                    <div class="pt-logo"><img src="/img/partners/image20.png" alt="Masaar"></div>
                    <div class="pt-logo"><img src="/img/partners/image21.png" alt="ITIDA"></div>
                    <div class="pt-logo"><img src="/img/partners/image22.png" alt="Microsoft"></div>
                    <div class="pt-logo"><img src="/img/partners/image23.png" alt="UNDP Egypt"></div>
                    <div class="pt-logo"><img src="/img/partners/image24.png" alt="CCCPA"></div>
                    <div class="pt-logo"><img src="/img/partners/image25.png" alt="ADSERO Law Firm"></div>
                    <div class="pt-logo"><img src="/img/partners/image26.jpg" alt="APCO Worldwide"></div>
                    <div class="pt-logo"><img src="/img/partners/image27.jpg" alt="Motoon"></div>
                    <div class="pt-logo"><img src="/img/partners/image28.jpg" alt="Qodwa.tech"></div>
                    <div class="pt-logo"><img src="/img/partners/image29.jpg" alt="Internet Society Egypt"></div>
                    <div class="pt-logo"><img src="/img/partners/image30.png" alt="Capgemini"></div>
                    <div class="pt-logo"><img src="/img/partners/image31.jpg" alt="Amazon.eg"></div>
                    <div class="pt-logo"><img src="/img/partners/image32.png" alt="IT-BLOCKS"></div>
                    <div class="pt-logo"><img src="/img/partners/image33.jpg" alt="WEN"></div>
                    <div class="pt-logo"><img src="/img/partners/image34.png" alt="Vodafone Egypt Foundation"></div>
                    <div class="pt-logo"><img src="/img/partners/image35.jpg" alt="EntreprenElle"></div>
                    <div class="pt-logo"><img src="/img/partners/image36.png" alt="DevisionX"></div>
                    <div class="pt-logo"><img src="/img/partners/image37.png" alt="IBM"></div>
                </div>
            </div>

            {{-- ── Regional Partners ──────────────────────────── --}}
            <div class="pt-group" id="regional">
                <div class="pt-group__title-bar">
                    <span class="pt-group__title">Regional Partners</span>
                </div>
                <div class="pt-logos">
                    <div class="pt-logo"><img src="/img/partners/image38.png" alt="Knowledge to Policy Center"></div>
                    <div class="pt-logo"><img src="/img/partners/image39.png" alt="JOSA"></div>
                    <div class="pt-logo"><img src="/img/partners/image40.png" alt="Barralaman"></div>
                    <div class="pt-logo"><img src="/img/partners/image41.jpg" alt="IMPACT for Development"></div>
                    <div class="pt-logo"><img src="/img/partners/image42.jpg" alt="IISR"></div>
                    <div class="pt-logo"><img src="/img/partners/image43.png" alt="Regional Partner"></div>
                    <div class="pt-logo"><img src="/img/partners/image44.png" alt="American University of Beirut"></div>
                    <div class="pt-logo"><img src="/img/partners/image45.png" alt="GUPAP"></div>
                    <div class="pt-logo"><img src="/img/partners/image46.png" alt="Yarmouk University"></div>
                    <div class="pt-logo"><img src="/img/partners/image47.jpg" alt="TILI"></div>
                    <div class="pt-logo"><img src="/img/partners/image48.png" alt="Solidarity Center"></div>
                    <div class="pt-logo"><img src="/img/partners/image49.png" alt="The Policy Initiative"></div>
                    <div class="pt-logo"><img src="/img/partners/image50.png" alt="Phenix"></div>
                    <div class="pt-logo"><img src="/img/partners/image51.png" alt="CCE Birzeit"></div>
                    <div class="pt-logo"><img src="/img/partners/image52.png" alt="SETS North Africa"></div>
                    <div class="pt-logo"><img src="/img/partners/image53.png" alt="WebRadar"></div>
                    <div class="pt-logo"><img src="/img/partners/image54.png" alt="NO2TA"></div>
                    <div class="pt-logo"><img src="/img/partners/image55.png" alt="Lebanese American University"></div>
                    <div class="pt-logo"><img src="/img/partners/image56.png" alt="InfoTimes"></div>
                </div>
            </div>

            {{-- ── Global Research Partners ────────────────────── --}}
            <div class="pt-group" id="global">
                <div class="pt-group__title-bar">
                    <span class="pt-group__title">Global Research Partners</span>
                </div>
                <div class="pt-logos">
                    <div class="pt-logo"><img src="/img/partners/image57.png" alt="CIPIT Strathmore"></div>
                    <div class="pt-logo"><img src="/img/partners/image58.png" alt="University of Johannesburg"></div>
                    <div class="pt-logo"><img src="/img/partners/image59.png" alt="UCT IP Unit"></div>
                    <div class="pt-logo"><img src="/img/partners/image60.png" alt="University of Cambridge"></div>
                    <div class="pt-logo"><img src="/img/partners/image61.png" alt="Yale ISP"></div>
                    <div class="pt-logo"><img src="/img/partners/image62.png" alt="ITS Rio"></div>
                    <div class="pt-logo"><img src="/img/partners/image63.png" alt="Berkman Klein Center Harvard"></div>
                    <div class="pt-logo"><img src="/img/partners/image64.png" alt="Centre for Internet &amp; Society"></div>
                    <div class="pt-logo"><img src="/img/partners/image65.jpg" alt="Oxford Internet Institute"></div>
                    <div class="pt-logo"><img src="/img/partners/image66.jpg" alt="University of Cape Town"></div>
                    <div class="pt-logo"><img src="/img/partners/image67.png" alt="Global Center on AI Governance"></div>
                    <div class="pt-logo"><img src="/img/partners/image68.jpg" alt="African Observatory on Responsible AI"></div>
                    <div class="pt-logo"><img src="/img/partners/image69.png" alt="Leverhulme CFI"></div>
                    <div class="pt-logo"><img src="/img/partners/image70.png" alt="University of Ottawa CLTS"></div>
                    <div class="pt-logo"><img src="/img/partners/image71.png" alt="Meta"></div>
                    <div class="pt-logo"><img src="/img/partners/image72.png" alt="UNESCO IFAP"></div>
                    <div class="pt-logo"><img src="/img/partners/image73.jpg" alt="GIZ"></div>
                    <div class="pt-logo"><img src="/img/partners/image74.jpg" alt="Friedrich Ebert Stiftung"></div>
                    <div class="pt-logo"><img src="/img/partners/image75.png" alt="Anna Lindh Foundation"></div>
                    <div class="pt-logo"><img src="/img/partners/image76.png" alt="iRAISE"></div>
                </div>
            </div>

            {{-- ── Research Funding Partners ───────────────────── --}}
            <div class="pt-group" id="funding">
                <div class="pt-group__title-bar">
                    <span class="pt-group__title">Research Funding Partners</span>
                </div>
                <div class="pt-logos">
                    <div class="pt-logo"><img src="/img/partners/image77.png" alt="IDRC"></div>
                    <div class="pt-logo"><img src="/img/partners/image78.png" alt="Birzeit University"></div>
                    <div class="pt-logo"><img src="/img/partners/image79.png" alt="WZB Berlin"></div>
                    <div class="pt-logo"><img src="/img/partners/image80.png" alt="MacArthur Foundation"></div>
                    <div class="pt-logo"><img src="/img/partners/image81.png" alt="UCT IP Unit"></div>
                    <div class="pt-logo"><img src="/img/partners/image82.png" alt="Academy of Scientific Research and Technology"></div>
                    <div class="pt-logo"><img src="/img/partners/image83.jpg" alt="SSHRC Canada"></div>
                    <div class="pt-logo"><img src="/img/partners/image84.png" alt="National Endowment for Democracy"></div>
                    <div class="pt-logo"><img src="/img/partners/image85.png" alt="Anna Lindh Foundation"></div>
                    <div class="pt-logo"><img src="/img/partners/image86.png" alt="Ford Foundation"></div>
                </div>
            </div>

        </div>
    </div>

</div>

<script>
// Highlight active tab on scroll
(function () {
    const tabs = document.querySelectorAll('.pt-tab');
    const groups = document.querySelectorAll('.pt-group');
    if (!tabs.length || !groups.length) return;

    const observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                const id = entry.target.id;
                tabs.forEach(function (t) { t.classList.remove('active'); });
                const active = document.querySelector('.pt-tab[href="#' + id + '"]');
                if (active) active.classList.add('active');
            }
        });
    }, { rootMargin: '-30% 0px -60% 0px' });

    groups.forEach(function (g) { observer.observe(g); });
})();
</script>

</div>
