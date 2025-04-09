@extends('layouts.frontend.app', ['class' => 'g-sidenav-show bg-gray-100'])
<style>

#map_outer{
	display:none !important;
}
</style>
<!--<img src="https://demobasics.pixienop.net/img/tweetcarts/fallingsand.gif" width='100%' style='z-index:99;position:absolute;top:0;left:0;'>-->
@section('content')
    @include('layouts.navbars.guest.navbar', ['title' => 'Dashboard'])

<div class="container my-3 my-lg-5">
    <div class='row' @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl" @endif>
        <div class="col-lg-8">
            <h3 hreflang="{{ getLang() }}">@lang('translation.knowledge-hub')</h3>
            <div class="knowledge-text" hreflang="{{ getLang() }}">
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
