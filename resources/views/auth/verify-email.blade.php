@extends('layouts.frontend.app', ['class' => 'g-sidenav-show bg-gray-100'])
<style>

    #map_outer{
        display:none !important;
    }
</style>
@section('content')
    @include('layouts.navbars.guest.navbar', ['title' => 'Dashboard'])
    <div class="container-fluid position-relative my-10">
        <div class="bg-images contactus">
            <script src="https://unpkg.com/@dotlottie/player-component@1.0.0/dist/dotlottie-player.js"></script>
            <dotlottie-player autoplay loop src="/img/g_bot_left.lottie" class="g_bot_left"></dotlottie-player>
            <dotlottie-player autoplay loop src="/img/g_bot_right.lottie" class="g_bot_right"></dotlottie-player>
            <dotlottie-player autoplay loop src="/img/g_top_left_mid.lottie" class="g_top_left_mid"></dotlottie-player>
            <dotlottie-player autoplay loop src="/img/g_top_left.lottie" class="g_top_left"></dotlottie-player>
            <dotlottie-player autoplay loop src="/img/g_top_right.lottie" class="g_top_right"></dotlottie-player>

        </div>

        <div class="container p-0">
            <div class='row' style="max-width: 700px; margin: auto">
                <div class='col-md-12' style='text-align:center;'>
                    <h3>Verify e-mail address</h3>
                    <p>You must verify your email address to access this page.</p>
                    <div class="d-flex justify-content-center">
                        <button class='btn btn-mena-2'>Resend verificatm email
                            <a href='#'></a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--    <div class='subs'>--}}
{{--        <dotlottie-player autoplay loop src="/img/top_right.lottie" class="lottie_top_right"></dotlottie-player>--}}

{{--        <div class="container">--}}
{{--            <h3>RECEIVE NEWS AND UPDATES</h3>--}}
{{--            <div class='row'>--}}
{{--                <div class='col-md-7'>--}}
{{--                    <form style="--}}
{{--    display: flex;--}}
{{--    gap: 20px;--}}
{{--">--}}
{{--                        <input name='email' placeholder='Your email'>--}}
{{--                        <button class='btn btn-mena-2'>SUBSCRIBE</button>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    @include('layouts.footers.guest.footer')
@endsection
