<div class='rl-wrap'>
    <div class='row g-3 g-lg-4'>
        <div class='col-lg-9'>

            {{-- ═══ SEARCH BAR ═══ --}}
            <div class="rl-search-bar">
                <div class="rl-search-row">
                    <div class="rl-search-field">
                        <svg class="rl-search-ico" width="18" height="18" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8" />
                            <path d="M21 21l-4.35-4.35" />
                        </svg>
                        <input class="rl-search-input" wire:model.defer="search" wire:keydown.enter="filterUpdated()"
                            placeholder="Search publications, reports, and data..." type="text">
                        @if ($search)
                            <button type="button" class="rl-search-clear" wire:click="clearSearch()">
                                <svg width="14" height="14" viewBox="0 0 16 16" fill="none">
                                    <path d="M12 4L4 12M4 4L12 12" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" />
                                </svg>
                            </button>
                        @endif
                        <button type="button" class="rl-search-btn" wire:click="filterUpdated()">Search</button>
                    </div>
                </div>

                {{-- Type pills + active filter count --}}
                <div class="rl-toolbar">
                    @if (!$is_data_repo_page && count($repo_types) > 0)
                        <div class="rl-pills d-none d-lg-flex">
                            @foreach ($repo_types as $type)
                                <button wire:click="setType('{{ $type->id }}')"
                                    class="rl-pill {{ in_array($type->id, $repo_type_ids) ? 'active' : '' }}">
                                    {{ $type->name }}
                                </button>
                            @endforeach
                        </div>
                    @endif

                    <div class="rl-toolbar-right">
                        @php
                            $activeCount =
                                count($selectedAuthorsIds ?? []) +
                                count($selectedFields ?? []) +
                                count($selectedSubjects ?? []) +
                                count($selectedProjects ?? []) +
                                count($selectedPublishDates ?? []) +
                                count($selectedCountryIds ?? []);
                        @endphp
                        @if ($activeCount > 0)
                            <button class="rl-active-tag" wire:click="clear">
                                <span>{{ $activeCount }} filter{{ $activeCount > 1 ? 's' : '' }} active</span>
                                <svg width="14" height="14" viewBox="0 0 16 16" fill="none">
                                    <path d="M12 4L4 12M4 4L12 12" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" />
                                </svg>
                            </button>
                        @endif

                        {{-- Mobile filter toggle --}}
                        <button class="rl-filter-toggle d-lg-none"
                            onclick="document.querySelector('.rl-sidebar').classList.add('open')">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 3H2L10 12.46V19L14 21V12.46L22 3Z" />
                            </svg>
                            Filters
                            @if ($activeCount > 0)
                                <span class="rl-filter-badge">{{ $activeCount }}</span>
                            @endif
                        </button>
                    </div>
                </div>
            </div>

            {{-- ═══ RESULTS ═══ --}}
            <div id='repos' class="rl-results">

                @forelse($repos as $index => $r)
                    @php
                        $detailUrl = route('repo.single', $r->id);
                    @endphp
                    <article class='rl-card' style="animation-delay: {{ $index * 40 }}ms">
                        <div class='row g-0'>
                            <div class='col-md-3'>
                                <a href="{{ $detailUrl }}"
                                    class="rl-card-img-link">
                                    <div class="rl-card-img">
                                        @if($r->image && Storage::exists($r->image))
                                            <img src='{{ Storage::url($r->image) }}' alt="{{ $r->title }}"
                                                loading="lazy">
                                        @else
                                            <div class="rl-card-img-placeholder">
                                                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                                                    <polyline points="14 2 14 8 20 8"/>
                                                    <line x1="16" y1="13" x2="8" y2="13"/>
                                                    <line x1="16" y1="17" x2="8" y2="17"/>
                                                    <polyline points="10 9 9 9 8 9"/>
                                                </svg>
                                            </div>
                                        @endif
                                        <div class="rl-card-img-hover">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class='col-md-9'>
                                <div class="rl-card-body">
                                    <a href="{{ $detailUrl }}"
                                        class="rl-card-title">
                                        {{ $r->title }}
                                    </a>
                                    <p class="rl-card-desc">{{ $r->description }}</p>

                                    @if (count($r->tags) > 0)
                                        <div class="rl-card-tags">
                                            @foreach ($r->tags as $tag)
                                                <a class="rl-tag"
                                                    href="/search?tag={{ $tag->name }}">{{ $tag->name }}</a>
                                            @endforeach
                                        </div>
                                    @endif

                                    <div class="rl-card-actions">
                                        @if ($r->data_link)
                                            <a class="rl-dl" href="{{ $r->data_link }}" target="_blank">
                                                <svg width="15" height="15" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6" />
                                                    <polyline points="15 3 21 3 21 9" />
                                                    <line x1="10" y1="14" x2="21" y2="3" />
                                                </svg>
                                                Link
                                            </a>
                                        @endif
                                        @if ($r->ar_pdf)
                                            <a class="rl-dl" href="{{ Storage::url($r->ar_pdf) }}" target="_blank">
                                                <svg width="15" height="15" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4" />
                                                    <polyline points="7 10 12 15 17 10" />
                                                    <line x1="12" y1="15" x2="12"
                                                        y2="3" />
                                                </svg>
                                                Arabic
                                            </a>
                                        @endif
                                        @if ($r->en_pdf)
                                            <a class="rl-dl" href="{{ Storage::url($r->en_pdf) }}" target="_blank">
                                                <svg width="15" height="15" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4" />
                                                    <polyline points="7 10 12 15 17 10" />
                                                    <line x1="12" y1="15" x2="12"
                                                        y2="3" />
                                                </svg>
                                                English
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="rl-empty">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8" />
                            <path d="M21 21l-4.35-4.35" />
                            <path d="M8 8l6 6" />
                        </svg>
                        <p>No results found</p>
                        <span>Try adjusting your search or filters</span>
                    </div>
                @endforelse
            </div>

            {{-- Load More --}}
            @if ($hasMorePages)
                <div class="rl-loadmore">
                    <button type="button" class="rl-loadmore-btn" wire:click="loadMore"
                        wire:loading.attr="disabled" wire:loading.class="loading">
                        <span class="rl-lm-text">Load More</span>
                        <span class="rl-lm-spin">
                            <span class="spinner-border spinner-border-sm"></span>
                            Loading…
                        </span>
                    </button>
                </div>
            @elseif($repos->count() > 0)
                <div class="rl-end">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 6L9 17l-5-5" />
                    </svg>
                    You've reached the end
                </div>
            @endif
        </div>

        {{-- ═══ SIDEBAR — DYNAMIC FILTERS ═══ --}}
        <div class='col-lg-3'>
            <div class="rl-sidebar">
                {{-- Mobile close --}}
                <button class="rl-sidebar-close d-lg-none"
                    onclick="document.querySelector('.rl-sidebar').classList.remove('open')">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6L6 18" />
                        <path d="M6 6l12 12" />
                    </svg>
                </button>

                <div class="rl-sidebar-head">
                    <span class="rl-sidebar-title">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 3H2L10 12.46V19L14 21V12.46L22 3Z" />
                        </svg>
                        Filters
                    </span>
                    @if ($activeCount > 0)
                        <button class="rl-sidebar-clear" wire:click="clear">Clear all</button>
                    @endif
                </div>

                <div class="rl-sidebar-body">

                    {{-- Each filter group is collapsible via pure CSS --}}

                    @if (count($authors) > 0)
                        <details class="rl-fg" open>
                            <summary class="rl-fg-title">Author</summary>
                            <div class="rl-fg-opts">
                                @foreach ($authors as $author)
                                    <label class="rl-check">
                                        <input type="checkbox" wire:model.live="selectedAuthorsIds"
                                            wire:change="filterUpdated()" value='{{ $author->id }}'>
                                        <span class="rl-check-box"></span>
                                        <span class="rl-check-label">{{ $author->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </details>
                    @endif

                    @if (count($fields) > 0)
                        <details class="rl-fg" open>
                            <summary class="rl-fg-title">Field</summary>
                            <div class="rl-fg-opts">
                                @foreach ($fields as $field)
                                    <label class="rl-check">
                                        <input type="checkbox" wire:model.live="selectedFields"
                                            wire:change="filterUpdated()" value='{{ $field }}'>
                                        <span class="rl-check-box"></span>
                                        <span class="rl-check-label">{{ $field }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </details>
                    @endif

                    @if (count($subjects) > 0)
                        <details class="rl-fg">
                            <summary class="rl-fg-title">Subject</summary>
                            <div class="rl-fg-opts">
                                @foreach ($subjects as $subject)
                                    <label class="rl-check">
                                        <input type="checkbox" wire:model.live="selectedSubjects"
                                            wire:change="filterUpdated()" value='{{ $subject }}'>
                                        <span class="rl-check-box"></span>
                                        <span class="rl-check-label">{{ $subject }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </details>
                    @endif

                    @if (count($projects) > 0)
                        <details class="rl-fg">
                            <summary class="rl-fg-title">Project</summary>
                            <div class="rl-fg-opts">
                                @foreach ($projects as $project)
                                    <label class="rl-check">
                                        <input type="checkbox" wire:model.live="selectedProjects"
                                            wire:change="filterUpdated()" value='{{ $project }}'>
                                        <span class="rl-check-box"></span>
                                        <span class="rl-check-label">{{ $project }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </details>
                    @endif

                    @if (count($publish_dates) > 0)
                        <details class="rl-fg" open>
                            <summary class="rl-fg-title">Year</summary>
                            <div class="rl-fg-opts">
                                @foreach ($publish_dates as $publish_date)
                                    <label class="rl-check">
                                        <input type="checkbox" wire:model.live="selectedPublishDates"
                                            wire:change="filterUpdated()" value='{{ $publish_date }}'>
                                        <span class="rl-check-box"></span>
                                        <span class="rl-check-label">{{ $publish_date }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </details>
                    @endif

                    @if (!$is_data_repo_page && count($repo_types) > 0)
                        <details class="rl-fg">
                            <summary class="rl-fg-title">Type</summary>
                            <div class="rl-fg-opts">
                                @foreach ($repo_types as $type)
                                    <label class="rl-check">
                                        <input type="checkbox" wire:model.live="repo_type_ids"
                                            wire:change="filterUpdated()" value='{{ $type->id }}'>
                                        <span class="rl-check-box"></span>
                                        <span class="rl-check-label">{{ $type->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </details>
                    @endif

                    @if (count($allCountries) > 0)
                        <details class="rl-fg">
                            <summary class="rl-fg-title">Country</summary>
                            <div class="rl-fg-opts">
                                @foreach ($allCountries as $country)
                                    <label class="rl-check">
                                        <input type="checkbox" wire:model.live="selectedCountryIds"
                                            wire:change="filterUpdated()" value='{{ $country->id }}'>
                                        <span class="rl-check-box"></span>
                                        <span class="rl-check-label">{{ $country->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </details>
                    @endif

                </div>
            </div>
            {{-- Mobile overlay --}}
            <div class="rl-sidebar-overlay d-lg-none"
                onclick="document.querySelector('.rl-sidebar').classList.remove('open')"></div>
        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Geist:wght@400;500;600;700;800&display=swap');

    /* ══════ TOKENS ══════ */
    .rl-wrap {
        --rl-navy: #022448;
        --rl-gold: #FAAF1C;
        --rl-gold-dk: #d4940a;
        --rl-text: #111827;
        --rl-muted: #6b7280;
        --rl-light: #f5f6f8;
        --rl-border: #eef0f3;
        --rl-surface: #ffffff;
        --rl-radius: 10px;
        --rl-serif: 'Instrument Serif', Georgia, serif;
        --rl-sans: 'Geist', -apple-system, BlinkMacSystemFont, sans-serif;
        font-family: var(--rl-sans);
        padding-bottom: 2rem;
    }

    /* ══════ SEARCH BAR ══════ */
    .rl-search-bar {
        background: var(--rl-surface);
        border: 1px solid var(--rl-border);
        border-radius: var(--rl-radius);
        padding: 1rem 1.15rem;
        margin-bottom: 1rem;
    }

    .rl-search-field {
        display: flex;
        align-items: center;
        background: var(--rl-light);
        border: 1.5px solid var(--rl-border);
        border-radius: 8px;
        padding: .25rem .35rem;
        transition: border-color .2s, box-shadow .2s;
    }

    .rl-search-field:focus-within {
        border-color: var(--rl-gold);
        box-shadow: 0 0 0 3px rgba(250, 175, 28, .08);
        background: #fff;
    }

    .rl-search-ico {
        color: #b0b7c3;
        margin: 0 .55rem;
        flex-shrink: 0;
    }

    .rl-search-input {
        flex: 1;
        border: none;
        background: transparent;
        padding: .45rem .3rem;
        font-size: .88rem;
        color: var(--rl-text);
        outline: none;
        font-family: var(--rl-sans);
    }

    .rl-search-input::placeholder {
        color: #b0b7c3;
    }

    .rl-search-clear {
        background: none;
        border: none;
        color: #9ca3af;
        padding: .3rem;
        cursor: pointer;
        border-radius: 4px;
        display: flex;
        align-items: center;
        transition: all .2s;
    }

    .rl-search-clear:hover {
        background: #fef2f2;
        color: #ef4444;
    }

    .rl-search-btn {
        background: var(--rl-gold);
        color: #fff;
        border: none;
        padding: .5rem 1.15rem;
        border-radius: 6px;
        font-weight: 700;
        font-size: .8rem;
        cursor: pointer;
        transition: all .2s;
        margin-inline-start: .3rem;
        font-family: var(--rl-sans);
        letter-spacing: .01em;
    }

    .rl-search-btn:hover {
        background: var(--rl-gold-dk);
    }

    /* ── Toolbar (pills + active tag) ── */
    .rl-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: .75rem;
        margin-top: .75rem;
        flex-wrap: wrap;
    }

    .rl-toolbar-right {
        display: flex;
        align-items: center;
        gap: .5rem;
        margin-inline-start: auto;
    }

    .rl-pills {
        display: flex;
        gap: .4rem;
        flex-wrap: wrap;
    }

    .rl-pill {
        padding: .35rem .85rem;
        border-radius: 20px;
        border: 1.5px solid var(--rl-border);
        background: #fff;
        color: #4b5563;
        font-weight: 600;
        font-size: .76rem;
        cursor: pointer;
        transition: all .2s;
        font-family: var(--rl-sans);
    }

    .rl-pill:hover {
        border-color: var(--rl-gold);
        color: var(--rl-gold);
    }

    .rl-pill.active {
        background: var(--rl-gold);
        border-color: var(--rl-gold);
        color: #fff;
        box-shadow: 0 2px 8px rgba(250, 175, 28, .25);
    }

    .rl-active-tag {
        display: inline-flex;
        align-items: center;
        gap: .35rem;
        padding: .3rem .65rem;
        background: #fef9ee;
        border: 1px solid #fde68a;
        border-radius: 20px;
        font-size: .74rem;
        font-weight: 600;
        color: #92400e;
        cursor: pointer;
        transition: all .2s;
        font-family: var(--rl-sans);
    }

    .rl-active-tag:hover {
        background: #fef2f2;
        border-color: #fca5a5;
        color: #dc2626;
    }

    .rl-active-tag svg {
        opacity: .6;
    }

    .rl-filter-toggle {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        padding: .4rem .85rem;
        background: #fff;
        border: 1.5px solid var(--rl-border);
        border-radius: 8px;
        font-weight: 600;
        font-size: .8rem;
        color: var(--rl-text);
        cursor: pointer;
        transition: all .2s;
        font-family: var(--rl-sans);
    }

    .rl-filter-toggle:hover {
        border-color: var(--rl-gold);
        color: var(--rl-gold);
    }

    .rl-filter-badge {
        background: var(--rl-gold);
        color: #fff;
        font-size: .65rem;
        font-weight: 700;
        padding: .1rem .4rem;
        border-radius: 10px;
        min-width: 18px;
        text-align: center;
    }

    /* ══════ RESULT CARDS ══════ */
    .rl-results {
        margin-bottom: 1rem;
    }

    .rl-card {
        background: var(--rl-surface);
        border: 1px solid var(--rl-border);
        border-radius: var(--rl-radius);
        overflow: hidden;
        margin-bottom: .75rem;
        transition: all .3s cubic-bezier(.22, .61, .36, 1);
        position: relative;
        animation: rl-fadeIn .4s ease both;
    }

    @keyframes rl-fadeIn {
        from {
            opacity: 0;
            transform: translateY(8px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .rl-card::after {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 3px;
        background: transparent;
        transition: background .25s;
    }

    .rl-card:hover {
        box-shadow: 0 6px 24px rgba(2, 36, 72, .06);
        transform: translateY(-2px);
        border-color: #e0e2e6;
    }

    .rl-card:hover::after {
        background: var(--rl-gold);
    }

    /* Card image */
    .rl-card-img-link {
        display: block;
        text-decoration: none;
        height: 100%;
    }

    .rl-card-img {
        position: relative;
        width: 100%;
        height: 100%;
        min-height: 140px;
        overflow: hidden;
        background: var(--rl-light);
    }

    .rl-card-img-placeholder {
        width: 100%;
        height: 100%;
        min-height: 140px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f0f2f5 0%, #e8ebf0 100%);
        color: #b0b7c3;
    }

    .rl-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .4s cubic-bezier(.22, .61, .36, 1);
    }

    .rl-card-img-hover {
        position: absolute;
        inset: 0;
        background: rgba(2, 36, 72, .5);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity .25s;
        color: #fff;
    }

    .rl-card-img:hover .rl-card-img-hover {
        opacity: 1;
    }

    .rl-card-img:hover img {
        transform: scale(1.05);
    }

    /* Card body */
    .rl-card-body {
        padding: 1.1rem 1.25rem;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .rl-card-title {
        font-family: var(--rl-sans);
        font-size: 1rem;
        font-weight: 700;
        color: var(--rl-text);
        text-decoration: none;
        line-height: 1.4;
        margin-bottom: .4rem;
        transition: color .2s;
        display: block;
    }

    .rl-card-title:hover {
        color: var(--rl-gold);
        text-decoration: none;
    }

    .rl-card-desc {
        font-size: .82rem;
        color: var(--rl-muted);
        line-height: 1.6;
        margin: 0 0 .6rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        flex: 1;
    }

    .rl-card-tags {
        display: flex;
        flex-wrap: wrap;
        gap: .3rem;
        margin-bottom: .6rem;
    }

    .rl-tag {
        padding: .2rem .55rem;
        background: var(--rl-light);
        border: 1px solid var(--rl-border);
        border-radius: 16px;
        font-size: .7rem;
        font-weight: 600;
        color: #4b5563;
        text-decoration: none;
        transition: all .2s;
    }

    .rl-tag:hover {
        background: var(--rl-navy);
        border-color: var(--rl-navy);
        color: #fff;
        text-decoration: none;
    }

    .rl-card-actions {
        display: flex;
        gap: .4rem;
        flex-wrap: wrap;
        margin-top: auto;
    }

    .rl-dl {
        display: inline-flex;
        align-items: center;
        gap: .3rem;
        padding: .35rem .7rem;
        background: var(--rl-light);
        border: 1px solid var(--rl-border);
        border-radius: 6px;
        color: #374151;
        font-weight: 600;
        font-size: .76rem;
        text-decoration: none;
        transition: all .2s;
    }

    .rl-dl:hover {
        border-color: var(--rl-gold);
        color: var(--rl-gold-dk);
        background: #fffdf5;
        text-decoration: none;
    }

    /* ── Empty state ── */
    .rl-empty {
        text-align: center;
        padding: 3rem 1rem;
        color: var(--rl-muted);
    }

    .rl-empty svg {
        color: #d1d5db;
        margin-bottom: .75rem;
    }

    .rl-empty p {
        font-weight: 600;
        font-size: 1rem;
        color: var(--rl-text);
        margin: 0 0 .25rem;
    }

    .rl-empty span {
        font-size: .85rem;
    }

    /* ── Load more ── */
    .rl-loadmore {
        display: flex;
        justify-content: center;
        padding: 1.25rem 0;
    }

    .rl-loadmore-btn {
        padding: .6rem 2rem;
        background: #fff;
        border: 1.5px solid var(--rl-navy);
        color: var(--rl-navy);
        border-radius: 8px;
        font-weight: 700;
        font-size: .85rem;
        cursor: pointer;
        transition: all .25s;
        font-family: var(--rl-sans);
    }

    .rl-loadmore-btn .rl-lm-text {
        display: inline;
    }

    .rl-loadmore-btn .rl-lm-spin {
        display: none;
        align-items: center;
        gap: .4rem;
    }

    .rl-loadmore-btn.loading .rl-lm-text {
        display: none;
    }

    .rl-loadmore-btn.loading .rl-lm-spin {
        display: inline-flex;
    }

    .rl-loadmore-btn:hover:not(:disabled):not(.loading) {
        background: var(--rl-navy);
        color: #fff;
    }

    .rl-loadmore-btn:disabled {
        opacity: .5;
        cursor: not-allowed;
    }

    .rl-end {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: .5rem;
        padding: 1.25rem;
        color: #9ca3af;
        font-size: .82rem;
        font-weight: 500;
    }

    .rl-end svg {
        color: #10b981;
    }

    /* ══════ SIDEBAR ══════ */
    .rl-sidebar {
        background: var(--rl-surface);
        border: 1px solid var(--rl-border);
        border-radius: var(--rl-radius);
        position: sticky;
        top: 1rem;
        max-height: calc(100vh - 2rem);
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    .rl-sidebar-close {
        position: absolute;
        top: .75rem;
        right: .75rem;
        z-index: 2;
        background: var(--rl-light);
        border: none;
        border-radius: 6px;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: var(--rl-muted);
        transition: all .2s;
    }

    .rl-sidebar-close:hover {
        background: #fef2f2;
        color: #ef4444;
    }

    .rl-sidebar-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: .85rem 1.1rem;
        border-bottom: 1px solid var(--rl-border);
        background: #fafbfc;
    }

    .rl-sidebar-title {
        display: flex;
        align-items: center;
        gap: .45rem;
        font-size: .85rem;
        font-weight: 700;
        color: var(--rl-text);
    }

    .rl-sidebar-title svg {
        color: var(--rl-gold);
    }

    .rl-sidebar-clear {
        background: none;
        border: none;
        font-size: .74rem;
        font-weight: 600;
        color: #ef4444;
        cursor: pointer;
        padding: .2rem .4rem;
        border-radius: 4px;
        transition: all .2s;
        font-family: var(--rl-sans);
    }

    .rl-sidebar-clear:hover {
        background: #fef2f2;
    }

    .rl-sidebar-body {
        flex: 1;
        overflow-y: auto;
        padding: .75rem 1.1rem;
    }

    /* Thin scrollbar */
    .rl-sidebar-body::-webkit-scrollbar {
        width: 4px;
    }

    .rl-sidebar-body::-webkit-scrollbar-track {
        background: transparent;
    }

    .rl-sidebar-body::-webkit-scrollbar-thumb {
        background: #e5e7eb;
        border-radius: 4px;
    }

    /* ── Filter group (collapsible) ── */
    .rl-fg {
        border-bottom: 1px solid #f3f4f6;
        padding-bottom: .65rem;
        margin-bottom: .65rem;
    }

    .rl-fg:last-child {
        border-bottom: none;
        margin-bottom: 0;
    }

    .rl-fg-title {
        font-size: .7rem;
        font-weight: 800;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: .08em;
        cursor: pointer;
        list-style: none;
        padding: .35rem 0;
        display: flex;
        align-items: center;
        user-select: none;
        transition: color .2s;
    }

    .rl-fg-title:hover {
        color: var(--rl-text);
    }

    .rl-fg-title::after {
        content: '';
        margin-inline-start: auto;
        width: 0;
        height: 0;
        border-left: 4px solid transparent;
        border-right: 4px solid transparent;
        border-top: 5px solid #d1d5db;
        transition: transform .2s;
    }

    .rl-fg[open]>.rl-fg-title::after {
        transform: rotate(180deg);
    }

    .rl-fg-title::-webkit-details-marker {
        display: none;
    }

    .rl-fg-opts {
        display: flex;
        flex-direction: column;
        gap: .35rem;
        padding-top: .4rem;
        max-height: 180px;
        overflow-y: auto;
    }

    .rl-fg-opts::-webkit-scrollbar {
        width: 3px;
    }

    .rl-fg-opts::-webkit-scrollbar-thumb {
        background: #e5e7eb;
        border-radius: 3px;
    }

    /* ── Checkbox ── */
    .rl-check {
        display: flex;
        align-items: center;
        gap: .5rem;
        cursor: pointer;
        position: relative;
        user-select: none;
        padding: .2rem 0;
    }

    .rl-check input {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }

    .rl-check-box {
        width: 16px;
        height: 16px;
        flex-shrink: 0;
        border: 1.5px solid #d1d5db;
        border-radius: 3px;
        background: #fff;
        transition: all .15s;
        position: relative;
    }

    .rl-check:hover .rl-check-box {
        border-color: var(--rl-gold);
    }

    .rl-check input:checked~.rl-check-box {
        background: var(--rl-gold);
        border-color: var(--rl-gold);
    }

    .rl-check input:checked~.rl-check-box::after {
        content: '';
        position: absolute;
        left: 4.5px;
        top: 1.5px;
        width: 4px;
        height: 7px;
        border: solid #fff;
        border-width: 0 1.5px 1.5px 0;
        transform: rotate(45deg);
    }

    .rl-check-label {
        font-size: .8rem;
        color: #4b5563;
        line-height: 1.3;
        transition: color .15s;
    }

    .rl-check:hover .rl-check-label {
        color: var(--rl-text);
    }

    /* ══════ MOBILE SIDEBAR ══════ */
    @media (max-width: 991px) {
        .rl-sidebar {
            position: fixed;
            top: 0;
            right: 0;
            width: 300px;
            max-width: 85vw;
            height: 100vh;
            max-height: 100vh;
            z-index: 9999;
            border-radius: 0;
            border: none;
            box-shadow: -4px 0 24px rgba(0, 0, 0, .12);
            transform: translateX(100%);
            transition: transform .3s cubic-bezier(.22, .61, .36, 1);
        }

        .rl-sidebar.open {
            transform: translateX(0);
        }

        .rl-sidebar-overlay {
            position: fixed;
            inset: 0;
            z-index: 9998;
            background: rgba(0, 0, 0, .4);
            opacity: 0;
            visibility: hidden;
            transition: opacity .3s;
        }

        .rl-sidebar.open~.rl-sidebar-overlay {
            opacity: 1;
            visibility: visible;
        }
    }

    /* ══════ SMALL SCREENS ══════ */
    @media (max-width: 767px) {
        .rl-search-bar {
            padding: .75rem;
        }

        .rl-card-body {
            padding: .85rem 1rem;
        }

        .rl-card-title {
            font-size: .92rem;
        }

        .rl-card-img {
            min-height: 120px;
        }

        .rl-dl {
            font-size: .72rem;
            padding: .3rem .55rem;
        }
    }
</style>
