<div class="flex-column flex-md-row" style='
    display: flex;
    flex-wrap: wrap;
    align-content: center;
    padding-bottom: 50px;'>
    @foreach($blogs as $n)
        <div class="post-container">
            <div class="post-loop-events position-relative overflow-hidden">
                <div class="category-stamp news">
                    <span>NEWS</span>
                </div>
                <img class="post-img" src="{{Storage::url($n->image)}}">
                <div class="post-content" lang="en">
                    <h4 style='color:#FFF;' class='slide_title'>{{$n->title}}</h4>
                    <p style='color:#FFF;' class='slide_description'>{{$n->description}}</p>

                    <a href='{{route("blogs.single", ["id" => $n->id])}}'><button class='btn learn_more'><i class="fas fa-plus"></i> Learn More</button></a>
                </div>

                <div class="overlay-1"></div>
                <div class="overlay-news"></div>
            </div>
        </div>
    @endforeach
</div>
{{$blogs->links()}}

<div id='blogs_pagination'>
    <div class="pagination">
        <a  href="#">&laquo;</a>
        <a href="#">1</a>
        <a class="active" href="#">2</a>
        <a href="#">3</a>
        <a href="#">4</a>
        <a href="#">5</a>
        <a href="#">6</a>
        <a href="#">&raquo;</a>
    </div>

</div>
