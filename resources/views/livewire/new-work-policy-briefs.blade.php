<div class="container policy-briefs-section">
    <h3 class="mb-4" @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl" @endif>
        @lang('translation.policy-briefs')
    </h3>

    <div style='
display: flex;
flex-direction: row;
flex-wrap: wrap;
align-content: center;
padding-bottom: 50px;'>
        @if($policyBriefs && $policyBriefs->count() > 0)
            @foreach($policyBriefs as $brief)
                <div class="post-container">
                    <div class="post-loop position-relative overflow-hidden">
                        @if($brief->image_path)
                            <img class="post-img" src="{{ asset('storage/' . $brief->image_path) }}" alt="{{ $brief->title }}">
                        @else
                            <img class="post-img" src="{{ asset('img/placeholder.png') }}" alt="Policy Brief Image">
                        @endif

                        <div class="post-content" lang="en">
                            <h4 style='color:#FFF;' class='slide_title'>{{ $brief->title }}</h4>
                            <p style='color:#FFF;' class='slide_description'>{{ Str::limit(strip_tags($brief->description), 80) }}</p>
                            @if($brief->file_path)
                                <a href="{{ asset('storage/' . $brief->file_path) }}" target="_blank">
                                    <button class='btn learn_more'><i class="fas fa-plus"></i> Read More</button>
                                </a>
                            @else
                                <button class='btn learn_more disabled'><i class="fas fa-plus"></i> Not Available</button>
                            @endif
                        </div>
                        <div class="overlay-1"></div>
                    </div>
                </div>
            @endforeach
        @else
            @for($i = 0; $i < 3; $i++)
                <div class="post-container">
                    <div class="post-loop position-relative overflow-hidden">
                        <img class="post-img" src="{{ asset('img/placeholder.png') }}" alt="Policy Brief Image">
                        <div class="post-content" lang="en">
                            <h4 style='color:#FFF;' class='slide_title'>No Policy Brief</h4>
                            <p style='color:#FFF;' class='slide_description'>No policy briefs available yet. Please add policy briefs from the admin panel.</p>
                            <button class='btn learn_more disabled'><i class="fas fa-plus"></i> Not Available</button>
                        </div>
                        <div class="overlay-1"></div>
                    </div>
                </div>
            @endfor
        @endif
    </div>

    @if($policyBriefs->hasPages())
        <div class="d-flex justify-content-center">
            {{ $policyBriefs->links() }}
        </div>
    @endif
</div>
