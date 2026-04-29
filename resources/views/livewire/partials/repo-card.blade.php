@php $detailUrl = route('repo.single', $r->id); @endphp

<li class="kh-card">
    <a href="{{ $detailUrl }}" class="kh-card-img-link">
        <div class="kh-card-img">
            @if ($r->image && Storage::exists($r->image))
                <img src="{{ Storage::url($r->image) }}" alt="{{ $r->title }}" loading="lazy">
            @else
                <div class="kh-card-img-placeholder">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="16" y1="13" x2="8" y2="13"/>
                        <line x1="16" y1="17" x2="8" y2="17"/>
                        <polyline points="10 9 9 9 8 9"/>
                    </svg>
                </div>
            @endif
        </div>
    </a>

    <div class="kh-card-body">
        <a href="{{ $detailUrl }}" class="kh-card-title">
            {{ $r->title }}@if ($r->publish_date)<span class="kh-card-date"> &mdash; {{ \Carbon\Carbon::parse($r->publish_date)->format('Y') }}</span>@endif
        </a>

        @if ($r->description)
            <p class="kh-card-desc">{{ $r->description }}</p>
        @endif

        @if ($r->is_research || $r->is_talk_webinar || $r->is_educational)
            <div class="kh-card-formats">
                @if ($r->is_research)
                    <span class="kh-format-badge kh-format-badge--research">@lang('translation.research')</span>
                @endif
                @if ($r->is_talk_webinar)
                    <span class="kh-format-badge kh-format-badge--talk">@lang('translation.talks-webinars')</span>
                @endif
                @if ($r->is_educational)
                    <span class="kh-format-badge kh-format-badge--edu">@lang('translation.educational-resources')</span>
                @endif
            </div>
        @endif

        <div class="kh-card-actions">
            @if ($r->data_link)
                <a class="kh-card-cta" href="{{ $r->data_link }}" target="_blank" rel="noopener">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/>
                        <polyline points="15 3 21 3 21 9"/>
                        <line x1="10" y1="14" x2="21" y2="3"/>
                    </svg>
                    Link
                </a>
            @endif
            @if ($r->en_pdf)
                <a class="kh-card-cta" href="{{ Storage::url($r->en_pdf) }}" target="_blank" rel="noopener">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/>
                        <polyline points="7 10 12 15 17 10"/>
                        <line x1="12" y1="15" x2="12" y2="3"/>
                    </svg>
                    English
                </a>
            @endif
            @if ($r->ar_pdf)
                <a class="kh-card-cta" href="{{ Storage::url($r->ar_pdf) }}" target="_blank" rel="noopener">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/>
                        <polyline points="7 10 12 15 17 10"/>
                        <line x1="12" y1="15" x2="12" y2="3"/>
                    </svg>
                    Arabic
                </a>
            @endif
            @if (!$r->data_link && !$r->en_pdf && !$r->ar_pdf)
                <a class="kh-card-cta" href="{{ $detailUrl }}">View details &rarr;</a>
            @endif
        </div>
    </div>
</li>
