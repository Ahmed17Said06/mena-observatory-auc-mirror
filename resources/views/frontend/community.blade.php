@extends('layouts.frontend.app', ['class' => 'g-sidenav-show bg-gray-100'])
<style>

    #map_outer {
        display: none !important;
    }
</style>
@section('content')
    @include('layouts.navbars.guest.navbar', ['title' => 'Dashboard'])
    <div class="container my-3 my-lg-5">
        <div class='row'>
            <h3 hreflang="{{ getLang() }}"
                @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl" @endif>@lang('translation.community')</h3>
            <div class="col-lg-10" hreflang="{{ getLang() }}">
                @if(LaravelLocalization::getCurrentLocale()=='ar')
                    {!!  $intro->ar_content !!}
                @else
                    {!!  $intro->content !!}
                @endif
            </div>
            <livewire:all-community/>
        </div>
    </div>
    @include('layouts.footers.guest.footer')
@endsection
