@extends('layouts.frontend.app', ['class' => 'g-sidenav-show bg-gray-100'])
<style>

    #map_outer{
        display:none !important;
    }
    #blogs_pagination nav:first-child div:first-child, #blogs_pagination nav:first-child div:first-child{
        display:none;
    }
    #blogs_pagination, #blogs_pagination{
        text-align:center;
    }

    .overlay{
        position: absolute; /* Sit on top of the page content */
        width: 90%; /* Full width (cover the whole page) */
        height: 90%; /* Full height (cover the whole page) */
        top: 10%;
        left: 10%;
        right: 0;
        bottom: 0;
        background-color: rgba(0,0,0,0.5); /* Black background with opacity */
        z-index: 0; /* Specify a stack order in case you're using a different order for other elements */
    }

</style>
<!--<img src="https://demobasics.pixienop.net/img/tweetcarts/fallingsand.gif" width='100%' style='z-index:99;position:absolute;top:0;left:0;'>-->
@section('content')
    @include('layouts.navbars.guest.navbar', ['title' => 'Dashboard'])
    <div class="container">

        <div class='row'>
            <h3>News</h3>
            <livewire:all-news/>
        </div>
    </div>

    @include('layouts.footers.guest.footer')
@endsection
