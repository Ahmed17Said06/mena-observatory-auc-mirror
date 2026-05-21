@extends('layouts.frontend.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('title', 'Feminist AI | MENA Observatory')

@section('content')
@include('layouts.navbars.guest.navbar', ['title' => 'Feminist AI'])

<div class="feminist-ai-page">

    <!-- Hero Section -->
    <div class="fai-hero">
        <div class="fai-hero__overlay"></div>
        <div class="fai-hero__content container">
            <div class="fai-hero__logo-wrap">
                <img src="{{ asset('/img/Feminist_AI_Logo.png') }}" alt="Feminist AI Logo" class="fai-hero__logo">
            </div>
            <h1 class="fai-hero__title">Feminist AI</h1>
        </div>
    </div>

    <div class="container fai-body">

        <!-- Definition -->
        <section class="fai-section fai-definition">
            <p class="fai-definition__text">
                Feminist AI refers to the act of deconstructing oppressive systems,
                dismantling historic biases and engrained inequalities, then building inclusive AI structures
                that are based on principles of justice, transparency, agency, pluralism and more...
            </p>
        </section>

        <!-- CTA Buttons -->
        <section class="fai-section fai-cta-buttons">
            <a href="{{ route('regional.gender') }}" class="fai-btn fai-btn--primary">Observatory Outputs</a>
            <a href="{{ route('regional.gender') }}#regional" class="fai-btn fai-btn--outline">Regional Resources</a>
            <a href="{{ route('regional.gender') }}#global" class="fai-btn fai-btn--outline">Global Resources</a>
            <a href="{{ route('collaborate') }}" class="fai-btn fai-btn--ghost">Collaborate With Us</a>
        </section>

    </div>
</div>

<style>
    .feminist-ai-page {
        font-family: 'Montserrat', sans-serif;
        background: #fafafa;
    }

    /* Hero */
    .fai-hero {
        position: relative;
        background: linear-gradient(135deg, #022248 0%, #6d1b7b 50%, #022248 100%);
        background-size: 300% 300%;
        animation: gradientShift 8s ease infinite;
        min-height: 55vh;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        text-align: center;
    }

    @keyframes gradientShift {
        0%   { background-position: 0% 50%; }
        50%  { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .fai-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }

    .fai-hero__overlay {
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.2);
    }

    .fai-hero__content {
        position: relative;
        z-index: 1;
        padding: 4rem 1rem;
    }

    .fai-hero__logo-wrap { margin-bottom: 1.5rem; }

    .fai-hero__logo {
        height: 90px;
        width: auto;
        filter: brightness(0) invert(1);
        animation: float 4s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50%       { transform: translateY(-8px); }
    }

    .fai-hero__title {
        font-size: clamp(2.5rem, 6vw, 4rem);
        font-weight: 800;
        color: #fff;
        margin-bottom: 0;
        letter-spacing: -1px;
    }

    /* Body */
    .fai-body {
        padding: 4rem 1rem;
        max-width: 820px;
    }

    .fai-section { margin-bottom: 3rem; }

    /* Definition */
    .fai-definition__text {
        font-size: 1.25rem;
        line-height: 1.85;
        color: #2d2d2d;
        font-weight: 500;
    }

    /* Buttons */
    .fai-cta-buttons {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .fai-btn {
        display: inline-block;
        padding: 0.75rem 1.75rem;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.95rem;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .fai-btn--primary {
        background: #FAAF1C;
        color: #022248;
        border-color: #FAAF1C;
    }
    .fai-btn--primary:hover {
        background: #e09a10;
        color: #022248;
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(250,175,28,0.35);
        text-decoration: none;
    }

    .fai-btn--outline {
        background: transparent;
        color: #022248;
        border-color: #022248;
    }
    .fai-btn--outline:hover {
        background: #022248;
        color: #fff;
        text-decoration: none;
    }

    .fai-btn--ghost {
        background: transparent;
        color: #6b7280;
        border-color: #d1d5db;
    }
    .fai-btn--ghost:hover {
        background: #f3f4f6;
        color: #374151;
        text-decoration: none;
    }
</style>

@include('layouts.footers.guest.footer')
@endsection
