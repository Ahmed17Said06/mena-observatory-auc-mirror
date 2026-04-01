@extends('layouts.frontend.app', ['class' => 'g-sidenav-show bg-gray-100'])
<style>

    #map_outer{
        display:none !important;
    }

</style>
<!--<img src="https://demobasics.pixienop.net/img/tweetcarts/fallingsand.gif" width='100%' style='z-index:99;position:absolute;top:0;left:0;'>-->
@section('content')
    <style>
        .navbar-toggler-icon{
            background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%280, 0, 0, 0.85%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e") !important;
        }
    </style>
        <div class="container">
        <div class='col-12 text-center py-3 p-lg-4'>
            <a class="navbar-brand coming-soon" style='margin-left:10px;' href="/">
                <img src = '/img/logo2.svg'>
            </a>
        </div>
    </div>
    <div class="hero">
        <video autoplay loop muted  playsInline id="myVideo">
            <source src="/img/AUC1.4.mp4" type="video/mp4 ">
        </video>
        <div class="coming-soon-hero">
            <h3 style='color:#FFF;text-align:center;'>Coming <br class="d-block d-lg-none">Soon</h3>
        </div>
    </div>
    </div>
    </div>
    </div>
    <div id = 'footer'>
        <div class="d-flex justify-content-center" style='margin-top:30px;'>
            <a href="#" class="fa fa-twitter"></a>
            <a href="#" class="fa fa-instagram"></a>
            <a href="#" class="fa fa-facebook"></a>
            <a href="#" class="fa fa-linkedin"></a>
        </div>

        <a href="mailto:info@menaobservatory.ai"
           style='margin-top:10px;font-size:14px;font-weight:700;font-family:"Gotham";color: #393939;'>info@menaobservatory.ai</a>
        <div class = 'line'></div>


        <div style='width:100%;text-align:center;'>
            <div class="partners">
                <img src ='/img/logo2.png' height='99px;'>
                <img src ='/img/AUCLogo_BUS_A2K4D_blueCMYK_High-01 (1).png' height='102px;'>
                <img src ='/img/logo3.png' height='51px;' style='margin-left:20px;margin-right:20px;'>
            </div>
        </div>
        <p id='privacy' style='margin-top:40px;color: #444444;'>2023 | <span style="font-weight: 700">PRIVACY - TERMS</span></p>
    </div>
@endsection
