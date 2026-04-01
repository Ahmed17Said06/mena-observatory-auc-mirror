@foreach($repos as $r)
        <div class='row' style='margin-bottom:30px;'>
            <div class='col-lg-3'>
{{--                <a href="{{route('resources.single',$r->id)}}">--}}
                <a href="{{$r->data_link}}">
                    <img class="event_img" src = '{{Storage::url($r->image)}}' width='100%;'> </a>
            </div>
            <div class='col-lg-9 d-flex justify-content-between flex-column'>
                <div>
                    <a href="{{route('repo.single',$r->id)}}" class="event-title">{{$r->title}}
                    <span style='float:right;' class="country_tag">{{$r->country->name}}
                        <img style="object-fit: contain;max-width: 46px;margin-left: 10px"  src="/img/egypt.svg">
                    </span>
                </a>
                <p class="event-description">
                    {{$r->description}}
                </p>
                </div>
                <div class="d-flex flex-column flex-lg-row">
                    <div class="col-lg-11">
                        @foreach($r->tags as $tag)
                            <a class="tag" href="/search?tag={{$tag->name}}">
                                {{$tag->name}}
                            </a>
                        @endforeach
                    </div>
                <div class="col-lg-1 d-flex pt-3 pt-lg-0" style="gap: 20px;
    justify-content: right;">
                    <div class="col-lg-1 d-flex pt-3 pt-lg-0" style="gap: 20px;
    justify-content: right;">
                        @isset($r->file) <a href="{{Storage::url($r->file)}}" target="_blank" class="d-flex">
                            <img style="object-fit: contain;max-width: 29px;"  src="/img/download.svg">
                        </a>
                        @endisset
                    </div>
                </div>
                </div>

            </div>
            <hr class="my-3">
        </div>
@endforeach
