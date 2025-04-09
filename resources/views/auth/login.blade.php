@extends('layouts.frontend.app', ['class' => 'g-sidenav-show bg-gray-100'])
<style>

    #map_outer{
        display:none !important;
    }
</style>
@section('content')
    @include('layouts.navbars.guest.navbar', ['title' => 'Dashboard'])
    <div class="container-fluid my-5 position-relative" style="padding-bottom: 100px">
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
                <div class='my-4 col-md-12' style='text-align:center;'><h3>LOGIN</h3></div>
                <p>Login to your account to check your saved events and your articles and blogposts.</p>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="my-4" role="form" method="POST" action="{{ route('login') }}">
                    @csrf
                    @method('post')
                    <div class="flex flex-col mb-3">
                        <input type="email" name="email" class="form-control form-control-lg" value="{{ old('email')}}" aria-label="Email">
                        @error('email') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                    </div>
                    <div class="flex flex-col mb-3">
                        <input type="password" name="password" class="form-control form-control-lg" aria-label="Password" >
                        @error('password') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" name="remember" type="checkbox" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>
                    <div class="row flex-lg-row flex-column-reverse">
                        <div class="col-12 col-lg-9">
                            <div class="card-footer pt-0 px-lg-2 px-1">
                                <p class="mb-1 text-sm mx-auto">
                                    Forgot you password? Reset your password
                                    <a href="/forgot-password" class="font-weight-bold">here</a>
                                </p>
                            </div>
                            <div class="card-footer pt-0 px-lg-2 px-1">
                                <p class="mb-4 text-sm mx-auto">
                                    Don't have an account?
                                    <a href="{{ route('register') }}" class="font-weight-bold">Register</a>
                                </p>
                            </div>

                        </div>
                        <div class="col-12 col-lg-3">
                            <button type="submit" class="btn btn-mena-2 float-end">LOGIN</button>
                        </div>

                    </div>
                </form>

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
