<div class="container">
    <h3 @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl"
        @endif hreflang="{{ getLang() }}">@lang('translation.posts')</h3>
    <div style='
display: flex;
flex-direction: row;
flex-wrap: wrap;
align-content: center;
padding-bottom: 50px;'>
        <?php $i = 0; ?>
        @foreach($blogs as $n)
                <?php
                $i += 1;
                if ($i == 4) {
                    break;
                }
                ?>
            <div class="post-container">
                <div class="post-loop position-relative overflow-hidden">
                    <img class="post-img" src="{{Storage::url($n->image)}}">
                    <div class="post-content" lang="en">
                        <h4 style='color:#FFF;' class='slide_title'>
                        <a href='{{route("blogs.single", ["id" => $n->id])}}'>{{$n->title}}</a>
                        </h4>
                        <p style='color:#FFF;' class='slide_description'>{{$n->description}}</p>
                        <a href='{{route("blogs.single", ["id" => $n->id])}}'>
                            <button class='btn learn_more'><i class="fas fa-plus"></i> Read More</button>
                        </a>
                    </div>

                    <div class="overlay-1"></div>
                    {{--            <div class="overlay-news"></div>--}}
                </div>
            </div>
        @endforeach
    </div>
    <div id='news_pagination'>
        {!! $blogs->links() !!}
    </div>
</div>