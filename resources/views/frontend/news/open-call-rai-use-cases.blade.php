@extends('layouts.frontend.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('title', 'Open Call for Responsible AI Use Cases - MENA Region')

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
                Open Call for Responsible AI Use Cases<br>
                MENA Region
            </h1>
            <p class="lead" style="opacity: 0.9; color: #fff !important;">
                MENA Observatory on Responsible AI at A2K4D, Onsi Sawiris School of Business, AUC
            </p>
        </div>
    </div>

    <div class="news-content">
        <div class="container">

            <div class="highlight-box">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h3><i class="fas fa-calendar-alt me-2"></i> Deadline</h3>
                        <p class="mb-0">15 February</p>
                    </div>
                    <div class="col-md-6">
                        <h3><i class="fas fa-envelope me-2"></i> Submit via Email</h3>
                        <p class="mb-0">info@menaobservatory.ai</p>
                    </div>
                </div>
            </div>

            <p>The MENA Observatory on Responsible AI: a flagship initiative by A2K4D at the Onsi Sawiris School of
                Business, AUC is seeking proposals for practical, responsible AI solutions that advance inclusion, reduce
                inequalities, and address sector-specific challenges in the region.</p>

            <p><strong>If you are developing an early-stage or prototype AI solution aligned with Responsible AI principles,
                    this call is for you.</strong></p>

            <div class="info-box">
                <h3 style="color: #1a1a2e;">How to Submit</h3>
                <p><strong>Submit your proposal via:</strong></p>
                <p><a href="mailto:info@menaobservatory.ai">info@menaobservatory.ai</a></p>

                <a href="mailto:info@menaobservatory.ai" class="cta-button">
                    <i class="fas fa-paper-plane me-2"></i> Submit Your Proposal
                </a>
            </div>

        </div>
    </div>

    @include('layouts.footers.guest.footer')
@endsection