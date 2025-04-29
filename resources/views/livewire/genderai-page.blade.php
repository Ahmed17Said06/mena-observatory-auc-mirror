<div class="container gender">
    <h3 hreflang="{{ getLang() }}"
        @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl" @endif >@lang('translation.gender-ai')</h3>
    <div style='
display: flex;
flex-direction: row;
flex-wrap: wrap;
align-content: center;
padding-bottom: 50px;'>

        @foreach($gender_ai as $n)
            @if($loop->index>3)
                @break
            @endif
            <div class="post-container
             @if($n->featured_type==='feminist_ai')
             feminist-ai-border
             @elseif($n->featured_type==='pw_mena')
             research-border-border
             @endif">
                <div class="post-loop position-relative overflow-hidden ">
                    @if($n->featured_type=='feminist_ai')
                        <div class="feminist-ai">
                            <p>Feminist AI</p>
                            <a href="https://aplusalliance.org/fair-middle-east-and-north-africa/">
                                <img src="{{ asset('/img/Feminist_AI_Logo.png') }}">
                            </a>
                        </div>
                    @elseif($n->featured_type=='pw_mena')
                        <div class="research-border">
                            <p>(PW-MENA)</p>
                            <p class="sub-title">Platform Work MENA</p>
                        </div>
                    @endif
                    <img class="post-img" src="{{Storage::url($n->thumbnail_image)}}">
                    <div class="post-content" lang="en">
                    <a href='{{$n->link}}'>  <h4 style='color:#FFF;' class='slide_title'>{{$n->title}}</h4></a>

                        <p style='color:#FFF;' class='slide_description'>{{$n->description}}</p>

                        <a href='{{$n->link}}'>

                            <button class='btn learn_more'><i class="fas fa-plus"></i> Read More</button>
                        </a>
                    </div>

                    <div class="overlay-1"></div>
                </div>
            </div>
        @endforeach
    </div>
    <div id='news_pagination'>
        {!! $gender_ai->links() !!}
    </div>
</div>