@extends('layouts.frontend.app', ['class' => 'g-sidenav-show bg-gray-100'])
<style>

#map_outer{
	display:none !important;
}
</style>
@section('content')
    @include('layouts.navbars.guest.navbar', ['title' => 'Dashboard'])
    <div class="container-fluid my-5 position-relative">
        <div class="bg-images contactus">
            <script src="https://unpkg.com/@dotlottie/player-component@1.0.0/dist/dotlottie-player.js"></script>
            <dotlottie-player autoplay loop src="/img/g_bot_left.lottie" class="g_bot_left"></dotlottie-player>
            <dotlottie-player autoplay loop src="/img/g_bot_right.lottie" class="g_bot_right"></dotlottie-player>
            <dotlottie-player autoplay loop src="/img/g_top_left_mid.lottie" class="g_top_left_mid"></dotlottie-player>
            <dotlottie-player autoplay loop src="/img/g_top_left.lottie" class="g_top_left"></dotlottie-player>
            <dotlottie-player autoplay loop src="/img/g_top_right.lottie" class="g_top_right"></dotlottie-player>

        </div>

        <div class="container my-3 my-lg-5 p-0">
		<div class='row' style="max-width: 700px; margin: auto">
            <div hreflang="{{ getLang() }}" class='col-md-12 mx-0 mx-lg-5' style='text-align:center;'>
                <h3>@lang('translation.contact-us')</h3>
                <div hreflang="{{ getLang() }}">
                    @if(LaravelLocalization::getCurrentLocale()=='ar')
                        {!!  $intro->ar_content !!}
                    @else
                        {!!  $intro->content !!}
                    @endif
                </div>
                {{--                <p @if(LaravelLocalization::getCurrentLocale() === $localeCode) @endif hreflang="{{ $localeCode }}">--}}
                {{--                    @if(LaravelLocalization::getCurrentLocale()=='ar')--}}
                {{--                        {!!  $intro->ar_content !!}--}}
                {{--                    @else--}}
                {{--                        {!!  $intro->content !!}--}}
                {{--                    @endif--}}
                {{--                </p>--}}
            </div>
            <form hreflang="{{ getLang() }}" class='col-md-12 mx-0 mx-lg-5'
                  @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl" @endif >
                <input class='form-control' placeholder='@lang('translation.your-name')' style='margin-bottom:25px;'>
                <input class='form-control' placeholder='@lang('translation.your-email')' style='margin-bottom:25px;'>
                <textarea class='form-control' placeholder='@lang('translation.your-message')'
                          style='margin-bottom:25px;height: 161px;'></textarea>
                <input class='btn btn-mena-2  float-end' type="submit" value="@lang('translation.submit')">
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
