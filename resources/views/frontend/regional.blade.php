@extends('layouts.frontend.app', ['class' => 'g-sidenav-show bg-gray-100'])
<style>
    #map_outer {
        display: none !important;
    }
</style>
@section('content')
    @include('layouts.navbars.guest.navbar', ['title' => 'Dashboard'])

    <div class="container my-3 my-lg-5">
        <div class='row' @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl" @endif>
            <div class="col-lg-8">
                <h1 class="page-title">
                    @lang('translation.knowledge-hub')
                </h1>

                <div class="knowledge-text" hreflang="{{ getLang() }}" style="color: #333333 !important;">
                    @if(LaravelLocalization::getCurrentLocale() == 'ar')
                        {!!  $intro->ar_content !!}
                    @else
                        {!!  $intro->content !!}
                    @endif
                </div>
                {{-- <div style='' id="map"></div>--}}
            </div>
            <div class="col-lg-4">
                <div class="countries-map">
                    <img src="{{asset('/img/Group 2070.png')}}">
                </div>
            </div>

            {{-- Static Knowledge Hub Entries --}}
            <div class='row my-3 my-lg-5'>
                <div class='col-lg-9'>
                    <h4 class="mb-4" style="color: #1a1a2e;">Featured Publications</h4>

                    {{-- Entry 1: Beyond Robots --}}
                    <article class='result-card'
                        style="background: #fff; border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.06); border: 1px solid #f3f4f6;">
                        <div class='row g-3'>
                            <div class='col-lg-12'>
                                <div class="result-content">
                                    <a href="https://www.brandeis.edu/crown/publications/crown-conversations/cc-20.html"
                                        target="_blank" rel="noopener noreferrer" class="result-title"
                                        style="font-size: 1.25rem; font-weight: 700; color: #111827; text-decoration: none; display: block; margin-bottom: 0.75rem;">
                                        'Beyond Robots: Artificial Intelligence in the Middle East' A Conversation with
                                        Nagla Rizk and Omer Shah
                                    </a>
                                    <p class="result-description"
                                        style="color: #6b7280; font-size: 0.938rem; line-height: 1.6;">
                                        A conversation exploring artificial intelligence developments in the Middle East
                                        region, published by the Crown Center for Middle East Studies at Brandeis
                                        University.
                                    </p>
                                </div>
                                <div class="result-actions"
                                    style="display: flex; gap: 0.75rem; flex-wrap: wrap; margin-top: 1rem;">
                                    <a class="download-button"
                                        href="https://www.brandeis.edu/crown/publications/crown-conversations/cc-20.html"
                                        target="_blank"
                                        style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.625rem 1.125rem; background: #fff; border: 2px solid #e5e7eb; border-radius: 8px; color: #374151; font-weight: 600; font-size: 0.875rem; text-decoration: none;">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M10 6H6C4.89543 6 4 6.89543 4 8V18C4 19.1046 4.89543 20 6 20H16C17.1046 20 18 19.1046 18 18V14M14 4H20M20 4V10M20 4L10 14"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                        <span>Read Publication</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>

                    {{-- Entry 2: AI Governance in MENA --}}
                    <article class='result-card'
                        style="background: #fff; border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.06); border: 1px solid #f3f4f6;">
                        <div class='row g-3'>
                            <div class='col-lg-12'>
                                <div class="result-content">
                                    <a href="https://www.cambridge.org/core/journals/data-and-policy/article/exploring-ai-governance-in-the-middle-east-and-north-africa-mena-region-gaps-efforts-and-initiatives/867858AA465EEB06B5C43FF7048D8652"
                                        target="_blank" rel="noopener noreferrer" class="result-title"
                                        style="font-size: 1.25rem; font-weight: 700; color: #111827; text-decoration: none; display: block; margin-bottom: 0.75rem;">
                                        Exploring AI governance in the Middle East and North Africa (MENA) region: gaps,
                                        efforts, and initiatives
                                    </a>
                                    <p class="result-description"
                                        style="color: #6b7280; font-size: 0.938rem; line-height: 1.6;">
                                        Published online by Cambridge University Press in Data and Policy journal. This
                                        article explores AI governance in the MENA region, examining gaps, efforts, and
                                        initiatives.
                                    </p>
                                </div>
                                <div class="result-actions"
                                    style="display: flex; gap: 0.75rem; flex-wrap: wrap; margin-top: 1rem;">
                                    <a class="download-button"
                                        href="https://www.cambridge.org/core/journals/data-and-policy/article/exploring-ai-governance-in-the-middle-east-and-north-africa-mena-region-gaps-efforts-and-initiatives/867858AA465EEB06B5C43FF7048D8652"
                                        target="_blank"
                                        style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.625rem 1.125rem; background: #fff; border: 2px solid #e5e7eb; border-radius: 8px; color: #374151; font-weight: 600; font-size: 0.875rem; text-decoration: none;">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M10 6H6C4.89543 6 4 6.89543 4 8V18C4 19.1046 4.89543 20 6 20H16C17.1046 20 18 19.1046 18 18V14M14 4H20M20 4V10M20 4L10 14"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                        <span>Read Article</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            {{-- End Static Knowledge Hub Entries --}}

            <livewire:repo-list />
        </div>

        @include('layouts.footers.guest.footer')

@endsection