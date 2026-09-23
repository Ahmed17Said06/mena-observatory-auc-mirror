@extends('layouts.frontend.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.guest.navbar', ['title' => 'Dashboard'])

<div class="container my-3 my-lg-5" style="min-height: 60vh;">
    <div class="mb-5">
        <h1 class="mb-4" @if(LaravelLocalization::getCurrentLocale()==='ar' ) dir="rtl" @endif
            style="text-transform: uppercase; font-size: 3rem;">{{ trans('translation.new_work') }}</h1>

        @if($description)
        <div class="text-start" @if(LaravelLocalization::getCurrentLocale()==='ar' ) dir="rtl" @endif>
            @if(LaravelLocalization::getCurrentLocale() === 'ar')
            {!! $description->ar_content !!}
            @else
            {!! $description->content !!}
            @endif
        </div>
        @endif
    </div>

    <hr style="border: none; border-top: 2px solid #ccc; margin: 3rem 0; width: 100%; opacity: 1;">

    {{-- The Livewire component paginates itself (Load More). --}}
    @livewire('new-work-blogs')
</div>

@include('layouts.footers.guest.footer')
@endsection
