<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enhanced Navbar</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --menablue: #022248;
            --mena-gold: #FAAF1C;
            --hover-gold: #fbbf24;
            --light-bg: #f8f9fa;
            --shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 4px 20px rgba(0, 0, 0, 0.12);
        }

        body {
            font-family: 'Montserrat', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        /* Pulse Animation */
        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        /* Float Animation */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-5px);
            }
        }

        /* Glow Animation */
        @keyframes glow {

            0%,
            100% {
                box-shadow: 0 0 5px rgba(250, 175, 28, 0.3);
            }

            50% {
                box-shadow: 0 0 20px rgba(250, 175, 28, 0.6);
            }
        }

        /* Gradient Shift */
        @keyframes gradientShift {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        /* Bounce In */
        @keyframes bounceIn {
            0% {
                opacity: 0;
                transform: scale(0.3) translateY(-50px);
            }

            50% {
                opacity: 1;
                transform: scale(1.05);
            }

            70% {
                transform: scale(0.9);
            }

            100% {
                transform: scale(1);
            }
        }

        /* Shake */
        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            10%,
            30%,
            50%,
            70%,
            90% {
                transform: translateX(-2px);
            }

            20%,
            40%,
            60%,
            80% {
                transform: translateX(2px);
            }
        }

        /* Rotate In */
        @keyframes rotateIn {
            0% {
                opacity: 0;
                transform: rotate(-200deg) scale(0);
            }

            100% {
                opacity: 1;
                transform: rotate(0) scale(1);
            }
        }

        /* Slide In From Right */
        @keyframes slideInRight {
            0% {
                opacity: 0;
                transform: translateX(30px);
            }

            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Fade In Up */
        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Announcement Bar */
        .announcement-bar {
            background: linear-gradient(135deg, var(--menablue) 0%, #033a6e 100%);
            background-size: 200% 200%;
            color: #fff;
            padding: 12px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 13px;
            position: relative;
            overflow: hidden;
            animation: slideDown 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55), gradientShift 5s ease infinite;
        }

        .announcement-bar::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            100% {
                left: 100%;
            }
        }

        @keyframes slideDown {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .announcement-content {
            display: flex;
            align-items: center;
            gap: 15px;
            position: relative;
            z-index: 1;
        }

        .announcement-content span {
            font-weight: 500;
            letter-spacing: 0.3px;
            animation: fadeInUp 0.8s ease 0.3s both;
        }

        .announcement-link {
            color: var(--mena-gold) !important;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            border-radius: 4px;
            background: rgba(250, 175, 28, 0.1);
            animation: pulse 2s ease-in-out infinite, fadeInUp 0.8s ease 0.5s both;
        }

        .announcement-link:hover {
            color: #fff !important;
            background: var(--mena-gold);
            transform: translateX(3px);
        }

        .announcement-close {
            position: absolute;
            right: 20px;
            background: transparent;
            border: none;
            color: #fff;
            font-size: 24px;
            cursor: pointer;
            padding: 5px 10px;
            opacity: 0.7;
            transition: all 0.3s ease;
            border-radius: 4px;
        }

        .announcement-close:hover {
            opacity: 1;
            background: rgba(255, 255, 255, 0.1);
            transform: rotate(90deg);
        }

        /* Header Styles */
        header {
            background: #fff;
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 999;
            transition: all 0.3s ease;
        }

        header.scrolled {
            box-shadow: var(--shadow-lg);
        }

        .header-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
            border-bottom: 1px solid #e1e3e5;
        }

        .logo {
            display: inline-block;
            animation: bounceIn 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        .logo img {
            height: 45px;
            width: auto;
            display: block;
            transition: transform 0.3s ease;
        }

        .logo:hover img {
            animation: shake 0.5s ease;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 16px;
            height: 44px;
        }

        .header-actions>* {
            animation: slideInRight 0.6s ease backwards;
        }

        .header-actions>*:nth-child(1) {
            animation-delay: 0.1s;
        }

        .header-actions>*:nth-child(2) {
            animation-delay: 0.2s;
        }

        .header-actions>*:nth-child(3) {
            animation-delay: 0.3s;
        }

        .header-actions>*:nth-child(4) {
            animation-delay: 0.4s;
        }

        /* Search Box */
        .search-box {
            position: relative;
            display: flex;
            align-items: center;
        }

        .search-box form {
            position: relative;
            display: flex;
            align-items: center;
            width: 280px;
        }

        .search-box input {
            width: 100%;
            height: 44px;
            padding: 10px 50px 10px 20px;
            border: 2px solid #e1e3e5;
            border-radius: 25px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: var(--light-bg);
        }

        .search-box input::placeholder {
            color: #999;
            font-size: 14px;
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--mena-gold);
            background: #fff;
            box-shadow: 0 4px 12px rgba(250, 175, 28, 0.15);
        }

        .search-box form:focus-within {
            width: 320px;
        }

        .search-box button {
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            background: var(--mena-gold);
            border: none;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }

        .search-box button:hover {
            background: var(--hover-gold);
            transform: translateY(-50%) scale(1.05) rotate(15deg);
            animation: glow 1.5s ease-in-out infinite;
        }

        .search-box button svg {
            width: 16px;
            height: 16px;
            transition: transform 0.3s ease;
            flex-shrink: 0;
        }

        .search-box button:hover svg {
            animation: rotateIn 0.5s ease;
        }

        /* Buttons */
        .btn-collaborate {
            background: var(--mena-gold);
            color: var(--menablue);
            border: none;
            padding: 11px 28px;
            border-radius: 25px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            white-space: nowrap;
            height: 44px;
            line-height: 1;
        }

        .btn-collaborate::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn-collaborate:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-collaborate:hover {
            background: var(--hover-gold);
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(250, 175, 28, 0.3);
            animation: float 2s ease-in-out infinite;
        }

        .btn-collaborate span {
            position: relative;
            z-index: 1;
        }

        .btn-collaborate:active {
            animation: pulse 0.3s ease;
        }

        /* Language Switcher */
        .language-switcher {
            display: flex;
            align-items: center;
            gap: 4px;
            padding: 4px;
            background: linear-gradient(135deg, #f0f2f5 0%, #e8ebef 100%);
            border-radius: 25px;
            height: 44px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.06);
        }

        .language-switcher a {
            color: var(--menablue);
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 20px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 50px;
            height: 36px;
        }

        .language-switcher a:hover {
            background: rgba(250, 175, 28, 0.15);
            color: var(--menablue);
        }

        .language-switcher a.active {
            background: var(--menablue);
            color: #fff;
            box-shadow: 0 2px 8px rgba(2, 34, 72, 0.25);
        }

        .language-switcher a.active:hover {
            background: #033a6e;
            transform: none;
        }

        /* Navigation */
        .main-nav {
            display: flex;
            justify-content: center;
            padding: 0;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 5px;
            margin: 0;
            padding: 15px 0;
        }

        .nav-menu li {
            position: relative;
            animation: fadeInUp 0.6s ease backwards;
        }

        .nav-menu li:nth-child(1) {
            animation-delay: 0.1s;
        }

        .nav-menu li:nth-child(2) {
            animation-delay: 0.15s;
        }

        .nav-menu li:nth-child(3) {
            animation-delay: 0.2s;
        }

        .nav-menu li:nth-child(4) {
            animation-delay: 0.25s;
        }

        .nav-menu li:nth-child(5) {
            animation-delay: 0.3s;
        }

        .nav-menu li:nth-child(6) {
            animation-delay: 0.35s;
        }

        .nav-menu li:nth-child(7) {
            animation-delay: 0.4s;
        }

        .nav-menu li:nth-child(8) {
            animation-delay: 0.45s;
        }

        .nav-menu a {
            color: var(--menablue);
            text-decoration: none;
            padding: 12px 20px;
            font-size: 14px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 5px;
            position: relative;
            overflow: hidden;
        }

        .nav-menu a::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 3px;
            background: var(--mena-gold);
            transition: width 0.4s ease;
        }

        .nav-menu a:hover::before {
            width: 100%;
        }

        .nav-menu a:hover {
            background: var(--light-bg);
            color: var(--mena-gold);
            transform: translateY(-2px);
        }

        .nav-menu li.active a {
            color: var(--mena-gold);
            background: rgba(250, 175, 28, 0.1);
        }

        .nav-menu li.active a::before {
            width: 100%;
            animation: pulse 2s ease-in-out infinite;
        }

        /* Dropdown */
        .dropdown {
            position: relative;
        }

        .dropdown-toggle::after {
            content: '\f107';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            margin-left: 5px;
            transition: transform 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            display: inline-block;
        }

        .dropdown:hover .dropdown-toggle::after {
            transform: rotate(180deg);
            animation: bounce 0.6s ease;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: rotate(180deg) translateY(0);
            }

            50% {
                transform: rotate(180deg) translateY(-3px);
            }
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            background: #fff;
            min-width: 220px;
            border-radius: 12px;
            box-shadow: var(--shadow-lg);
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px) scale(0.95);
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            padding: 8px;
            margin-top: 8px;
            z-index: 1000;
        }

        .dropdown:hover .dropdown-menu,
        .nav-item.dropdown:hover .dropdown-menu {
            display: block !important;
            opacity: 1 !important;
            visibility: visible !important;
            transform: translateY(0) scale(1) !important;
            animation: none !important;
            pointer-events: auto !important;
        }

        .dropdown-menu a {
            padding: 12px 16px;
            display: block;
            border-radius: 8px;
            position: relative;
        }

        .dropdown-menu a::before {
            content: '→';
            position: absolute;
            left: -20px;
            opacity: 0;
            transition: all 0.3s ease;
            color: var(--mena-gold);
        }

        .dropdown-menu a:hover {
            background: var(--light-bg);
            color: var(--mena-gold);
            transform: translateX(5px);
            padding-left: 24px;
        }

        .dropdown-menu a:hover::before {
            left: 8px;
            opacity: 1;
        }

        /* Mobile Menu */
        .mobile-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            color: var(--menablue);
            cursor: pointer;
            padding: 8px;
            transition: all 0.3s ease;
        }

        .mobile-toggle:hover {
            color: var(--mena-gold);
            transform: scale(1.1);
            animation: shake 0.5s ease;
        }

        .mobile-toggle i {
            transition: transform 0.3s ease;
        }

        .mobile-toggle:hover i {
            animation: rotateIn 0.6s ease;
        }

        .mobile-menu {
            position: fixed;
            top: 0;
            right: -100%;
            width: 100%;
            height: 100vh;
            background: #fff;
            transition: right 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            z-index: 9999;
            overflow-y: auto;
        }

        .mobile-menu.open {
            right: 0;
        }

        .mobile-menu-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid #e1e3e5;
        }

        .mobile-close {
            background: none;
            border: none;
            font-size: 32px;
            color: var(--menablue);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .mobile-close:hover {
            color: var(--mena-gold);
            transform: rotate(90deg) scale(1.2);
            animation: pulse 0.5s ease;
        }

        .mobile-menu-content {
            padding: 20px;
        }

        .mobile-nav-menu {
            list-style: none;
            margin-top: 20px;
        }

        .mobile-nav-menu li {
            margin-bottom: 5px;
            animation: slideInRight 0.5s ease backwards;
        }

        .mobile-nav-menu li:nth-child(1) {
            animation-delay: 0.1s;
        }

        .mobile-nav-menu li:nth-child(2) {
            animation-delay: 0.15s;
        }

        .mobile-nav-menu li:nth-child(3) {
            animation-delay: 0.2s;
        }

        .mobile-nav-menu li:nth-child(4) {
            animation-delay: 0.25s;
        }

        .mobile-nav-menu li:nth-child(5) {
            animation-delay: 0.3s;
        }

        .mobile-nav-menu li:nth-child(6) {
            animation-delay: 0.35s;
        }

        .mobile-nav-menu li:nth-child(7) {
            animation-delay: 0.4s;
        }

        .mobile-nav-menu li:nth-child(8) {
            animation-delay: 0.45s;
        }

        .mobile-nav-menu a {
            display: block;
            padding: 15px 20px;
            color: var(--menablue);
            text-decoration: none;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .mobile-nav-menu a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: var(--mena-gold);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .mobile-nav-menu a:hover::before {
            transform: scaleY(1);
        }

        .mobile-nav-menu a:hover {
            background: var(--light-bg);
            color: var(--mena-gold);
            transform: translateX(5px);
        }

        .mobile-actions {
            margin-top: 30px;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .main-nav {
                display: none;
            }

            .mobile-toggle {
                display: block;
            }

            .header-actions {
                gap: 10px;
            }

            .search-box input {
                width: 200px;
            }

            .search-box input:focus {
                width: 220px;
            }
        }

        @media (max-width: 768px) {
            .header-top {
                padding: 15px 0;
            }

            .logo img {
                height: 35px;
            }

            .btn-collaborate {
                padding: 10px 20px;
                font-size: 13px;
            }

            .language-switcher {
                display: none;
            }

            .announcement-bar {
                padding: 10px 50px 10px 15px;
                font-size: 12px;
            }

            .announcement-content {
                flex-direction: column;
                gap: 5px;
            }
        }

        @media (max-width: 480px) {
            .search-box {
                display: none;
            }
        }
    </style>
</head>

<body>
    @php
        $annText    = \App\Models\static_content::where('key', 'announcement_text')->value('content')
                      ?? 'Coming Soon - Convergence Summit, May 2, 2026 | AUC Tahrir Campus | CONVERGENCE: Where Robotics Meets the Human Condition';
        $annLink    = \App\Models\static_content::where('key', 'announcement_link')->value('content')
                      ?? 'https://www.convergence-summit.com/';
        $annEnabled = \App\Models\static_content::where('key', 'announcement_enabled')->value('content') ?? 'yes';
    @endphp
    @if($annEnabled === 'yes')
    <!-- Announcement Bar -->
    <div id="announcementBar" class="announcement-bar">
        <div class="announcement-content">
            <svg style="height:16px;width:16px;margin-right:8px;flex-shrink:0;color:var(--mena-gold);" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            <span>{{ $annText }}</span>
            <a href="{{ $annLink }}" target="_blank" rel="noopener noreferrer"
                class="announcement-link">Learn more →</a>
        </div>
        <button class="announcement-close" onclick="closeAnnouncement()">×</button>
    </div>
    @endif

    <!-- Header -->
    <header id="header">
        <div class="header-container">
            <div class="header-top">
                <a href="/" class="logo">
                    <img src="/img/logo2.svg" alt="Logo">
                </a>

                <div class="header-actions">
                    <div class="search-box">
                        <form method="GET" action="{{ route('search') }}">
                            <input type="text" placeholder="@lang('translation.search', ['default' => 'Search...'])" name="search">
                            <button type="submit">
                                <svg width="16" height="16" viewBox="0 0 15 15" fill="none">
                                    <path
                                        d="M5.80292 11.413C2.62774 11.413 0 8.91304 0 5.76087C0 2.6087 2.62774 0 5.80292 0C8.9781 0 11.6058 2.6087 11.6058 5.76087C11.6058 8.91304 8.9781 11.413 5.80292 11.413ZM5.80292 1.08696C3.17518 1.08696 1.09489 3.15217 1.09489 5.76087C1.09489 8.36957 3.17518 10.4348 5.80292 10.4348C8.43066 10.4348 10.5109 8.36957 10.5109 5.76087C10.5109 3.15217 8.32117 1.08696 5.80292 1.08696Z"
                                        fill="#fff" />
                                    <path
                                        d="M9.68313 8.99118L8.90894 9.75977L14.2509 15.063L15.0251 14.2944L9.68313 8.99118Z"
                                        fill="#fff" />
                                </svg>
                            </button>
                        </form>
                    </div>

                    <a href="{{ route('collaborate') }}" class="btn-collaborate"><span>@lang('translation.collaborate')</span></a>

                    <div class="language-switcher">
                        @php
                            $locales = LaravelLocalization::getSupportedLocales();
                        @endphp
                        @foreach ($locales as $localeCode => $properties)
                            <a rel="alternate" @if (LaravelLocalization::getCurrentLocale() === $localeCode) class="active" @endif
                                hreflang="{{ $localeCode }}"
                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                {{ $localeCode === 'en' ? 'EN' : 'عربي' }}
                            </a>
                        @endforeach
                    </div>

                    <button class="mobile-toggle" onclick="openMobileMenu()">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>

            <nav class="main-nav">
                <ul class="nav-menu">
                    <li class="@if (str(Route::current()->getName())->contains('about_us')) active @endif">
                        <a href="{{ route('about_us') }}">@lang('translation.about-us')</a>
                    </li>
                    <li class="dropdown @if (str(Route::current()->getName())->contains('regional')) active @endif">
                        <a href="{{ route('regional') }}" class="dropdown-toggle">@lang('translation.knowledge-hub')</a>
                        <div class="dropdown-menu">
                            <a href="{{ route('regional.our_work') }}">@lang('translation.our-work')</a>
                            <a href="{{ route('regional.regional_other_work') }}">Regional Resources</a>
                            <a href="{{ route('regional.global_other_work') }}">Global Resources</a>
                        </div>
                    </li>

                    <li class="@if (str(Route::current()->getName())->contains('ai_indices')) active @endif">
                        <a href="{{ route('ai_indices') }}">@lang('translation.ai-indices', ['default' => 'AI Indices'])</a>
                    </li>
                    <li class="@if (str(Route::current()->getName())->contains('pw_mena')) active @endif">
                        <a href="{{ route('pw_mena') }}">Future of Work MENA</a>
                    </li>
                    <li class="@if (str(Route::current()->getName())->contains('inclusive_ai')) active @endif">
                        <a href="{{ route('coming-soon') }}">Inclusive AI Research Network</a>
                    </li>
                    <li class="@if (str(Route::current()->getName())->contains('news')) active @endif">
                        <a href="{{ route('news.index') }}">@lang('translation.news', ['default' => 'News'])</a>
                    </li>
                    <li class="dropdown @if (str(Route::current()->getName())->contains('community')) active @endif">
                        <a href="{{ route('community') }}" class="dropdown-toggle">@lang('translation.community')</a>
                        <div class="dropdown-menu">
                            <a href="{{ route('communities') }}">@lang('translation.community-title')</a>
                            <a href="{{ route('collaborators') }}">@lang('translation.partners')</a>
                        </div>
                    </li>
                    <li class="@if (str(Route::current()->getName())->contains('contact_us')) active @endif">
                        <a href="{{ route('contact_us') }}">@lang('translation.contact-us')</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="mobile-menu">
        <div class="mobile-menu-header">
            <a href="/" class="logo">
                <img src="/img/logo2.svg" alt="Logo" style="height: 35px;">
            </a>
            <button class="mobile-close" onclick="closeMobileMenu()">×</button>
        </div>
        <div class="mobile-menu-content">
            <div class="search-box">
                <form method="GET" action="{{ route('search') }}">
                    <input type="text" placeholder="@lang('translation.search', ['default' => 'Search...'])" name="search">
                    <button type="submit">
                        <svg width="18" height="18" viewBox="0 0 15 15" fill="none">
                            <path
                                d="M5.80292 11.413C2.62774 11.413 0 8.91304 0 5.76087C0 2.6087 2.62774 0 5.80292 0C8.9781 0 11.6058 2.6087 11.6058 5.76087C11.6058 8.91304 8.9781 11.413 5.80292 11.413ZM5.80292 1.08696C3.17518 1.08696 1.09489 3.15217 1.09489 5.76087C1.09489 8.36957 3.17518 10.4348 5.80292 10.4348C8.43066 10.4348 10.5109 8.36957 10.5109 5.76087C10.5109 3.15217 8.32117 1.08696 5.80292 1.08696Z"
                                fill="#fff" />
                            <path d="M9.68313 8.99118L8.90894 9.75977L14.2509 15.063L15.0251 14.2944L9.68313 8.99118Z"
                                fill="#fff" />
                        </svg>
                    </button>
                </form>
            </div>

            <ul class="mobile-nav-menu">
                <li class="@if (str(Route::current()->getName())->contains('about_us')) active @endif">
                    <a href="{{ route('about_us') }}">@lang('translation.about-us')</a>
                </li>
                <li class="@if (str(Route::current()->getName())->contains('regional')) active @endif">
                    <a href="{{ route('regional') }}">@lang('translation.knowledge-hub')</a>
                </li>
                <li class="@if (Route::current()->getName() === 'regional.our_work') active @endif" style="padding-left: 1rem;">
                    <a href="{{ route('regional.our_work') }}">@lang('translation.our-work')</a>
                </li>
                <li class="@if (Route::current()->getName() === 'regional.regional_other_work') active @endif" style="padding-left: 1rem;">
                    <a href="{{ route('regional.regional_other_work') }}">Regional Resources</a>
                </li>
                <li class="@if (Route::current()->getName() === 'regional.global_other_work') active @endif" style="padding-left: 1rem;">
                    <a href="{{ route('regional.global_other_work') }}">Global Resources</a>
                </li>


                <li class="@if (str(Route::current()->getName())->contains('ai_indices')) active @endif">
                    <a href="{{ route('ai_indices') }}">@lang('translation.ai-indices', ['default' => 'AI Indices'])</a>
                </li>
                <li class="@if (str(Route::current()->getName())->contains('pw_mena')) active @endif">
                    <a href="{{ route('pw_mena') }}">Future of Work MENA</a>
                </li>
                <li class="@if (str(Route::current()->getName())->contains('inclusive_ai')) active @endif">
                    <a href="{{ route('coming-soon') }}">Inclusive AI Research Network</a>
                </li>
                <li class="@if (str(Route::current()->getName())->contains('news')) active @endif">
                    <a href="{{ route('news.index') }}">@lang('translation.news', ['default' => 'News'])</a>
                </li>
                <li class="@if (str(Route::current()->getName())->contains('community')) active @endif">
                    <a href="{{ route('community') }}">@lang('translation.community')</a>
                </li>
                <li class="@if (str(Route::current()->getName())->contains('contact_us')) active @endif">
                    <a href="{{ route('contact_us') }}">@lang('translation.contact-us')</a>
                </li>
            </ul>

            <div class="mobile-actions">
                <div class="language-switcher" style="display: flex; justify-content: center;">
                    @foreach ($locales as $localeCode => $properties)
                        <a rel="alternate" @if (LaravelLocalization::getCurrentLocale() === $localeCode) class="active" @endif
                            hreflang="{{ $localeCode }}"
                            href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $localeCode === 'en' ? 'EN' : 'عربي' }}
                        </a>
                    @endforeach
                </div>
                <a href="{{ route('collaborate') }}" class="btn-collaborate"
                    style="text-align: center;"><span>@lang('translation.collaborate')</span></a>
            </div>
        </div>
    </div>

    <script>
        // Confetti animation
        function triggerConfetti(event) {
            // Don't prevent default - let the link work
            const duration = 2 * 1000;
            const animationEnd = Date.now() + duration;
            const defaults = {
                startVelocity: 30,
                spread: 360,
                ticks: 60,
                zIndex: 10000
            };

            function randomInRange(min, max) {
                return Math.random() * (max - min) + min;
            }

            const interval = setInterval(function() {
                const timeLeft = animationEnd - Date.now();

                if (timeLeft <= 0) {
                    return clearInterval(interval);
                }

                const particleCount = 50 * (timeLeft / duration);

                // Burst confetti from multiple points
                confetti(Object.assign({}, defaults, {
                    particleCount,
                    origin: {
                        x: randomInRange(0.1, 0.3),
                        y: Math.random() - 0.2
                    },
                    colors: ['#022248', '#FAAF1C', '#fbbf24', '#60a5fa', '#ffffff']
                }));
                confetti(Object.assign({}, defaults, {
                    particleCount,
                    origin: {
                        x: randomInRange(0.7, 0.9),
                        y: Math.random() - 0.2
                    },
                    colors: ['#022248', '#FAAF1C', '#fbbf24', '#60a5fa', '#ffffff']
                }));
            }, 250);
        }

        // Close announcement
        function closeAnnouncement() {
            const bar = document.getElementById('announcementBar');
            bar.style.animation = 'slideDown 0.3s ease-in reverse';
            setTimeout(() => {
                bar.style.display = 'none';
                localStorage.setItem('announcementDismissed', 'true');
                localStorage.setItem('announcementDismissedTime', Date.now().toString());
            }, 300);
        }

        // Check if announcement was dismissed
        document.addEventListener('DOMContentLoaded', function() {
            const dismissed = localStorage.getItem('announcementDismissed');
            const dismissedTime = localStorage.getItem('announcementDismissedTime');
            const twentyFourHours = 24 * 60 * 60 * 1000;

            if (dismissed && dismissedTime && (Date.now() - parseInt(dismissedTime)) < twentyFourHours) {
                document.getElementById('announcementBar').style.display = 'none';
            }
        });

        // Mobile menu
        function openMobileMenu() {
            document.getElementById('mobileMenu').classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeMobileMenu() {
            document.getElementById('mobileMenu').classList.remove('open');
            document.body.style.overflow = '';
        }

        // Scroll effect with enhanced animation
        let lastScroll = 0;
        window.addEventListener('scroll', function() {
            const header = document.getElementById('header');
            const currentScroll = window.scrollY;

            if (currentScroll > 50) {
                header.classList.add('scrolled');

                // Add bounce effect when scrolling down
                if (currentScroll > lastScroll) {
                    header.style.transform = 'translateY(-5px)';
                    setTimeout(() => {
                        header.style.transform = 'translateY(0)';
                    }, 100);
                }
            } else {
                header.classList.remove('scrolled');
            }

            lastScroll = currentScroll;
        });

        // Add ripple effect to buttons
        document.querySelectorAll('.btn-collaborate').forEach(button => {
            button.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;

                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.style.position = 'absolute';
                ripple.style.borderRadius = '50%';
                ripple.style.background = 'rgba(255, 255, 255, 0.6)';
                ripple.style.transform = 'scale(0)';
                ripple.style.animation = 'ripple 0.6s ease-out';
                ripple.style.pointerEvents = 'none';

                this.appendChild(ripple);

                setTimeout(() => ripple.remove(), 600);
            });
        });

        // Add CSS for ripple animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);

        // Animate nav items on hover
        document.querySelectorAll('.nav-menu a').forEach((link, index) => {
            link.addEventListener('mouseenter', function() {
                this.style.animation = 'none';
                setTimeout(() => {
                    this.style.animation = 'pulse 0.5s ease';
                }, 10);
            });
        });

        // Mobile menu items animation
        const mobileMenuObserver = new MutationObserver((mutations) => {
            mutations.forEach((mutation) => {
                if (mutation.target.classList.contains('open')) {
                    const items = document.querySelectorAll('.mobile-nav-menu li');
                    items.forEach((item, index) => {
                        item.style.animation = 'none';
                        setTimeout(() => {
                            item.style.animation =
                                `slideInRight 0.5s ease ${index * 0.05}s backwards`;
                        }, 10);
                    });
                }
            });
        });

        const mobileMenu = document.getElementById('mobileMenu');
        if (mobileMenu) {
            mobileMenuObserver.observe(mobileMenu, {
                attributes: true,
                attributeFilter: ['class']
            });
        }
    </script>
</body>

</html>
