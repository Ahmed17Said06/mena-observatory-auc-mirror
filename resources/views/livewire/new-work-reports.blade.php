<div class="container">
    <h3 class="mb-4" @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl" @endif>
        @lang('translation.reports')
    </h3>

    <div style='
        display: flex;
        flex-direction: row;
        align-content: center;
        padding-bottom: 50px;
        gap: 1rem;
        justify-content: center;
    '>
        @if($reports && $reports->count() > 0)
            @foreach($reports as $report)
                <div class="post-container">
                    <div class="post-loop position-relative overflow-hidden">
                        @if($report->image_path)
                            <img class="post-img" src="{{ asset('storage/' . $report->image_path) }}" alt="{{ $report->title }}">
                        @else
                            <img class="post-img" src="{{ asset('img/placeholder.png') }}" alt="Report Image">
                        @endif

                        <div class="post-content" lang="en">
                            <h4 style='color:#FFF;' class='slide_title'>{{ $report->title }}</h4>
                            <p style='color:#FFF;' class='slide_description'>{{ Str::limit(strip_tags($report->description), 80) }}</p>
                            @if($report->file_path)
                                <a href="{{ asset('storage/' . $report->file_path) }}" target="_blank">
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
                        <img class="post-img" src="{{ asset('img/placeholder.png') }}" alt="Report Image">
                        <div class="post-content" lang="en">
                            <h4 style='color:#FFF;' class='slide_title'>No Report</h4>
                            <p style='color:#FFF;' class='slide_description'>No reports available yet. Please add reports from the admin panel.</p>
                            <button class='btn learn_more disabled'><i class="fas fa-plus"></i> Not Available</button>
                        </div>
                        <div class="overlay-1"></div>
                    </div>
                </div>
            @endfor
        @endif
    </div>

    @if($reports->hasPages())
        <div class="d-flex justify-content-center">
            {{ $reports->links() }}
        </div>
    @endif
</div>
