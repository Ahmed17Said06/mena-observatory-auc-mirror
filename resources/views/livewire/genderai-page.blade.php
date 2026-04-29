<div class="container gender">
    <h3 hreflang="{{ getLang() }}"
        @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl" @endif >@lang('translation.gender-ai')</h3>
    <div class="lazy-items-container" style='
display: flex;
flex-direction: row;
flex-wrap: wrap;
align-content: center;
padding-bottom: 50px;'>

        @foreach($gender_ai as $index => $n)
            <div class="post-container lazy-item
             @if($n->featured_type==='feminist_ai')
             feminist-ai-border
             @elseif($n->featured_type==='pw_mena')
             research-border-border
             @endif">
                <div class="post-loop position-relative overflow-hidden ">
                    @if($n->featured_type=='feminist_ai')
                        <div class="feminist-ai">
                            <p>Feminist AI</p>
                            <a href="{{ route('feminist_ai') }}">
                                <img src="{{ asset('/img/Feminist_AI_Logo.png') }}">
                            </a>
                        </div>
                    @elseif($n->featured_type=='pw_mena')
                        <div class="research-border">
                            <p>(Future of Work)</p>
                            <p class="sub-title">Future of Work MENA</p>
                        </div>
                    @endif
                    <img class="post-img" src="{{Storage::url($n->thumbnail_image)}}">
                    <div class="post-content" lang="en">
                    @php $cardLink = $n->featured_type === 'feminist_ai' ? route('feminist_ai') : $n->link; @endphp
                    <a href='{{ $cardLink }}'><h4 style='color:#FFF;' class='slide_title'>{!! str_replace(' – ', '<br>', e($n->title)) !!}</h4></a>

                        <p style='color:#FFF;' class='slide_description'>{{$n->description}}</p>

                        <a href='{{ $cardLink }}'>

                            <button class='btn learn_more'><i class="fas fa-plus"></i> Read More</button>
                        </a>
                    </div>

                    <div class="overlay-1"></div>
                </div>
            </div>
        @endforeach
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