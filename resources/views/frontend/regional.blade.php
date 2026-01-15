@extends('layouts.frontend.app', ['class' => 'g-sidenav-show bg-gray-100'])
<style>
#map_outer{
    display:none !important;
}
</style>
@section('content')
    @include('layouts.navbars.guest.navbar', ['title' => 'Dashboard'])

<div class="container my-3 my-lg-5">
    <div class='row' @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl" @endif>
        <div class="col-lg-8">
            <h1 class="page-title">
                @lang('translation.knowledge-hub')
            </h1>
            
            <div class="knowledge-text" hreflang="{{ getLang() }}" style="color: #333333 !important;">
                @if(LaravelLocalization::getCurrentLocale()=='ar')
                    {!!  $intro->ar_content !!}
                @else
                    {!!  $intro->content !!}
                @endif
            </div>
            {{--		<div  style='' id="map"></div>--}}
        </div>
        <div class="col-lg-4">
            <div class="countries-map">
                <img src="{{asset('/img/Group 2070.png')}}">
            </div>
        </div>
    </div>

<livewire:repo-list/>
</div>

    @include('layouts.footers.guest.footer')

@endsection