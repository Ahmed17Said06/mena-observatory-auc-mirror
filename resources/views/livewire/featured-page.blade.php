<div class="mt-3" id="Regional">

    <div class='container mt-3 mt-lg-0'>
              <h3 hreflang="{{ getLang() }}"
                  @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl" @endif >@lang('translation.featured')</h3>
              <div class="d-flex gap-3 flex-wrap lazy-items-container justify-content-center">
                  
                  <!-- Safe AI for Children - MENA Chapter -->
                  <div class="post-loop-featured m-3 research-border-border position-relative overflow-hidden">
                      <img class="post-img" src="/img/safe-ai-children.jpg" onerror="this.src='/img/placeholder-featured.jpg'">
                      <div class="research-border">
                          <p>Safe AI for Children</p>
                          <p class="sub-title">(MENA Chapter)</p>
                      </div>
                      <div class="post-content" lang="en">
                          <h4 style='color:#FFF;' class='slide_title'>
                              <a href='{{ route("coming-soon") }}'>
                                  @if(LaravelLocalization::getCurrentLocale() === 'ar')
                                      الذكاء الاصطناعي الآمن للأطفال - فرع منطقة الشرق الأوسط وشمال أفريقيا
                                  @else
                                      Safe AI for Children - MENA Chapter
                                  @endif
                              </a>
                          </h4>
                          <p style='color:#FFF;' class='slide_description'>
                              @if(LaravelLocalization::getCurrentLocale() === 'ar')
                                  التحالف الدولي لسلامة الذكاء الاصطناعي للأطفال (i-raise)
                              @else
                                  The International Coalition for AI Safety for Children (i-raise)
                              @endif
                          </p>
                          <a href='{{ route("coming-soon") }}'>
                              <button class='btn learn_more'>
                                  <i class="fas fa-clock"></i>
                                  @if(LaravelLocalization::getCurrentLocale() === 'ar')
                                      قريباً
                                  @else
                                      Coming Soon
                                  @endif
                              </button>
                          </a>
                      </div>
                      <div class="overlay-1"></div>
                  </div>

                  <!-- RAI Cup Awards Ceremony -->
                  <div class="post-loop-featured m-3 research-border-border position-relative overflow-hidden">
                      <img class="post-img" src="/img/rai-cup-featured.jpg" onerror="this.src='/img/placeholder-featured.jpg'">
                      <div class="research-border">
                          <p>Responsible AI Cup</p>
                          <p class="sub-title">(Awards Ceremony)</p>
                      </div>
                      <div class="post-content" lang="en">
                          <h4 style='color:#FFF;' class='slide_title'>
                              <a href='{{ route("news.rai-cup") }}'>
                                  @if(LaravelLocalization::getCurrentLocale() === 'ar')
                                      حفل ختام كأس الذكاء الاصطناعي المسؤول
                                  @else
                                      Responsible AI Cup Awards Ceremony
                                  @endif
                              </a>
                          </h4>
                          <p style='color:#FFF;' class='slide_description'>
                              @if(LaravelLocalization::getCurrentLocale() === 'ar')
                                  تحت رعاية وزارة الاتصالات وتكنولوجيا المعلومات - 18 يناير 2026
                              @else
                                  Under the Patronage of MCIT - January 18, 2026
                              @endif
                          </p>
                          <a href='{{ route("news.rai-cup") }}'>
                              <button class='btn learn_more'>
                                  <i class="fas fa-plus"></i>
                                  @if(LaravelLocalization::getCurrentLocale() === 'ar')
                                      اقرأ المزيد
                                  @else
                                      Read More
                                  @endif
                              </button>
                          </a>
                      </div>
                      <div class="overlay-1"></div>
                  </div>

                  <!-- Global Index on Responsible AI -->
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
      </div>
</div>