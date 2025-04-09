@extends('layouts.frontend.app', ['class' => 'g-sidenav-show bg-gray-100'])
<style>

    #map_outer{
        display:none !important;
    }
</style>
@section('content')
    @include('layouts.navbars.guest.navbar', ['title' => 'Dashboard'])
    <div class="container my-3 my-lg-5">
        <div class='row'>
            <div class="col-md-8">
                <div class="post-loop-inner position-relative" style='background-image:url({{Storage::url($news->image)}});'>
                    <div class="post-content" lang="en">
                        <h6 style='color:#FFF;' class=''>
                            {{$news->title}}
                        </h6>
                        <p class="post-date">{{$news->created_at}}</p>
                    </div>
                    <div class="overlay-1"></div>
                </div>
                <div class="d-flex flex-column flex-lg-row">
                    <div class="col-12 col-lg-10 d-flex gap-3 flex-wrap">
                        @foreach($news->tags as $tag)
                            <a class="tag" href="/search?tag={{$tag->name}}">
                                {{$tag->name}}
                            </a>
                        @endforeach
                    </div>
                    <div class="col-12 col-lg-2 d-flex pt-3 pt-lg-0 justify-content-end" style="gap: 20px">
                        <div class="d-flex align-items-center">
                            <img style="object-fit: contain;max-width: 29px; margin-right: 15px"
                                 src="/img/Views_Icon.svg">
                            <span style="white-space: nowrap;">{{$news->views}} Views</span>
                        </div>
                    </div>
                </div>
                <div class='blog-content'>
                    <p>{!! $news->content !!}</p>
                </div>
            </div>
            <div class='col-md-4'>
                <h6>Related news</h6>
                @foreach($relatedNews as $post)
                    <div class="post-loop-featured position-relative" style='background-image:url({{Storage::url($post->image)}});'>

                        <div class="post-content" lang="en">
                            <h4 style='color:#FFF;' class='slide_title'>{{$post->title}}</h4>
                            <p style='color:#FFF;' class='slide_description'>{{$post->description}}</p>
                            <a href='{{route("events.single", ["id" => $post->id])}}'><button class='btn learn_more'><i class="fas fa-plus"></i> Learn More</button></a>
                        </div>
                        <div class="overlay-1"></div>
                        <div class="overlay-news"></div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @include('layouts.footers.guest.footer')
@endsection
