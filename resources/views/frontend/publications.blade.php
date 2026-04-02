@extends('layouts.frontend.app', ['class' => 'g-sidenav-show bg-gray-100'])
<style>#map_outer { display:none !important; }</style>

@section('content')
    @include('layouts.navbars.guest.navbar', ['title' => 'Publications'])

    <div class="container my-4 my-lg-5" @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl" @endif>
        <div class="row mb-4">
            <div class="col-12">
                <h2 style="color:#022448; font-weight:800; margin-bottom:0.25rem;">Publications</h2>
                <div style="width:40px; height:3px; background:#c8870a; border-radius:2px; margin-bottom:0.75rem;"></div>
                <p style="color:#6b7280;">Research papers, reports, and publications from the MENA Observatory on Responsible AI.</p>
            </div>
        </div>

        <livewire:tagged-repo-list tagName="Publications" />
    </div>

    @include('layouts.footers.guest.footer')
@endsection
