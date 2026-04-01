{{--@foreach($events as $event)--}}
{{--<div class='row flex-column-reverse flex-lg-row' style='margin-bottom:30px;'>--}}
{{--    <div class="col-lg-8 d-flex flex-column flex-lg-row">--}}
{{--        <div class='col-lg-4 col-12 d-flex flex-column flex-lg-row'>--}}
{{--		<div>--}}
{{--			<p class='event_year'>{{date('Y', strtotime($event->start_date ))}}--}}
{{--                <span class="event_attendance hybrid d-block d-lg-none">{{$event->type}}</span>--}}
{{--            </p>--}}
{{--			<p class='event_date' >--}}
{{--			{{date('M', strtotime($event->start_date))}}<br class="d-none d-lg-block">--}}
{{--			{{date('d', strtotime($event->start_date))}}--}}
{{--                </p>--}}
{{--		</div>--}}
{{--            <div class="d-block d-lg-none">--}}
{{--                <p class="event-date">Date {{date('Y', strtotime($event->start_date ))}} @ {{date('h:i A', strtotime($event->start_date))}} - {{date('h:i A', strtotime($event->end_date))}}--}}
{{--                    </p>--}}

{{--            </div>--}}
{{--	</div>--}}
{{--	<div class='col-lg-8'>--}}
{{--		<p class="event-date d-none d-lg-block">Date {{date('Y', strtotime($event->start_date ))}} @ {{date('h:i A', strtotime($event->start_date))}} - {{date('h:i A', strtotime($event->end_date))}}--}}
{{--            <span class="event_attendance hybrid">{{$event->type}}</span></p>--}}
{{--		<p class="event-title">{{$event->title}}</p>--}}
{{--		<p class="event-description">--}}
{{--		{{$event->description}}--}}
{{--		</p>--}}
{{--        <div class="d-none d-lg-block">--}}
{{--            <a class="notify_me"><i class="fa fa-bell"></i> Notify Me</a>--}}
{{--            <a class="save_to_calandar"--}}
{{--               href="http://www.google.com/calendar/event?action=TEMPLATE&text={{urlencode($event->title)}}&dates={{str_replace(' ', '', date('Y m d \T h m s Z', strtotime($event->start_date)))}}/{{str_replace(' ', '', date('Y m d \T h m s Z', strtotime($event->end_date)))}}&details={{urlencode($event->description)}}&location={{urlencode($event->gmaps_url)}}">--}}
{{--                <i class="far fa-bookmark"></i>  SAVE TO MY CALANDAR</a>--}}
{{--        </div>--}}
{{--	</div>--}}
{{--    </div>--}}

{{--    <div class='col-lg-4'>--}}
{{--        <div class='col-lg-12'>--}}
{{--	<img class="event_img" src = '{{Storage::url($event->image)}}' width='100%;'>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<div class="d-block d-lg-none">--}}
{{--    <a class="notify_me"><i class="fa fa-bell"></i> Notify Me</a>--}}
{{--    <a class="save_to_calandar"--}}
{{--       href="http://www.google.com/calendar/event?action=TEMPLATE&text={{urlencode($event->title)}}&dates={{str_replace(' ', '', date('Y m d \T h m s Z', strtotime($event->start_date)))}}/{{str_replace(' ', '', date('Y m d \T h m s Z', strtotime($event->end_date)))}}&details={{urlencode($event->description)}}&location={{urlencode($event->gmaps_url)}}">--}}
{{--        <i class="far fa-bookmark"></i>  SAVE TO MY CALANDAR</a>--}}
{{--</div>--}}

{{--<hr class="my-3">--}}

{{--@endforeach--}}
