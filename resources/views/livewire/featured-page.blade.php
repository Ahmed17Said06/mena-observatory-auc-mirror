<div class="mt-3" id="Regional">

    <div class='container mt-3 mt-lg-0'>
              <h3 hreflang="{{ getLang() }}"
                  @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl" @endif >@lang('translation.featured')</h3>
              <div class="d-flex gap-3 flex-wrap lazy-items-container">
                  @foreach($featuredPosts as $index => $n)
                      <div class="post-loop-featured m-3 lazy-item
                       @if($index % 3 === 2)
                       research-border-border
                       @endif
                         position-relative overflow-hidden">
                          @if($index % 3 < 2)
                              <div class="category-stamp {{$n->tag}}">
                                  <span>{{$n->tag}}</span>
                              </div>
                          @endif
                          <img class="post-img" src="{{Storage::url($n->image)}}">
                          @if($index % 3 === 2)
                              <div class="research-border">
                                  <p>Future of Work MENA</p>
                                  <p class="sub-title">(Future of Work)</p>
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
                  
                  <!-- Global Index on Responsible AI - Static Card -->
                  <div class="post-loop-featured m-3 research-border-border position-relative overflow-hidden">
                      <img class="post-img" src="/img/girai-featured.jpg" onerror="this.src='/img/placeholder-featured.jpg'">
                      <div class="research-border">
                          <p>Global Index on Responsible AI</p>
                          <p class="sub-title">(GIRAI)</p>
                      </div>
                      <div class="post-content" lang="en">
                          <h4 style='color:#FFF;' class='slide_title'>
                              <a href='{{ route("ai_indices") }}'>Global Index on Responsible AI</a>
                          </h4>
                          <p style='color:#FFF;' class='slide_description'>Explore how countries across the MENA region are adopting responsible AI practices with the GIRAI assessment framework.</p>
                          <a href='{{ route("ai_indices") }}'>
                              <button class='btn learn_more'>
                                  <i class="fas fa-plus"></i> Explore Index
                              </button>
                          </a>
                      </div>
                      <div class="overlay-1"></div>
                  </div>
              </div>
              
              <!-- Load More Button -->
              @if($hasMorePages)
                  <div class="load-more-container">
                      <button 
                          class="btn-load-more"
                          wire:click="loadMore"
                          wire:loading.attr="disabled"
                          wire:loading.class="loading"
                      >
                          <span wire:loading.remove wire:target="loadMore">Load More</span>
                          <span wire:loading wire:target="loadMore" class="loading-state">
                              <span class="spinner"></span>
                              Loading...
                          </span>
                      </button>
                  </div>
              @endif
      </div>
</div>