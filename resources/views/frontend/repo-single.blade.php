@extends('layouts.frontend.app', ['class' => 'g-sidenav-show bg-gray-100'])
<style>

    #map_outer {
        display: none !important;
    }
</style>
@section('content')
    @include('layouts.navbars.guest.navbar', ['title' => 'Dashboard'])
    <div class="container my-3 my-lg-5">
        <div class='row'>
            <h3>{{$repo->title}}</h3>
            <div class="col-lg-10">
                {!! $repo->content !!}
            </div>
            <img class="w-100" src="{{Storage::url($repo->image)}}">
        </div>
        @if(count($repo->pdfFiles))
            <div class='row my-3 my-lg-5'>
                <div class='col-lg-12'>
                    {{--                    <h3>Additional Resources</h3>--}}
                    <div style='margin-bottom: 40px;'>
                        @foreach($repo->pdfFiles as $r)
                            <div class='row' style='margin-bottom:30px;'>
                                <div class='col-lg-3'>
                                    {{--                                    <a href="{{route('resources.single',$r->id)}}">--}}
                                    <img class="event_img" src='{{Storage::url($r->image)}}' width='100%;'>
                                    {{--                                    </a>--}}
                                </div>
                                <div class='col-lg-9 d-flex justify-content-between flex-column'>
                                    <div>
                                        {{--                                        <a href="{{route('repo.single',$r->id)}}" class="event-title">{{$r->name}}--}}
                                        {{--                                            <span style='float:right;' class="country_tag">{{$r->country->name}}--}}
                                        {{--                                        <img style="object-fit: contain;max-width: 46px;margin-left: 10px"--}}
                                        {{--                                             src="/img/egypt.svg">--}}
                                        {{--                                    </span>--}}
                                        {{--                                        </a>--}}
                                        <p class="event-title">
                                            {{$r->name}}
                                        </p>
                                        <p class="event-description">
                                            {{$r->description}}
                                        </p>
                                    </div>
                                    <div class="d-flex flex-column flex-lg-row">
                                        {{--                                        <div class="col-lg-11">--}}
                                        {{--                                            @foreach($r->tags as $tag)--}}
                                        {{--                                                <a class="tag" href="/search?tag={{$tag->name}}">--}}
                                        {{--                                                    {{$tag->name}}--}}
                                        {{--                                                </a>--}}
                                        {{--                                            @endforeach--}}
                                        {{--                                        </div>--}}
                                        <div class="col-lg-12 d-flex pt-3 pt-lg-0" style="gap: 20px;
                    justify-content: right;">
                                                @isset($r->file)
                                                    <a href="{{Storage::url($r->file)}}" target="_blank" class="d-flex">
                                                        <img style="object-fit: contain;max-width: 29px;"
                                                             src="/img/download.svg">
                                                    </a>
                                                @endisset
                                        </div>
                                    </div>

                                </div>
                                <hr class="my-3">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

    </div>
    @include('layouts.footers.guest.footer')
@endsection
