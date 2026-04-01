@extends('layouts.frontend.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('title', 'Open Call for Applied Inclusive AI Solutions – MENA Region')

@section('content')
    @include('layouts.navbars.guest.navbar', ['title' => 'Open Call'])

    <style>
        .news-hero {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            padding: 80px 0;
            color: #fff;
        }

        .news-content {
            padding: 60px 0;
            color: #333;
        }

        .news-content p {
            color: #333 !important;
            line-height: 1.8;
            margin-bottom: 1.5rem;
        }

        .news-content h2 {
            color: #1a1a2e;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }

        .highlight-box {
            background: linear-gradient(135deg, #FAAF1C 0%, #e89d0f 100%);
            padding: 30px;
            border-radius: 12px;
            margin: 30px 0;
            color: #1a1a2e;
        }

        .info-box {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 12px;
            margin: 30px 0;
        }

        .cta-button {
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

        .cta-button:hover {
            background: #e89d0f;
            transform: translateY(-2px);
        }
    </style>

    <div class="news-hero">
        <div class="container text-center">
            <h1 class="mb-4" style="font-size: 2.5rem; color: #fff !important;">
                Final Call for Submissions<br>
                Open Call for Applied Inclusive AI Solutions – MENA Region
            </h1>
            <p class="lead" style="opacity: 0.9; color: #fff !important;">
                MENA Observatory on Responsible AI at A2K4D
            </p>
        </div>
    </div>

    <div class="news-content">
        <div class="container">

            <div class="highlight-box">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h3><i class="fas fa-clock me-2"></i> Final Reminder</h3>
                        <p class="mb-0">Submit your proposals now!</p>
                    </div>
                    <div class="col-md-6">
                        <h3><i class="fas fa-calendar-alt me-2"></i> Projects begin immediately</h3>
                        <p class="mb-0">End date: May 2027</p>
                    </div>
                </div>
            </div>

            <p>This is the final reminder to submit proposals to the Open Call launched by the MENA Observatory on
                Responsible AI at A2K4D, the MENA Hub of the Global Catalyzing Inclusive AI Research Network (CIARN).</p>

            <p>We are inviting multidisciplinary teams of innovators, researchers, technologists, gender experts, and social
                scientists to submit inclusive, gender-transformative, and community-driven AI prototypes and pilot projects
                that address bias, support marginalized communities, and strengthen responsible AI ecosystems across the
                MENA region.</p>

            <p><strong>If your work aims to make AI fairer, safer, more inclusive, and locally relevant, this is your last
                    chance to apply.</strong></p>

            <div class="info-box">
                <h3 style="color: #1a1a2e;">How to Apply</h3>
                <p><strong>Register your interest or submit inquiries:</strong></p>
                <p><a href="mailto:info@menaobservatory.ai">info@menaobservatory.ai</a></p>

                <p><strong>Full project brief:</strong></p>
                <a href="https://docs.google.com/document/d/10aFlXdrM03gwelmUAV0-gU5Nk9WKwBMEz-ulqu5fcDw/edit?usp=sharing"
                    target="_blank" class="cta-button">
                    <i class="fas fa-file-alt me-2"></i> View Project Brief
                </a>
            </div>

        </div>
    </div>

    @include('layouts.footers.guest.footer')
@endsection