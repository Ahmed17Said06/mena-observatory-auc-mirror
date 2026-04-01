@extends('layouts.frontend.app', ['class' => 'g-sidenav-show bg-gray-100'])
<style>

    #map_outer {
        display: none !important;
    }
</style>
@section('content')
    @include('layouts.navbars.guest.navbar', ['title' => 'Dashboard'])
    <div class="container-fluid position-relative my-5" style="padding-bottom: 100px">
        <div class="bg-images contactus">
            <script src="https://unpkg.com/@dotlottie/player-component@1.0.0/dist/dotlottie-player.js"></script>
            <dotlottie-player autoplay loop src="/img/g_bot_left.lottie" class="g_bot_left"></dotlottie-player>
            <dotlottie-player autoplay loop src="/img/g_bot_right.lottie" class="g_bot_right"></dotlottie-player>
            <dotlottie-player autoplay loop src="/img/g_top_left_mid.lottie" class="g_top_left_mid"></dotlottie-player>
            <dotlottie-player autoplay loop src="/img/g_top_left.lottie" class="g_top_left"></dotlottie-player>
            <dotlottie-player autoplay loop src="/img/g_top_right.lottie" class="g_top_right"></dotlottie-player>

        </div>

        <div class="container p-0">
            <div class='row my-5' style="max-width: 700px; margin: auto">
                <div class='my-4 col-md-12' style='text-align:center;'>
                    <h3>
                        @lang('translation.submit_event')
                    </h3>
                </div>
                <x-alert-two/>
                <form class="my-4" role="form" method="POST" action="{{ route('post.submit.event') }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <div class="flex flex-col mb-3">
                        <input type="text" name="name" class="form-control form-control-lg"
                               placeholder="Your Name"
                               aria-label="Your Name" required>
                    </div>
                    <div class="flex flex-col mb-3">
                        <input type="email" name="email" class="form-control form-control-lg"
                               placeholder="Your Email"
                               aria-label="Your Email" required>
                    </div>
                    <div class="flex flex-col mb-3">
                        <input type="tel" name="tel" class="form-control form-control-lg"
                               placeholder="Your Phone Number" aria-label="Your Phone Number" required>
                    </div>
                    <div class="flex flex-col mb-3">
                <textarea rows="3" name="bio" class="form-control form-control-lg"
                          placeholder="Brief Bio (250-350 words)" aria-label="Brief Bio (250-350 words)"
                          required></textarea>
                    </div>
                    <div class="flex flex-col mb-3">
                        <input type="text" name="event_description" class="form-control form-control-lg"
                               placeholder="Event Description" aria-label="Event Description" required>
                    </div>
                    <div class="flex flex-col mb-3">
                        <input type="text" name="event_day" class="form-control form-control-lg"
                               placeholder="Event Day and Time" aria-label="Event Day and Time"
                               onfocus="(this.type='datetime-local')" onblur="(this.type='text')">

{{--                        <input type="datetime-local" name="event_day" class="form-control form-control-lg"--}}
{{--                               placeholder="Event Day and Time" aria-label="Event Day and Time" required>--}}
                    </div>
                    <div class="flex flex-col mb-3">
                        <input type="url" name="event_link" class="form-control form-control-lg"
                               placeholder="Event Link" aria-label="Event Link" required>
                    </div>
                    <div class="flex flex-col mb-3">
                        <label for="cv_uploads">Limit: 4MB
                        </label>

                        <div class="upload-btn">
                            <label for="supporting_material">Upload Supporting Material (Optional)
                                <img class="upload-icon"
                                     src="{{ asset("/img/Layer_1 (3).svg") }}">
                            </label>
                            <input type="file" id="supporting_material" name="supporting_material"
                                   accept=".pdf,.docx,.doc,.ppt,.pptx"
                                   style="opacity: 0;">
                        </div>
                    </div>
                    <div class="row flex-lg-row flex-column-reverse">
                        <div class="col-12 col-lg-12">
                            <button type="submit" class="btn btn-mena-3 float-end">
                                @lang('translation.submit_event')
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('layouts.footers.guest.footer')

@endsection
