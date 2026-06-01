<div class="mt-3" id="Regional">

    <div class='container mt-3 mt-lg-0'>
        <h3 hreflang="{{ getLang() }}"
            @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl" @endif>@lang('translation.featured')</h3>
        <div class="d-flex gap-3 flex-wrap lazy-items-container justify-content-center">

            @foreach($initiativeCards as $card)
            @php
                $isAr   = LaravelLocalization::getCurrentLocale() === 'ar';
                $label  = $isAr && $card->label_ar     ? $card->label_ar     : $card->label_en;
                $sub    = $isAr && $card->sub_label_ar  ? $card->sub_label_ar  : $card->sub_label_en;
                $title  = $isAr && $card->title_ar     ? $card->title_ar     : $card->title_en;
                $btnTxt = $isAr && $card->button_text_ar ? $card->button_text_ar : $card->button_text_en;
                $href   = $card->link_external
                    ? $card->link
                    : (Route::has($card->link) ? route($card->link) : $card->link);
                $imgSrc = $card->image
                    ? Storage::url($card->image)
                    : asset('/img/placeholder-featured.jpg');
            @endphp
            <div class="post-loop-featured m-3 research-border-border position-relative overflow-hidden">
                <img class="post-img" src="{{ $imgSrc }}" onerror="this.src='{{ asset('/img/placeholder-featured.jpg') }}'">
                <div class="research-border">
                    <p>{{ strtoupper($label) }}</p>
                    @if($sub)<p class="sub-title">({{ strtoupper($sub) }})</p>@endif
                </div>
                <div class="post-content" lang="{{ $isAr ? 'ar' : 'en' }}">
                    <h4 style='color:#FFF;' class='slide_title'>
                        <a href="{{ $href }}"
                           @if($card->link_external) target="_blank" rel="noopener noreferrer" @endif>
                            {{ $title }}
                        </a>
                    </h4>
                    <a href="{{ $href }}"
                       @if($card->link_external) target="_blank" rel="noopener noreferrer" @endif>
                        <button class='btn learn_more'>
                            <i class="fas {{ $card->button_icon }}"></i>
                            {{ $btnTxt }}
                        </button>
                    </a>
                </div>
                <div class="overlay-1"></div>
            </div>
            @endforeach

        </div>
    </div>
</div>
