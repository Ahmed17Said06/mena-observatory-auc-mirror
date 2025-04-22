<footer class="my-3" id='footer'>
    <hr>
    <div class="mb-4 mt-3" hreflang="{{ getLang() }}" id='footer-menu'>
        <a class="btn-footer" href="{{route('about_us')}}">@lang('translation.about-us')</a>
        <a class="btn-footer" href="{{route('regional')}}">@lang('translation.knowledge-hub')</a>
        <a class="btn-footer" href="{{route('data_repo')}}">@lang('translation.data-depository')</a>
{{--        <a class="btn-footer" href="{{route('news_events')}}">NEWS & EVENTS</a>--}}
        <a class="btn-footer" href="{{route('community')}}">@lang('translation.community')</a>
        <a class="btn-footer" href="{{route('blogs')}}">@lang('translation.posts')</a>
        <a class="btn-footer" href="{{route('contact_us')}}">@lang('translation.contact-us')</a>
    </div>

    <div class="d-flex justify-content-center" style='margin-top:30px;'>
        <a href="#" class="fa-brands fa-x-twitter"></a>
        <a href="#" class="fa fa-instagram"></a>
{{--        <a href="#" class="fa fa-facebook"></a>--}}
        <a href="#" class="fa fa-linkedin"></a>
    </div>
    <div style='margin-top:16px;'>
    <a href="mailto:info@menaobservatory.ai"
       style='margin-top:10px;font-size:14px;font-weight:700;font-family:"Gotham";color: #393939;'>info@menaobservatory.ai</a>
    </div>
    <div class = 'line'></div>


    <div style='width:100%;text-align:center;'>
        <div >
            <img src="{{ asset('/img/newLogo.png') }}" height='215;'>
            <img src="{{ asset('/img/BZU_CCE_Logo.jpg') }}" height='105px;' style='margin-left:20px;margin-right:20px;'>
        </div>
        <div>
            <img src="{{ asset('/img/logo2.png') }}" height='99px;'>
        </div>
    </div>
    <p id='privacy' style='margin-top:40px;color: #444444;'>@lang('translation.privacy')</p>

</footer>
