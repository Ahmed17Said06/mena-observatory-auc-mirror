@foreach($events as $event)
    <div class='row' style='margin-bottom:30px;'>
        <div class='col-lg-4'>
            <img class="event_img" src = '{{Storage::url($event->image)}}' width='100%;'>
        </div>
        <div class='col-lg-8'>
            <p class="event-title">{{$event->title}}
                <span class="event_attendance hybrid">{{$event->type}}</span>
            </p>
            <p class="event-description">
                {{$event->description}}
            </p>
            <div class="d-flex">
                    <div class="tag">
                        Tag A
                    </div>
            </div>
        <hr class="my-3">
    </div>
    </div>
    @endforeach
