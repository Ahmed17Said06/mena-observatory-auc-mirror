<div class='col-12'>

    <div id="blogs">
        <div class="flex-column flex-md-row" style='
    display: flex;
    flex-wrap: wrap;
    align-content: center;
    padding-bottom: 50px;'>
            @foreach($blogs as $n)
                <div class="post-container">
                    <div class="post-loop-events position-relative overflow-hidden">
                        <img class="post-img" src="{{Storage::url($n->image)}}">
                        <div class="post-content" lang="en">
                            <h4 style='color:#FFF;' class='slide_title'>{{$n->title}}</h4>
                            <p style='color:#FFF;' class='slide_description'>{{$n->description}}</p>

                            <a href='{{route("news", ["id" => $n->id])}}'><button class='btn learn_more'><i class="fas fa-plus"></i> Learn More</button></a>
                        </div>

                        <div class="overlay-1"></div>
                        <div class="overlay-news"></div>
                    </div>
                </div>
            @endforeach
        </div>
        {{$blogs->onEachSide(1)->links()}}


    </div>
</div>
