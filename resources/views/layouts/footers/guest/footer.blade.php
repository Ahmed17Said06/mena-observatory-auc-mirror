<footer class="my-3" id='footer'>
    <hr>
    <div class="mb-4 mt-3" hreflang="{{ getLang() }}" id='footer-menu'>
        <a class="btn-footer" href="{{route('about_us')}}">@lang('translation.about-us')</a>
        <a class="btn-footer" href="{{route('regional')}}">@lang('translation.knowledge-hub')</a>

{{--        <a class="btn-footer" href="{{route('news_events')}}">NEWS & EVENTS</a>--}}
        <a class="btn-footer" href="{{route('community')}}">@lang('translation.community')</a>
        <a class="btn-footer" href="{{route('blogs')}}">@lang('translation.posts')</a>
        <a class="btn-footer" href="{{route('contact_us')}}">@lang('translation.contact-us')</a>
    </div>

    @php
        $socialTwitter   = strip_tags(\App\Models\static_content::where('key', 'social_twitter')->latest()->value('content')   ?? 'https://x.com/MENAObs_AI');
        $socialInstagram = strip_tags(\App\Models\static_content::where('key', 'social_instagram')->latest()->value('content') ?? 'https://www.instagram.com/menaobservatory.ai/');
        $socialFacebook  = strip_tags(\App\Models\static_content::where('key', 'social_facebook')->latest()->value('content')  ?? 'https://www.facebook.com/a2k4d/');
        $socialYoutube   = strip_tags(\App\Models\static_content::where('key', 'social_youtube')->latest()->value('content')   ?? 'https://www.youtube.com/@MENAObservatory.AI_');
    @endphp
    <div class="d-flex justify-content-center" style='margin-top:30px;'>
        <a href="{{ $socialTwitter }}" target="_blank" class="fa-brands fa-x-twitter"></a>
        <a href="{{ $socialInstagram }}" target="_blank" class="fa-brands fa-instagram"></a>
        <a href="{{ $socialFacebook }}" target="_blank" class="fa-brands fa-facebook"></a>
        <a href="{{ $socialYoutube }}" target="_blank" class="fa-brands fa-youtube"></a>
    </div>
    <div style='margin-top:16px;'>
    <a href="mailto:info@menaobservatory.ai"
       style='margin-top:10px;font-size:14px;font-weight:700;font-family:"Gotham";color: #393939;'>info@menaobservatory.ai</a>
    </div>
    <div class = 'line'></div>


    <div style='width:100%;text-align:center;display:flex;align-items:center;justify-content:center;gap:48px;flex-wrap:wrap;'>
        <img src="{{ asset('/img/newLogo.png') }}" height='160px'>
        <img src="{{ asset('/img/logo2.png') }}" height='90px'>
    </div>
    <p id='privacy' style='margin-top:40px;color: #444444;'>@lang('translation.privacy')</p>

</footer>
