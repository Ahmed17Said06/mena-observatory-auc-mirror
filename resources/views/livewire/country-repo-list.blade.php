<div class="container my-3 my-lg-5">
    @if(count($repos) > 0)
        <div class='row my-3 my-lg-5'>
            <div class='col-lg-12'>
                <h3 @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl"
                    @endif hreflang="{{ getLang() }}">@lang('translation.additional-resources')</h3>
                
                <div style='
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    align-content: center;
    padding-bottom: 20px;'>

                    @foreach($repos as $r)
                        <div class="post-container">
                            <div class="post-loop position-relative overflow-hidden">
                                <img class="post-img" src="{{Storage::url($r->image)}}">

                                <div class="post-content" lang="en">
                                    <h4 style='color:#FFF;' class='slide_title'>
                                        <a href='{{$r->data_link}}'>{{$r->title}}</a>
                                    </h4>
                                    <p style='color:#FFF;' class='slide_description'>{{$r->description}}</p>

                                    <a href='{{$r->data_link}}'>
                                        <button class='btn learn_more'>
                                            <i class="fas fa-plus"></i> Read More
                                        </button>
                                    </a>
                                </div>

                                <div class="overlay-1"></div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Add Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $repos->links() }}
                </div>
            </div>
        </div>
    @endif
</div>