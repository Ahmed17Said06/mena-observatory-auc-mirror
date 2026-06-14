@extends('layouts.frontend.app', ['class' => 'g-sidenav-show bg-gray-100'])
<style>
    #map_outer { display: none !important; }
</style>
@section('content')
    @include('layouts.navbars.guest.navbar', ['title' => 'Dashboard'])

    {{-- Publication Header --}}
    <div class="pub-header">
        <div class="pub-header-bg"></div>
        <div class="container position-relative" style="z-index:2">
            <nav class="pub-breadcrumb">
                <a href="{{ route('regional') }}">Knowledge Hub</a>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
                <span>Publication</span>
            </nav>
        </div>
    </div>

    <div class="pub-detail-page">
        <div class="container">
            <div class="pub-main-card">
                <div class="row g-0">
                    {{-- Cover Image --}}
                    <div class="col-lg-4">
                        <div class="pub-cover">
                            @if($repo->image && Storage::exists($repo->image))
                                <img src="{{ Storage::url($repo->image) }}" alt="{{ $repo->title }}">
                            @else
                                <div class="pub-cover-placeholder">
                                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                                        <polyline points="14 2 14 8 20 8"/>
                                        <line x1="16" y1="13" x2="8" y2="13"/>
                                        <line x1="16" y1="17" x2="8" y2="17"/>
                                        <polyline points="10 9 9 9 8 9"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Meta Info --}}
                    <div class="col-lg-8">
                        <div class="pub-info">
                            <h1 class="pub-title">{{ $repo->title }}</h1>

                            @if($repo->description)
                                <p class="pub-description">{{ $repo->description }}</p>
                            @endif

                            <div class="pub-meta">
                                @if($repo->publish_date)
                                    <div class="pub-meta-item">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                        <span>{{ \Carbon\Carbon::parse($repo->publish_date)->format('F j, Y') }}</span>
                                    </div>
                                @endif
                                @if($repo->country)
                                    <div class="pub-meta-item">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                        <span>{{ $repo->country->name }}</span>
                                    </div>
                                @endif
                                @if($repo->authors && $repo->authors->count())
                                    <div class="pub-meta-item">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                        <span>{{ $repo->authors->pluck('name')->join(', ') }}</span>
                                    </div>
                                @endif
                                @if($repo->is_our_work !== null)
                                    <div class="pub-meta-item">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                                        <span class="pub-work-badge {{ $repo->is_our_work ? 'our-work' : 'other-work' }}">
                                            {{ $repo->is_our_work ? 'Our Work' : 'Other Work' }}
                                        </span>
                                    </div>
                                @endif
                            </div>

                            @if(count($repo->tags) > 0)
                                <div class="pub-tags">
                                    @foreach($repo->tags as $tag)
                                        <a href="/search?tag={{ urlencode($tag->name) }}" class="pub-tag">{{ $tag->name }}</a>
                                    @endforeach
                                </div>
                            @endif

                            <div class="pub-actions">
                                @if($repo->data_link)
                                    <a href="{{ $repo->data_link }}" target="_blank" class="pub-btn pub-btn-primary">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                                        View Source
                                    </a>
                                @endif
                                @if($repo->en_pdf)
                                    <a href="{{ Storage::url($repo->en_pdf) }}" target="_blank" class="pub-btn pub-btn-outline">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                                        English PDF
                                    </a>
                                @endif
                                @if($repo->ar_pdf)
                                    <a href="{{ Storage::url($repo->ar_pdf) }}" target="_blank" class="pub-btn pub-btn-outline">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                                        Arabic PDF
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- YouTube Video Embed --}}
            @if($repo->data_link)
                @php
                    $videoId = null;
                    if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $repo->data_link, $matches)) {
                        $videoId = $matches[1];
                    }
                @endphp
                @if($videoId)
                    <div class="pub-video-section">
                        <h3 class="pub-section-title">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                            Video
                        </h3>
                        <div class="pub-video-wrapper">
                            <iframe src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        </div>
                    </div>
                @endif
            @endif

            {{-- Content --}}
            @if($repo->content)
                <div class="pub-content-section">
                    <div class="pub-content-body">
                        {!! $repo->content !!}
                    </div>
                </div>
            @endif

            {{-- Related PDF Files --}}
            @if(count($repo->pdfFiles))
                <div class="pub-related-section">
                    <h3 class="pub-section-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                        Additional Resources
                    </h3>
                    <div class="row g-3">
                        @foreach($repo->pdfFiles as $r)
                            <div class="col-lg-6">
                                <div class="pub-resource-card">
                                    <div class="row g-0 align-items-center">
                                        @if($r->image)
                                            <div class="col-4">
                                                <img class="pub-resource-img" src="{{ Storage::url($r->image) }}" alt="{{ $r->name }}">
                                            </div>
                                        @endif
                                        <div class="{{ $r->image ? 'col-8' : 'col-12' }}">
                                            <div class="pub-resource-body">
                                                <h5 class="pub-resource-title">{{ $r->name }}</h5>
                                                @if($r->description)
                                                    <p class="pub-resource-desc">{{ $r->description }}</p>
                                                @endif
                                                @isset($r->file)
                                                    <a href="{{ Storage::url($r->file) }}" target="_blank" class="pub-resource-dl">
                                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                                                        Download
                                                    </a>
                                                @endisset
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="pub-back-wrap">
                <a href="{{ route('regional') }}" class="pub-back-link">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                    Back to Knowledge Hub
                </a>
            </div>
        </div>
    </div>

    @include('layouts.footers.guest.footer')
