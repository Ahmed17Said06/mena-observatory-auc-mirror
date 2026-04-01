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
                              <a href='https://i-raise.org/' target='_blank' rel='noopener noreferrer'>
                                  @php $v = $sc->get('featured_safe_ai_title') @endphp
                                  @if($v){{ LaravelLocalization::getCurrentLocale() === 'ar' && $v->ar_content ? $v->ar_content : $v->content }}
                                  @elseif(LaravelLocalization::getCurrentLocale() === 'ar')الذكاء الاصطناعي الآمن للأطفال - فرع منطقة الشرق الأوسط وشمال أفريقيا
                                  @else Safe AI for Children - MENA Chapter
                                  @endif
                              </a>
                          </h4>
                          <p style='color:#FFF;' class='slide_description'>
                              @php $v = $sc->get('featured_safe_ai_desc') @endphp
                              @if($v){{ LaravelLocalization::getCurrentLocale() === 'ar' && $v->ar_content ? $v->ar_content : $v->content }}
                              @elseif(LaravelLocalization::getCurrentLocale() === 'ar')التحالف الدولي لسلامة الذكاء الاصطناعي للأطفال (i-raise)
                              @else The International Coalition for AI Safety for Children (i-raise)
                              @endif
                          </p>
                          <a href='https://i-raise.org/' target='_blank' rel='noopener noreferrer'>
                              <button class='btn learn_more'>
                                  <i class="fas fa-external-link-alt"></i>
                                  @if(LaravelLocalization::getCurrentLocale() === 'ar')
                                      زيارة الموقع
                                  @else
                                      Visit Website
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
                                  @php $v = $sc->get('featured_rai_cup_title') @endphp
                                  @if($v){{ LaravelLocalization::getCurrentLocale() === 'ar' && $v->ar_content ? $v->ar_content : $v->content }}
                                  @elseif(LaravelLocalization::getCurrentLocale() === 'ar')حفل ختام كأس الذكاء الاصطناعي المسؤول
                                  @else Responsible AI Cup Awards Ceremony
                                  @endif
                              </a>
                          </h4>
                          <p style='color:#FFF;' class='slide_description'>
                              @php $v = $sc->get('featured_rai_cup_subtitle') @endphp
                              @if($v){{ LaravelLocalization::getCurrentLocale() === 'ar' && $v->ar_content ? $v->ar_content : $v->content }}
                              @elseif(LaravelLocalization::getCurrentLocale() === 'ar')تحت رعاية وزارة الاتصالات وتكنولوجيا المعلومات - 18 يناير 2026
                              @else Under the Patronage of MCIT - January 18, 2026
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
                              <a href='{{ route("ai_indices") }}'>
                                  @php $v = $sc->get('featured_girai_title') @endphp
                                  @if($v){{ LaravelLocalization::getCurrentLocale() === 'ar' && $v->ar_content ? $v->ar_content : $v->content }}
                                  @else Global Index on Responsible AI
                                  @endif
                              </a>
                          </h4>
                          <p style='color:#FFF;' class='slide_description'>
                              @php $v = $sc->get('featured_girai_desc') @endphp
                              @if($v){{ LaravelLocalization::getCurrentLocale() === 'ar' && $v->ar_content ? $v->ar_content : $v->content }}
                              @else Explore how countries across the MENA region are adopting responsible AI practices with the GIRAI assessment framework.
                              @endif
                          </p>
                          <a href='{{ route("ai_indices") }}'>
                              <button class='btn learn_more'>
                                  <i class="fas fa-plus"></i> Explore Index
                              </button>
                          </a>
                      </div>
                      <div class="overlay-1"></div>
                  </div>

                  <!-- Future of Work MENA -->
                  <div class="post-loop-featured m-3 research-border-border position-relative overflow-hidden">
                      <img class="post-img" src="/img/new_work.png" onerror="this.src='/img/placeholder-featured.jpg'">
                      <div class="research-border">
                          <p>Future of Work MENA</p>
                          <p class="sub-title">(Platform Workers)</p>
                      </div>
                      <div class="post-content" lang="en">
                          <h4 style='color:#FFF;' class='slide_title'>
                              <a href='{{ route("pw_mena") }}'>
                                  @php $v = $sc->get('featured_pw_mena_title') @endphp
                                  @if($v){{ LaravelLocalization::getCurrentLocale() === 'ar' && $v->ar_content ? $v->ar_content : $v->content }}
                                  @elseif(LaravelLocalization::getCurrentLocale() === 'ar')مستقبل العمل في منطقة الشرق الأوسط وشمال أفريقيا
                                  @else Future of Work MENA
                                  @endif
                              </a>
                          </h4>
                          <p style='color:#FFF;' class='slide_description'>
                              @php $v = $sc->get('featured_pw_mena_desc') @endphp
                              @if($v){{ LaravelLocalization::getCurrentLocale() === 'ar' && $v->ar_content ? $v->ar_content : $v->content }}
                              @elseif(LaravelLocalization::getCurrentLocale() === 'ar')بحثنا حول عمال المنصات الرقمية في منطقة الشرق الأوسط وشمال أفريقيا
                              @else Our research on platform work in the MENA region
                              @endif
                          </p>
                          <a href='{{ route("pw_mena") }}'>
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

                  <!-- Brochures -->
                  <div class="post-loop-featured m-3 research-border-border position-relative overflow-hidden">
                      <img class="post-img" src="/img/placeholder-featured.jpg" onerror="this.src='/img/placeholder-featured.jpg'">
                      <div class="research-border">
                          <p>MENA Observatory</p>
                          <p class="sub-title">(Brochures)</p>
                      </div>
                      <div class="post-content" lang="en">
                          <h4 style='color:#FFF;' class='slide_title'>
                              <a href='{{ route("brochures.index") }}'>
                                  @php $v = $sc->get('featured_brochures_title') @endphp
                                  @if($v){{ LaravelLocalization::getCurrentLocale() === 'ar' && $v->ar_content ? $v->ar_content : $v->content }}
                                  @elseif(LaravelLocalization::getCurrentLocale() === 'ar')كتيبات المرصد
                                  @else Observatory Brochures
                                  @endif
                              </a>
                          </h4>
                          <p style='color:#FFF;' class='slide_description'>
                              @php $v = $sc->get('featured_brochures_desc') @endphp
                              @if($v){{ LaravelLocalization::getCurrentLocale() === 'ar' && $v->ar_content ? $v->ar_content : $v->content }}
                              @elseif(LaravelLocalization::getCurrentLocale() === 'ar')تصفح كتيبات ومطبوعات مرصد الشرق الأوسط وشمال أفريقيا للذكاء الاصطناعي المسؤول
                              @else Browse publications and brochures from the MENA Observatory on Responsible AI
                              @endif
                          </p>
                          <a href='{{ route("brochures.index") }}'>
                              <button class='btn learn_more'>
                                  <i class="fas fa-plus"></i>
                                  @if(LaravelLocalization::getCurrentLocale() === 'ar')
                                      تصفح الكتيبات
                                  @else
                                      Browse Brochures
                                  @endif
                              </button>
                          </a>
                      </div>
                      <div class="overlay-1"></div>
                  </div>
              </div>
      </div>
</div>