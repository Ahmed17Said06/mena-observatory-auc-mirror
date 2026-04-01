@extends('layouts.frontend.app', ['class' => 'g-sidenav-show bg-gray-100'])
<style>

    #map_outer{
        display:none !important;
    }
</style>
@section('content')
    @include('layouts.navbars.guest.navbar', ['title' => 'Dashboard'])
    <div class="container-fluid position-relative">
        <div class="bg-images contactus">
            <script src="https://unpkg.com/@dotlottie/player-component@1.0.0/dist/dotlottie-player.js"></script>
            <dotlottie-player autoplay loop src="/img/g_bot_left.lottie" class="g_bot_left"></dotlottie-player>
            <dotlottie-player autoplay loop src="/img/g_bot_right.lottie" class="g_bot_right"></dotlottie-player>
            <dotlottie-player autoplay loop src="/img/g_top_left_mid.lottie" class="g_top_left_mid"></dotlottie-player>
            <dotlottie-player autoplay loop src="/img/g_top_left.lottie" class="g_top_left"></dotlottie-player>
            <dotlottie-player autoplay loop src="/img/g_top_right.lottie" class="g_top_right"></dotlottie-player>

        </div>
        <div class="container py-5">
            <div class="row">
                <h3>
                    <span>...</span>
                    {{auth()->user()->name}}
                </h3>
            </div>
        </div>
<livewire:user-calendar/>
        <div class="container py-5" id="repos">
        @foreach($repos as $r)
            <div class='row' style='margin-bottom:30px;'>
                <div class='col-lg-3'>
                    <img class="event_img" src = '{{Storage::url($r->image)}}' width='100%;'>
                </div>
                <div class='col-lg-9 d-flex justify-content-between flex-column'>
                    <div>
                        <a href="{{route('repo.single',$r->id)}}" class="event-title">{{$r->title}}
                            <span style='float:right;' class="country_tag">{{$r->country->name}}
                        <img style="object-fit: contain;max-width: 46px;margin-left: 10px"  src="/img/egypt.svg">
                    </span>
                        </a>
                        <p class="event-description">
                            {{$r->description}}
                        </p>
                    </div>
                    <div class="d-flex flex-column flex-lg-row">
                        <div class="col-lg-11">
                            <div class="tag">
                                Tag A
                            </div>
                        </div>
                        <div class="col-lg-1 d-flex pt-3 pt-lg-0" style="gap: 20px;
    justify-content: right;">
                            <div class="d-flex">
                                <img style="object-fit: contain;max-width: 29px;"  src="/img/download.svg">
                            </div>
                        </div>
                    </div>

                </div>
                <hr class="my-3">
            </div>
        @endforeach
        </div>
    </div>
    @include('layouts.footers.guest.footer')
@endsection