@endsection

<style>
/* ── Header ── */
.pub-header {
    background: linear-gradient(135deg, #011830 0%, #022448 50%, #0a3a6e 100%);
    padding: 50px 0 30px; position: relative; overflow: hidden;
}
.pub-header-bg {
    position: absolute; inset: 0;
    background-image: radial-gradient(circle at 20% 50%, rgba(250,175,28,.05), transparent 50%);
}
.pub-breadcrumb {
    display: flex; align-items: center; gap: .5rem; font-size: .85rem;
}
.pub-breadcrumb a { color: rgba(255,255,255,.5); text-decoration: none; transition: color .2s; }
.pub-breadcrumb a:hover { color: #FAAF1C; }
.pub-breadcrumb svg { color: rgba(255,255,255,.3); }
.pub-breadcrumb span { color: rgba(255,255,255,.85); font-weight: 600; }

/* ── Page ── */
.pub-detail-page { background: #f8f9fa; padding: 0 0 60px; }

/* ── Main Card ── */
.pub-main-card {
    background: #fff; border-radius: 16px; overflow: hidden;
    box-shadow: 0 4px 24px rgba(0,0,0,.07); margin-top: -20px;
    position: relative; z-index: 2;
}
.pub-cover {
    height: 100%; min-height: 320px; overflow: hidden; background: #f3f4f6;
}
.pub-cover img {
    width: 100%; height: 100%; object-fit: cover;
}
.pub-info { padding: 2rem 2.5rem; display: flex; flex-direction: column; justify-content: center; }

.pub-title {
    font-size: 1.6rem; font-weight: 800; color: #1a1a2e;
    line-height: 1.35; margin-bottom: 1rem;
}
.pub-description { color: #4b5563; font-size: .95rem; line-height: 1.7; margin-bottom: 1.25rem; }

.pub-meta { display: flex; flex-wrap: wrap; gap: 1.25rem; margin-bottom: 1.25rem; }
.pub-meta-item {
    display: flex; align-items: center; gap: .4rem;
    color: #6b7280; font-size: .85rem;
}
.pub-meta-item svg { color: #FAAF1C; flex-shrink: 0; }

.pub-tags { display: flex; flex-wrap: wrap; gap: .5rem; margin-bottom: 1.5rem; }
.pub-tag {
    display: inline-block; padding: .35rem .85rem;
    background: #f3f4f6; color: #374151; border-radius: 6px;
    font-size: .8rem; font-weight: 500; text-decoration: none; transition: all .2s;
}
.pub-tag:hover { background: #FAAF1C; color: #fff; }

.pub-actions { display: flex; flex-wrap: wrap; gap: .75rem; }
.pub-btn {
    display: inline-flex; align-items: center; gap: .5rem;
    padding: .7rem 1.5rem; border-radius: 10px; font-size: .88rem;
    font-weight: 600; text-decoration: none; transition: all .25s;
}
.pub-btn-primary { background: #022448; color: #fff; border: 2px solid #022448; }
.pub-btn-primary:hover { background: #0a3a6e; border-color: #0a3a6e; color: #fff; transform: translateY(-2px); box-shadow: 0 6px 20px rgba(2,36,72,.2); }
.pub-btn-outline { background: #fff; color: #374151; border: 2px solid #e5e7eb; }
.pub-btn-outline:hover { border-color: #FAAF1C; color: #FAAF1C; background: #fffdf5; transform: translateY(-2px); }

/* ── Content Section ── */
.pub-content-section {
    background: #fff; border-radius: 16px; padding: 2.5rem;
    box-shadow: 0 2px 12px rgba(0,0,0,.04); margin-top: 1.5rem;
}
.pub-content-body { color: #374151; font-size: .95rem; line-height: 1.8; }
.pub-content-body h1,.pub-content-body h2,.pub-content-body h3,.pub-content-body h4 { color: #1a1a2e; margin-top: 1.5rem; margin-bottom: .75rem; }
.pub-content-body img { max-width: 100%; border-radius: 8px; margin: 1rem 0; }
.pub-content-body a { color: #FAAF1C; }

/* ── Related Resources ── */
.pub-related-section { margin-top: 1.5rem; }
.pub-section-title {
    display: flex; align-items: center; gap: .75rem;
    font-size: 1.15rem; font-weight: 700; color: #1a1a2e; margin-bottom: 1.25rem;
}
.pub-section-title svg { color: #FAAF1C; }

.pub-resource-card {
    background: #fff; border-radius: 12px; overflow: hidden;
    box-shadow: 0 2px 10px rgba(0,0,0,.05); transition: all .3s;
    border: 1px solid #f0f0f0;
}
.pub-resource-card:hover { box-shadow: 0 6px 20px rgba(0,0,0,.1); transform: translateY(-2px); }
.pub-resource-img { width: 100%; height: 140px; object-fit: cover; }
.pub-resource-body { padding: 1rem 1.25rem; }
.pub-resource-title { font-size: .95rem; font-weight: 700; color: #1a1a2e; margin-bottom: .5rem; }
.pub-resource-desc { color: #6b7280; font-size: .82rem; line-height: 1.5; margin-bottom: .75rem; }
.pub-resource-dl {
    display: inline-flex; align-items: center; gap: .35rem;
    color: #FAAF1C; font-size: .82rem; font-weight: 600; text-decoration: none;
}
.pub-resource-dl:hover { color: #e89d0f; }

/* ── Cover Placeholder ── */
.pub-cover-placeholder {
    width: 100%; height: 100%; min-height: 320px;
    display: flex; align-items: center; justify-content: center;
    background: linear-gradient(135deg, #f0f2f5 0%, #e8ebf0 100%);
    color: #b0b7c3;
}

/* ── Work Badge ── */
.pub-work-badge {
    display: inline-block; padding: .2rem .65rem;
    border-radius: 16px; font-size: .78rem; font-weight: 600;
}
.pub-work-badge.our-work {
    background: #ecfdf5; color: #059669; border: 1px solid #a7f3d0;
}
.pub-work-badge.other-work {
    background: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe;
}

/* ── Video Section ── */
.pub-video-section {
    background: #fff; border-radius: 16px; padding: 2rem 2.5rem;
    box-shadow: 0 2px 12px rgba(0,0,0,.04); margin-top: 1.5rem;
}
.pub-video-wrapper {
    position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;
    border-radius: 12px; background: #000;
}
.pub-video-wrapper iframe {
    position: absolute; top: 0; left: 0;
    width: 100%; height: 100%; border: none;
}

/* ── Back Link ── */
.pub-back-wrap { margin-top: 2.5rem; padding-top: 1.5rem; border-top: 1px solid #e5e7eb; }
.pub-back-link {
    display: inline-flex; align-items: center; gap: .5rem;
    color: #6b7280; font-size: .9rem; font-weight: 600; text-decoration: none; transition: color .2s;
}
.pub-back-link:hover { color: #022448; }
.pub-back-link svg { transition: transform .2s; }
.pub-back-link:hover svg { transform: translateX(-4px); }

/* ── Responsive ── */
@media(max-width:992px){
    .pub-cover { min-height: 250px; }
    .pub-info { padding: 1.5rem; }
    .pub-title { font-size: 1.35rem; }
}
@media(max-width:768px){
    .pub-cover { min-height: 200px; }
    .pub-content-section { padding: 1.5rem; }
}
</style>
