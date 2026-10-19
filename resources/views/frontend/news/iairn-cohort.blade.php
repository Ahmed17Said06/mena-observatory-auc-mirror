@extends('layouts.frontend.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('title', 'Announcing the IAIRN MENA Hub Cohort | MENA Observatory')

@php
    /*
     * The cohort. `logo` is a file under public/img/iairn/logos/ (the `mono`
     * monogram is shown until one is supplied); `social` lists [platform key from
     * $platforms, URL, optional button text] rendered as buttons under the
     * project name; the text defaults to the platform name.
     */
    $cohort = [
        [
            'name'    => 'Gamification, Artificial Intelligence (AI) and mHealth Network for Maternal Health Improvement (GAIN MHI)',
            'short'   => 'GAIN MHI',
            'mono'    => 'GAIN',
            'country' => 'Lebanon/Morocco',
            'sector'  => 'Gender/Healthcare',
            'desc'    => 'A pilot AI-powered, gamified mobile learning app adapted from Lebanon to Morocco to strengthen the knowledge of obstetricians and midwives in maternal healthcare. It is gender transformative by empowering the predominantly female maternal health workforce with equitable access to personalized digital learning, ultimately improving the quality of care for women.',
            'logo'    => null,
            'social'  => [
                ['instagram', 'https://www.instagram.com/ghiaub/'],
                ['facebook',  'https://www.facebook.com/ghiaub'],
                ['linkedin',  'https://www.linkedin.com/company/ghiaub/'],
                ['x',         'https://x.com/ghiaub'],
            ],
        ],
        [
            'name'    => 'SecondEye Glasses',
            'short'   => 'SecondEye',
            'mono'    => 'SE',
            'country' => 'Morocco',
            'sector'  => 'Healthcare/Accessibility',
            'desc'    => 'An open-source AI-powered smart glasses system that helps blind and visually impaired individuals navigate their surroundings, read text, and access real-time audio guidance. To be developed as a functional prototype, the solution is co-designed and tested with women and youth with visual impairments, advancing gender-equitable access to assistive technology while promoting greater autonomy and social inclusion.',
            'logo'    => null,
            'social'  => [
                ['linkedin', 'https://www.linkedin.com/school/ump-oujda', 'UMP Oujda'],
                ['linkedin', 'https://www.linkedin.com/in/zkaddari', 'Zakaria Kaddari'],
                ['linkedin', 'https://www.linkedin.com/in/wassim-khiati-615217142', 'Wassim Khiati'],
            ],
        ],
        [
            'name'    => 'Synqanun',
            'short'   => 'Synqanun',
            'mono'    => 'SQ',
            'country' => 'Egypt/MENA',
            'sector'  => 'Gender/Law',
            'desc'    => 'A pilot open-source, AI-powered legal platform that provides women with free, reliable, and accessible legal information through a validated AI assistant, while incorporating inclusive features for persons with disabilities. By removing financial, informational, and accessibility barriers to justice, the project promotes gender equality and empowers women to better understand and exercise their legal rights.',
            'logo'    => 'synqanun.png',
            'social'  => [
                ['website',   'https://synqanun.com/'],
                ['facebook',  'https://www.facebook.com/SynQanun'],
                ['instagram', 'https://www.instagram.com/synqanun/'],
            ],
        ],
        [
            'name'    => 'Research-driven AI for Inclusive Support of Agrifood Ecosystems (RAISE)',
            'short'   => 'RAISE',
            'mono'    => 'RAISE',
            'country' => 'Lebanon',
            'sector'  => 'Agritech',
            'desc'    => 'A pilot project that tests an open-source, Arabic-language AI decision-support system for rural agrifood communities, providing context-specific guidance on agriculture, climate adaptation, and market decisions. The project adopts a gender-transformative and inclusive approach by ensuring that at least 40% of participants are women, engaging women throughout the design, validation, and governance of the system, and tailoring the AI to address barriers faced by women through Arabic-first, low-bandwidth technology.',
            'logo'    => null,
            'social'  => [
                ['instagram', 'https://www.instagram.com/esdu_aub/'],
                ['facebook',  'https://www.facebook.com/aub.esdu'],
                ['linkedin',  'https://www.linkedin.com/company/101607943/'],
                ['x',         'https://x.com/ESDU_AUB'],
            ],
        ],
        [
            'name'    => 'CHIFAA',
            'short'   => 'CHIFAA',
            'mono'    => 'CHIFAA',
            'country' => 'Tunisia',
            'sector'  => 'Gender/Healthcare',
            'desc'    => 'An open-source, survivor-led AI companion prototype that provides culturally grounded health information and psychosocial support for women living with breast and cervical cancer in North Africa. By positioning women survivors as co-designers and governance partners, the project challenges gender bias in health AI, centers women\'s lived experiences in technology development, and transforms how women access and shape digital healthcare.',
            'logo'    => null,
            'social'  => [
                ['website',  'https://www.chifaa.org'],
                ['linkedin', 'https://www.linkedin.com/company/chifaa-ai/'],
            ],
        ],
        [
            'name'    => 'A Woman Framed',
            'short'   => 'A Woman Framed',
            'mono'    => 'AWF',
            'country' => 'Egypt/Lebanon/Jordan',
            'sector'  => 'Media/Journalism',
            'desc'    => 'A pilot developing open, Arabic-language AI and data infrastructure across Egypt, Lebanon, and Jordan, with datasets and rule libraries to identify gendered narratives and harmful framing in media. By involving feminist practitioners alongside journalists and researchers in data collection, validation, and use, the project aims to address gender stereotypes and victim-blaming framing in Arabic-language reporting and support more transparent, evidence-based scrutiny of gendered media narratives.',
            'logo'    => null,
            'social'  => [],
        ],
        [
            'name'    => 'Adala-AI',
            'short'   => 'Adala-AI',
            'mono'    => 'ADALA',
            'country' => 'Egypt',
            'sector'  => 'Law',
            'desc'    => 'An applied research project in Egypt using AI and NLP to analyze 500–1,000 Egyptian administrative court rulings for gender bias in judicial language and outcomes, particularly in survivor pension disputes. By creating an open, gender-tagged legal dataset and engaging legal aid practitioners working with low-income women, the project seeks to make systemic gender bias in administrative justice visible and support evidence-based judicial reform.',
            'logo'    => null,
            'social'  => [
                ['linkedin', 'https://www.linkedin.com/in/dr-mohamed-gomaa-398b3a80/', 'Dr. Mohamed Gomaa'],
            ],
        ],
        [
            'name'    => 'ANIS',
            'short'   => 'ANIS',
            'mono'    => 'ANIS',
            'country' => 'Egypt/Germany',
            'sector'  => 'Children/AI Safety',
            'desc'    => 'A study design project in Egypt and Germany examining whether “reflective friction” interventions can help adolescents recognize and respond to gender-related manipulation and coercive persuasion in Arabic child–LLM interactions. By analyzing differences by gender, language use, and sociocultural context among Egyptian adolescents in Cairo and Berlin, the study aims to develop culturally appropriate AI safety interventions that better support adolescents’ autonomy, safety, and help-seeking.',
            'logo'    => null,
            'social'  => [],
        ],
    ];

    // platform key => [label, Font Awesome icon]
    $platforms = [
        'website'   => ['Website',   'fa-solid fa-globe'],
        'linkedin'  => ['LinkedIn',  'fa-brands fa-linkedin-in'],
        'x'         => ['X',         'fa-brands fa-x-twitter'],
        'facebook'  => ['Facebook',  'fa-brands fa-facebook-f'],
        'instagram' => ['Instagram', 'fa-brands fa-instagram'],
        'youtube'   => ['YouTube',   'fa-brands fa-youtube'],
        'tiktok'    => ['TikTok',    'fa-brands fa-tiktok'],
        'github'    => ['GitHub',    'fa-brands fa-github'],
    ];

    $experts = [
        [
            'name'  => 'Dr. Marwa Soudi',
            'role'  => 'Entrepreneur and Co-founder of Ideas Gym/Consultant and Gender Specialist at the MENA Observatory on Responsible AI',
            'photo' => 'img/iairn/experts/marwa-soudi.jpg',
            'link'  => 'https://aplusalliance.org/member/marwa-soudi/',
        ],
        [
            'name'  => 'Dr. Mohamed Zahran',
            'role'  => 'Professor of Computer Science at Courant Institute of Mathematical Science at New York University (NYU)',
            'photo' => 'img/iairn/experts/mohamed-zahran.jpg',
            'link'  => 'https://www.mzahran.com/',
        ],
    ];

    $idrcProject = 'https://idrc-crdi.ca/en/what-we-do/projects-we-support/project/ciairn-catalyzing-inclusive-ai-research-network';
@endphp

@section('content')
@include('layouts.navbars.guest.navbar', ['title' => 'IAIRN Cohort'])

<style>
    .iairn-hero {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
        padding: 80px 0;
        color: #fff;
    }
    .iairn-hero__kicker {
        display: inline-block;
        font-size: .8rem;
        font-weight: 700;
        letter-spacing: .12em;
        text-transform: uppercase;
        color: #FAAF1C;
        margin-bottom: 1rem;
    }
    .iairn-content {
        padding: 60px 0;
        color: #333;
    }
    .iairn-content p {
        color: #333 !important;
        line-height: 1.8;
        margin-bottom: 1.5rem;
    }
    .iairn-content h2 {
        color: #1a1a2e;
        margin-top: 2.5rem;
        margin-bottom: 1rem;
    }
    .iairn-content a:not(.iairn-social):not(.iairn-back) {
        color: #0f3460;
        text-decoration: underline;
        text-underline-offset: 2px;
    }
    .iairn-stats {
        background: linear-gradient(135deg, #FAAF1C 0%, #e89d0f 100%);
        padding: 30px;
        border-radius: 12px;
        margin: 30px 0;
        color: #1a1a2e;
    }
    .iairn-stats__num {
        font-size: 2.5rem;
        font-weight: 800;
        line-height: 1;
        color: #1a1a2e;
    }
    .iairn-stats__label {
        margin: .4rem 0 0 !important;
        line-height: 1.4 !important;
        color: #1a1a2e !important;
        font-size: .9rem;
    }
    .iairn-objective {
        background: #f8f9fa;
        padding: 30px;
        border-radius: 12px;
        margin: 30px 0;
    }
    .iairn-objective h3 { color: #1a1a2e !important; }
    .iairn-objective p:last-child { margin-bottom: 0; }

    /* Cohort */
    .iairn-cohort {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 24px;
        margin: 30px 0;
    }
    .iairn-project {
        background: #fff;
        border: 1px solid #e9ecef;
        border-top: 4px solid #FAAF1C;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 2px 12px rgba(0,0,0,.04);
    }
    .iairn-project__head {
        display: flex;
        gap: 16px;
        align-items: flex-start;
    }
    .iairn-project__logo {
        flex: 0 0 72px;
        width: 72px;
        height: 72px;
        border-radius: 10px;
        border: 1px solid #e9ecef;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    .iairn-project__logo img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        padding: 6px;
    }
    .iairn-project__logo--mono {
        background: #1a1a2e;
        border-color: #1a1a2e;
        color: #FAAF1C;
        font-weight: 800;
        font-size: .85rem;
        letter-spacing: .04em;
        text-align: center;
    }
    .iairn-project__name {
        color: #1a1a2e !important;
        font-size: 1.1rem;
        font-weight: 700;
        line-height: 1.35;
        margin: 0 0 .6rem;
    }
    .iairn-project__socials {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
    }
    .iairn-social {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        border-radius: 999px;
        background: #f1f3f6;
        color: #1a1a2e;
        font-size: .8rem;
        font-weight: 600;
        text-decoration: none;
        transition: background .2s ease, color .2s ease;
    }
    .iairn-social:hover,
    .iairn-social:focus-visible {
        background: #FAAF1C;
        color: #1a1a2e;
    }
    .iairn-project__tags {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin: 16px 0 12px;
    }
    .iairn-tag {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: .8rem;
        color: #4b5563;
        background: #fffbeb;
        border: 1px solid #fde68a;
        border-radius: 6px;
        padding: 3px 10px;
    }
    .iairn-tag i { color: #c8870a; }
    .iairn-project p {
        font-size: .93rem;
        line-height: 1.7;
        margin: 0;
    }

    /* Experts */
    .iairn-experts {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 24px;
        margin: 30px 0;
    }
    .iairn-expert {
        display: flex;
        gap: 18px;
        align-items: center;
        background: #1a1a2e;
        border-radius: 12px;
        padding: 20px;
    }
    .iairn-expert img {
        width: 96px;
        height: 96px;
        border-radius: 50%;
        object-fit: cover;
        flex: 0 0 96px;
        border: 3px solid #FAAF1C;
    }
    .iairn-expert__name {
        color: #FAAF1C !important;
        font-size: 1.05rem;
        margin: 0 0 .35rem;
    }
    .iairn-expert__name a { color: #FAAF1C !important; }
    .iairn-expert p {
        color: #fff !important;
        font-size: .88rem;
        line-height: 1.55;
        margin: 0;
    }

    .iairn-back {
        display: inline-block;
        background: #FAAF1C;
        color: #1a1a2e;
        padding: 15px 30px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        margin-top: 20px;
        transition: all 0.3s ease;
    }
    .iairn-back:hover {
        background: #e89d0f;
        color: #1a1a2e;
        transform: translateY(-2px);
    }

    @media (max-width: 767px) {
        .iairn-hero { padding: 56px 0; }
        .iairn-hero h1 { font-size: 1.8rem !important; }
        .iairn-cohort,
        .iairn-experts { grid-template-columns: 1fr; }
        .iairn-stats .col-md-4 + .col-md-4 { margin-top: 1.25rem; }
    }
</style>

<div class="iairn-hero">
    <div class="container text-center">
        <span class="iairn-hero__kicker">Inclusive AI Research Network &middot; MENA Hub</span>
        <h1 class="mb-4" style="font-size: 2.5rem; color: #fff !important;">
            Announcing the Inclusive AI Research Network (IAIRN) MENA Hub Cohort
        </h1>
        <p class="lead" style="opacity: 0.9; color: #fff !important;">
            Eight teams developing inclusive, community-driven AI pilots and prototypes for the MENA region
        </p>
    </div>
</div>

<div class="iairn-content">
    <div class="container" dir="ltr">

        <h2>About the Inclusive AI Research Network (IAIRN)</h2>

        <p>The <a href="https://menaobservatory.ai/en/home" target="_blank" rel="noopener">MENA Observatory on Responsible AI</a>, based at the <a href="https://business.aucegypt.edu/research/centers/a2k4d" target="_blank" rel="noopener">Access to Knowledge for Development Center (A2K4D)</a> at the <a href="https://business.aucegypt.edu/" target="_blank" rel="noopener">Onsi Sawiris School of Business</a> at the <a href="https://www.aucegypt.edu/" target="_blank" rel="noopener">American University in Cairo (AUC)</a> is proud to be the Middle East and North Africa Hub of the <a href="{{ $idrcProject }}" target="_blank" rel="noopener">Inclusive AI Research Network (IAIRN)</a>.</p>

        <p>The <a href="{{ $idrcProject }}" target="_blank" rel="noopener">Inclusive AI Research Network (IAIRN)</a> is a global network supported by Canada’s <a href="https://idrc-crdi.ca/en" target="_blank" rel="noopener">International Development Research Centre (IDRC)</a>, created with the goal of supporting community driven innovation and grounds up development of inclusive and human-centered AI technologies. In doing so, IAIRN aims to contribute to rectifying the biases and correcting inequities that are often reproduced and exacerbated by AI technologies, particularly towards women, youth and other marginalized groups. The network focuses on building scalable AI technologies that address local challenges with inclusion at the core of design, development and deployment.</p>

        <h2>Call for Applied Inclusive AI Prototypes</h2>

        <p>As the Middle East and North Africa hub of the IAIRN, the MENA Observatory on Responsible AI was looking to support multidisciplinary teams working on developing and deploying inclusive, transformative, localized, and community driven AI pilots and prototypes that address MENA’s most pressing needs.</p>

        <p>These prototypes were asked to include newly developed tools and applications, existing gender inclusive solutions from other regions that can be tailored to and adapted to the MENA context, or existing technologies that require further development to effectively improve inclusion. The solutions developed were asked to correct for the biases and inequities that existing technologies pose against marginalized groups such as women, youth, rural and underserved communities, people with disabilities, and more. In addition, these tools should work towards cultural inclusion, such as the development of Arabic and dialectal Large Language Models (LLMs).</p>

        <p>The IAIRN MENA Hub concluded the first <a href="https://www.linkedin.com/posts/mena-ai-observatory1_open-call-for-applied-inclusive-ai-solutions-activity-7402289838516846592-PPOi" target="_blank" rel="noopener">Open Call for proposals</a> on 12 February 2026. Throughout the application period, the team supported prospective applicants through continuous communications, including reminders and guidance messages to ensure clarity on requirements and submission deadlines. At the closure of the call, the IAIRN MENA Hub received 54 total responses from across the MENA region, including concept notes, project ideas, and direct inquiries from researchers and organizations, of which 8 were selected. Additionally, 18 applications from outside the region were redirected to other IAIRN hubs.</p>

        <div class="iairn-stats">
            <div class="row text-center">
                <div class="col-md-4">
                    <div class="iairn-stats__num">54</div>
                    <p class="iairn-stats__label">responses from across the MENA region</p>
                </div>
                <div class="col-md-4">
                    <div class="iairn-stats__num">8</div>
                    <p class="iairn-stats__label">projects selected</p>
                </div>
                <div class="col-md-4">
                    <div class="iairn-stats__num">18</div>
                    <p class="iairn-stats__label">applications redirected to other IAIRN hubs</p>
                </div>
            </div>
        </div>

        <div class="iairn-objective">
            <h3>Objectives of IAIRN MENA</h3>
            <p>IAIRN MENA aims to advance gender-transformative and inclusive artificial intelligence solutions as a normative practice within the region’s AI ecosystem, grounded in co-creation and community involvement. Through its activities, the Hub supports the development of community-driven, human-centered AI research and innovation that actively addresses the inequalities and biases reproduced by AI technologies, particularly those affecting women, youth, and other marginalized groups across intersecting identities.</p>
            <p>Aligned with the objectives of the MENA Observatory on Responsible AI, IAIRN’s work contributes to shaping AI practice and informing policy in the region through responsible, inclusive approaches. In doing so, IAIRN MENA directly operationalizes IDRC’s Artificial Intelligence for Development (AI4D) vision for inclusive innovation by engaging local and homegrown innovation networks to collaboratively develop, adapt, and scale open-source, localized AI pilots and prototypes. These efforts are designed to correct structural inequities in AI design, development, and deployment, while strengthening regional research capacity, fostering interdisciplinary collaboration, and contributing to knowledge sharing within the global IAIRN network.</p>
        </div>

        <h2 id="cohort">The IAIRN Cohort</h2>

        <div class="iairn-cohort">
            @foreach($cohort as $project)
                <article class="iairn-project">
                    <div class="iairn-project__head">
                        @if($project['logo'])
                            <div class="iairn-project__logo">
                                <img src="{{ asset('img/iairn/logos/' . $project['logo']) }}" alt="{{ $project['short'] }} logo" loading="lazy">
                            </div>
                        @else
                            <div class="iairn-project__logo iairn-project__logo--mono" aria-hidden="true">
                                {{ $project['mono'] }}
                            </div>
                        @endif
                        <div>
                            <h3 class="iairn-project__name">{{ $project['name'] }}</h3>
                            @if(!empty($project['social']))
                                <div class="iairn-project__socials">
                                    @foreach($project['social'] as $link)
                                        @php
                                            [$platform, $url] = $link;
                                            [$label, $icon] = $platforms[$platform] ?? [ucfirst($platform), 'fa-solid fa-link'];
                                            $text = $link[2] ?? $label;
                                        @endphp
                                        <a class="iairn-social" href="{{ $url }}" target="_blank" rel="noopener noreferrer"
                                           aria-label="{{ isset($link[2]) ? $text . ' on ' . $label : $project['short'] . ' on ' . $label }}">
                                            <i class="{{ $icon }}" aria-hidden="true"></i> {{ $text }}
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="iairn-project__tags">
                        <span class="iairn-tag"><i class="fas fa-globe-africa" aria-hidden="true"></i> {{ $project['country'] }}</span>
                        <span class="iairn-tag"><i class="fas fa-tag" aria-hidden="true"></i> {{ $project['sector'] }}</span>
                    </div>
                    <p>{{ $project['desc'] }}</p>
                </article>
            @endforeach
        </div>

        <h2>Committee of Experts</h2>

        <p>The IAIRN MENA team had two key experts to support the initiative’s advisory, applicant support, and knowledge-sharing activities. This included the engagement of Dr. <a href="https://aplusalliance.org/member/marwa-soudi/" target="_blank" rel="noopener">Marwa Soudi</a>, an ethical AI expert, MENA Observatory consultant, and former Feminist AI MENA Hub grantee (2022–2024), whose expertise was identified as particularly valuable in supporting applicants throughout the proposal development and implementation processes. Dr. Marwa Soudi was identified as a key contributor to the information sharing session, drawing on her experience as both an expert and former grantee. Planned contributions included guidance on the technical components of the program, clarification of technical requirements, responses to frequently asked questions (FAQs), and the sharing of lessons learned from previous Feminist AI MENA Hub initiatives. Prof. Mohamed Zahran was also identified as a potential contributor to future information sessions, technical consultations, and expert advisory activities.</p>

        <p>The team also engaged Prof. <a href="https://www.mzahran.com/" target="_blank" rel="noopener">Mohamed Zahran</a>, Professor of Computer Science at New York University (NYU), to contribute technical expertise and advisory support to the initiative. Together, these experts strengthen the Hub’s capacity to provide high-quality technical guidance, support proposal review processes, and contribute to the successful implementation of funded projects.</p>

        <div class="iairn-experts">
            @foreach($experts as $expert)
                <div class="iairn-expert">
                    <img src="{{ asset($expert['photo']) }}" alt="{{ $expert['name'] }}" loading="lazy">
                    <div>
                        <h3 class="iairn-expert__name">
                            <a href="{{ $expert['link'] }}" target="_blank" rel="noopener">{{ $expert['name'] }}</a>
                        </h3>
                        <p>{{ $expert['role'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <a href="{{ route('inclusive_ai') }}" class="iairn-back">
            <i class="fas fa-arrow-right me-2"></i> Explore the Inclusive AI Research Network
        </a>

    </div>
</div>

@include('layouts.footers.guest.footer')
@endsection
