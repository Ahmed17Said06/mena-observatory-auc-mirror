<div class='row'>
@foreach($news as $n)

<div class='col-md-4 slide' style='position: relative;'>
	<img src="{{Storage::url($n->image)}}" style="visibility: hidden;" width='100%;'/>
	<div style='background-image:url({{Storage::url($n->image)}});z-index:0;' class='overlay'></div>
	<div class='overlay' style='padding: 20px;'>
		<div style='position: absolute; bottom: 0px;'>
			<h3 style='color:#FFF;' class='slide_title'>{{$n->title}}</h3>
			<p style='color:#FFF;' class='slide_description'>{{$n->description}}</p>
			<a href='{{route("blogs.single", ["id" => $n->id])}}'><button class='btn learn_more'><i class="fas fa-plus"></i> Learn More</button></a>
		</div>
	</div>

</div>

@endforeach
</div>
<div id='news_pagination'>
{{$news->links()}}
</div>
