@extends('layouts.frontend.app', ['class' => 'g-sidenav-show bg-gray-100'])
<style>

    #map_outer{
        display:none !important;
    }
</style>
@section('content')
    @include('layouts.navbars.guest.navbar', ['title' => 'Dashboard'])
    <div class="container-fluid position-relative my-5" style="padding-bottom: 100px">
        <div class="bg-images contactus">
            <script src="https://unpkg.com/@dotlottie/player-component@1.0.0/dist/dotlottie-player.js"></script>
            <dotlottie-player autoplay loop src="/img/g_bot_left.lottie" class="g_bot_left"></dotlottie-player>
            <dotlottie-player autoplay loop src="/img/g_bot_right.lottie" class="g_bot_right"></dotlottie-player>
            <dotlottie-player autoplay loop src="/img/g_top_left_mid.lottie" class="g_top_left_mid"></dotlottie-player>
            <dotlottie-player autoplay loop src="/img/g_top_left.lottie" class="g_top_left"></dotlottie-player>
            <dotlottie-player autoplay loop src="/img/g_top_right.lottie" class="g_top_right"></dotlottie-player>

        </div>

        <div class="container p-0">
            <div class='row my-5' style="max-width: 700px; margin: auto">
                <div class='my-4 col-md-12' style='text-align:center;'><h3>Reset your password
                    </h3></div>
                <p class="text-center">
                    Enter your email and please wait a few seconds
                </p>
                <form role="form" method="POST" action="/forgot-password">
                    @csrf
                    @method('post')
                    <div class="flex flex-col mb-3">
                        <input type="email" name="email" class="form-control form-control-lg" placeholder="Your email" aria-label="Email">
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-mena-2  float-end">Send Reset Link</button>
                        </div>

                    </div>
                </form>
            </div>
            <div id="alert">
                @include('components.alert')
            </div>

            </div>
        </div>
    </div>

    @include('layouts.footers.guest.footer')

@endsection
