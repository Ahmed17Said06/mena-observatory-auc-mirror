<div class="mt-3" id="Regional">

    <div class='container mt-3 mt-lg-0'>
              <h3 hreflang="{{ getLang() }}"
                  @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl" @endif >@lang('translation.featured')</h3>
              <div class="d-flex gap-3">
                  @foreach($featuredPosts as $n)
                      @if($loop->index>=3)
                          @break
                      @endif
                      <div class="post-loop-featured m-3
                       @if($loop->index===2)
                       research-border-border
                       @endif
                         position-relative overflow-hidden">
                          @if($loop->index<2)
                              <div class="category-stamp {{$n->tag}}">
                                  <span>{{$n->tag}}</span>
                              </div>
                          @endif
                          <img class="post-img" src="{{Storage::url($n->image)}}">
                          @if($loop->index===2)
                              <div class="research-border">
                                  <p>Platform Work MENA</p>
                                  <p class="sub-title">(PW-MENA)</p>
                              </div>
                          @endif
                          <div class="post-content " lang="en">
                              <h4 style='color:#FFF;' class='slide_title'>
                              <a href='{{$n->url}}'>{{$n->title}}</a>    
                              </h4>
                              <p style='color:#FFF;' class='slide_description'>{{$n->description}}</p>

                              <a href='{{$n->url}}'>
                                  <button class='btn learn_more'>
                                      <i class="fas fa-plus">
                                      </i> Read More
                                  </button>
                              </a>
                          </div>

                          <div class="overlay-1"></div>
                         
                      </div>

                  @endforeach
              </div>
              <div id='news_pagination'>
                {!! $featuredPosts->links() !!}
            </div>
      </div>