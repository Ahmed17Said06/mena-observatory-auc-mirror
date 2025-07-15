@extends('layouts.frontend.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.guest.navbar', ['title' => 'Dashboard'])

    <div class="container" style="min-height: 60vh;">
        <!-- Main Title Section - Left Aligned -->
        <div class="mb-5">
            
            <h1 class="mb-4" @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl" @endif 
                style="text-transform: uppercase; font-size: 3rem;">{{ trans('translation.new_work') }}</h1>
            
            <div class="d-flex justify-content-between align-items-start gap-5 flex-wrap">
                <div class="text-start flex-grow-1" style="max-width: calc(100% - 30rem);">
                    @if($description)
                        <p @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl" @endif>
                            @if(LaravelLocalization::getCurrentLocale() === 'ar')
                                {!! $description->ar_content !!}
                            @else
                                {!! $description->content !!}
                            @endif
                        </p>
                    @else
                        <p>
                            Fast and wide-ranging developments in technology have redefined employment relationships around the globe, giving rise to many new forms of work. Platform-mediated work emerged as a way to connect workers to buyers of a labor service— and indeed it has provided millions of individuals around the world with access to work, especially in developing countries— although often at a cost.
                        </p>
                        <p>
                            Our research on platform work in the MENA region aims to influence the global narrative on platform work by giving perspectives from MENA and the larger Global South. By identifying regional opportunities and challenges, we aim to promote inclusive policy making with regards to work and safety nets, and sustainable livelihoods for all.
                        </p>
                        <p>
                            Explore our reports, policy briefs, and blog posts to find out more.
                        </p>
                    @endif
                </div>
                <div class="flex-shrink-0" style="margin-left: auto;">
                    <img src="{{ asset('img/new_work.png') }}" alt="new work" style="width: 25rem; height: auto; object-fit: contain;">
                </div>
            </div>
        </div>

        <!-- Separation Line After Description - More Visible -->
        <hr style="border: none; border-top: 2px solid #ccc; margin: 3rem 0; width: 100%; opacity: 1;">

        {{-- Use Livewire components --}}
        @livewire('new-work-reports')
        
        @livewire('new-work-policy-briefs')
        
        <!-- Partner Organizations Section -->
        <div class="mb-5">
            <h3 class="mb-4" @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl" @endif>Partner Organizations</h3>
            <div style="display: flex; justify-content: center; align-items: center; gap: 4rem; flex-wrap: wrap;">
                <img src="{{ asset('img/partner1.png') }}" alt="Partner 1" style="width: 15rem; object-fit: contain;" />
                <img src="{{ asset('img/partner2.png') }}" alt="Partner 2" style="width: 15rem; object-fit: contain;" />
                <img src="{{ asset('img/partner3.png') }}" alt="Partner 3" style="width: 15rem; object-fit: contain;" />
            </div>
        </div>
    </div>

    @include('layouts.footers.guest.footer')
@endsection
