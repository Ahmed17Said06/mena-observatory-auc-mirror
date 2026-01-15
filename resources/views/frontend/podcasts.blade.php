@extends('layouts.frontend.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.guest.navbar', ['title' => 'Podcasts'])
    
    <style>
        .podcasts-hero {
            background: linear-gradient(135deg, #022248 0%, #033a6e 100%);
            padding: 80px 20px;
            text-align: center;
        }
        
        .podcasts-hero h1 {
            color: #fff;
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 15px;
            text-shadow: 0 4px 20px rgba(0,0,0,0.3);
        }
        
        .podcasts-hero p {
            color: rgba(255,255,255,0.9);
            max-width: 700px;
            margin: 0 auto;
            font-size: 1.15rem;
            line-height: 1.7;
        }
        
        .podcasts-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 60px 20px;
        }
        
        @media (max-width: 768px) {
            .podcasts-hero h1 {
                font-size: 2rem;
            }
        }
    </style>
    
    <div class="podcasts-hero">
        <div class="container">
            <h1>@lang('translation.podcasts', ['default' => 'Podcasts'])</h1>
            <p>@lang('translation.aswat') - Listen to expert discussions, interviews, and insights on AI ethics and governance in the MENA region.</p>
        </div>
    </div>
    
    <div class="podcasts-container">
        <livewire:aswats />
    </div>
    
    @include('layouts.footers.guest.footer')
@endsection