@extends('layouts.frontend.app', ['class' => 'g-sidenav-show bg-gray-100'])
<style>

    #map_outer{
        display:none !important;
    }

    /* Article body — supports rich press-release markup (headings, quotes,
       lists) and Arabic RTL blocks embedded in an otherwise LTR page. */
    .news-body { line-height: 1.9; color: #333; }
    .news-body h3, .news-body h4 { color: #022448; font-weight: 700; margin: 1.75rem 0 .75rem; }
    .news-body p { margin-bottom: 1rem; }
    .news-body ul { padding-inline-start: 1.25rem; margin-bottom: 1rem; }
    .news-body li { margin-bottom: .5rem; }
    .news-body blockquote {
        margin: 1.25rem 0;
        padding: .85rem 1.15rem;
        border-inline-start: 3px solid #FAAF1C;
        background: #f8f9fb;
        color: #022448;
        font-style: italic;
    }
    .news-body hr { margin: 2rem 0; border: 0; border-top: 1px solid #e8eaed; }
    .news-body [dir="rtl"] { text-align: right; }
    .news-body a { color: #022448; text-decoration: underline; }
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
                            <a class="tag" href="/search?tag={{ urlencode($tag->name) }}">
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
                    {{-- Block-level markup (headings, lists, blockquotes, RTL wrappers)
                         must not be nested inside a <p>, or the browser closes it early. --}}
                    <div class="news-body">{!! $news->content !!}</div>
                </div>
            </div>
            <div class='col-md-4'>
                <h6>Related news</h6>
                <div class="related-list">
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
    </div>
    @include('layouts.footers.guest.footer')
@endsection
