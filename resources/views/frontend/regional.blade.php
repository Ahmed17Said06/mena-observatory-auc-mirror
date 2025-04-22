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
                @if(isset($is_data_repo_page) && $is_data_repo_page)
                    @lang('translation.data-depository', ['default' => 'Data Depository'])
                @else
                    @lang('translation.knowledge-hub')
                @endif
            </h1>
            
            @if(!isset($is_data_repo_page) || !$is_data_repo_page)
                <div class="knowledge-text" hreflang="{{ getLang() }}">
                    @if(LaravelLocalization::getCurrentLocale()=='ar')
                        {!!  $intro->ar_content !!}
                    @else
                        {!!  $intro->content !!}
                    @endif
                </div>
            @endif
            {{--		<div  style='' id="map"></div>--}}
        </div>
        @if(!isset($is_data_repo_page) || !$is_data_repo_page)
        <div class="col-lg-4">
            <div class="countries-map">
                <img src="{{asset('/img/Group 2070.png')}}">
            </div>
        </div>
        @endif
    </div>

<livewire:repo-list/>
</div>

    @include('layouts.footers.guest.footer')

@endsection
