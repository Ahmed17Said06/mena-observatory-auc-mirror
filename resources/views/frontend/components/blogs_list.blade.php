@foreach($events as $event)
<div class='row' style='margin-bottom:30px;'>
	<div class='col-md-3' style=' /*display: flex;
    align-items: center;*/
     '>
		<div>
			<h6>{{date('Y', strtotime($event->start_date))}}</h6>
			<h4>{{date('M', strtotime($event->start_date))}}</h4>
			<h4>{{date('d', strtotime($event->start_date))}}</h4>
		</div>
	</div>
	<div class='col-md-6'>
		<p>@ {{date('h:i A', strtotime($event->start_date))}} - {{date('h:i A', strtotime($event->end_date))}} <span style='float:right;'>{{$event->type}}</span></p>
		<h5>{{$event->title}}</h5>
		<p>
		{{$event->description}}
		</p>
		<a href="http://www.google.com/calendar/event?action=TEMPLATE&text={{urlencode($event->title)}}&dates={{str_replace(' ', '', date('Y m d \T h m s Z', strtotime($event->start_date)))}}/{{str_replace(' ', '', date('Y m d \T h m s Z', strtotime($event->end_date)))}}&details={{urlencode($event->description)}}&location={{urlencode($event->gmaps_url)}}"><i class="far fa-bookmark"></i> SAVE TO MY CALANDAR</a>

	</div>
	<div class='col-md-3'>
	<img src = '{{Storage::url($event->image)}}' width='100%;'>
	</div>
</div>
@endforeach
