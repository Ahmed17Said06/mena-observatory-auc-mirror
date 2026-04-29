<div class="rl-wrap">

    {{-- ════════════ SEARCH & FILTERS ════════════ --}}
    <div class="kh-filter-bar">
        <div class="kh-search-wrap">
            <svg class="kh-search-icon" width="16" height="16" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
            </svg>
            <input wire:model.debounce.400ms="search"
                   type="search"
                   class="kh-search-input"
                   placeholder="Search resources…">
        </div>

        <div class="kh-filters-row">
            @if ($availableTags->isNotEmpty())
                <select wire:model="selectedTag" class="kh-filter-select">
                    <option value="">All Tags</option>
                    @foreach ($availableTags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            @endif

            @if ($availableYears->isNotEmpty())
                <select wire:model="selectedYear" class="kh-filter-select">
                    <option value="">All Years</option>
                    @foreach ($availableYears as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            @endif

            @if ($availableTypes->isNotEmpty())
                <select wire:model="selectedType" class="kh-filter-select">
                    <option value="">All Types</option>
                    @foreach ($availableTypes as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            @endif

            @if ($hasActiveFilters)
                <button wire:click="clearFilters" class="kh-filter-clear">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2.5" stroke-linecap="round">
                        <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                    Clear filters
                </button>
            @endif
        </div>

        @if ($hasActiveFilters)
            <div class="kh-active-chips">
                @if ($search)
                    <span class="kh-chip">
                        "{{ $search }}"
                        <button wire:click="$set('search', '')" class="kh-chip-x">×</button>
                    </span>
                @endif
                @if ($selectedTag)
                    <span class="kh-chip">
                        {{ $availableTags->firstWhere('id', $selectedTag)?->name }}
                        <button wire:click="$set('selectedTag', '')" class="kh-chip-x">×</button>
                    </span>
                @endif
                @if ($selectedYear)
                    <span class="kh-chip">
                        {{ $selectedYear }}
                        <button wire:click="$set('selectedYear', '')" class="kh-chip-x">×</button>
                    </span>
                @endif
                @if ($selectedType)
                    <span class="kh-chip">
                        {{ $availableTypes->firstWhere('id', $selectedType)?->name }}
                        <button wire:click="$set('selectedType', '')" class="kh-chip-x">×</button>
                    </span>
                @endif
            </div>
        @endif
    </div>

    @php
        $hasObservatory = $showObservatory && ($observatoryResearch->total() > 0 || $observatoryTalks->total() > 0 || $observatoryEducational->total() > 0);
        $hasRegional    = $showRegional && $regionalRepos->total() > 0;
        $hasGlobal      = $showGlobal   && $globalRepos->total() > 0;
    @endphp

    {{-- ════════════ 1. OBSERVATORY OUTPUTS ════════════ --}}
    @if ($hasObservatory)
        <section class="kh-sec kh-sec--observatory">
            <header class="kh-sec-head">
                <span class="kh-sec-num">1</span>
                <div class="kh-sec-head-text">
                    <h2 class="kh-sec-title">Observatory Outputs</h2>
                    <p class="kh-sec-sub">Research, webinars and educational resources produced by the Observatory team.</p>
                </div>
            </header>

            @php
                $obsGroups = [
                    ['letter' => 'a', 'key' => 'research',    'title' => __('translation.research'),              'repos' => $observatoryResearch],
                    ['letter' => 'b', 'key' => 'talks',       'title' => __('translation.talks-webinars'),        'repos' => $observatoryTalks],
                    ['letter' => 'c', 'key' => 'educational', 'title' => __('translation.educational-resources'), 'repos' => $observatoryEducational],
                ];
            @endphp

            <div class="kh-subsections">
                @foreach ($obsGroups as $group)
                    @if ($group['repos']->total() > 0)
                        <div class="kh-subsec kh-subsec--{{ $group['key'] }}">
                            <header class="kh-subsec-head">
                                <span class="kh-subsec-letter">{{ $group['letter'] }}</span>
                                <h3 class="kh-subsec-title">{{ $group['title'] }}</h3>
                                <span class="kh-subsec-count">{{ $group['repos']->total() }}</span>
                            </header>

                            <ul class="kh-cards">
                                @foreach ($group['repos'] as $r)
                                    @include('livewire.partials.repo-card', ['r' => $r])
                                @endforeach
                            </ul>

                            @if ($group['repos']->hasPages())
                                <div class="kh-pagination">
                                    {{ $group['repos']->links() }}
                                </div>
                            @endif
                        </div>
                    @endif
                @endforeach
            </div>
        </section>
    @endif

    {{-- ════════════ 2. REGIONAL RESOURCES ════════════ --}}
    @if ($hasRegional)
        <section class="kh-sec kh-sec--regional">
            <header class="kh-sec-head">
                <span class="kh-sec-num">2</span>
                <div class="kh-sec-head-text">
                    <h2 class="kh-sec-title">Regional Resources</h2>
                    <p class="kh-sec-sub">External research and resources from the MENA region.</p>
                </div>
                <span class="kh-sec-count">{{ $regionalRepos->total() }} {{ Str::plural('item', $regionalRepos->total()) }}</span>
            </header>

            <ul class="kh-cards kh-cards--flat">
                @foreach ($regionalRepos as $r)
                    @include('livewire.partials.repo-card', ['r' => $r])
                @endforeach
            </ul>

            @if ($regionalRepos->hasPages())
                <div class="kh-pagination">
                    {{ $regionalRepos->links() }}
                </div>
            @endif
        </section>
    @endif

    {{-- ════════════ 3. GLOBAL RESOURCES ════════════ --}}
    @if ($hasGlobal)
        <section class="kh-sec kh-sec--global">
            <header class="kh-sec-head">
                <span class="kh-sec-num">3</span>
                <div class="kh-sec-head-text">
                    <h2 class="kh-sec-title">Global Resources</h2>
                    <p class="kh-sec-sub">International research and resources on responsible AI.</p>
                </div>
                <span class="kh-sec-count">{{ $globalRepos->total() }} {{ Str::plural('item', $globalRepos->total()) }}</span>
            </header>

            <ul class="kh-cards kh-cards--flat">
                @foreach ($globalRepos as $r)
                    @include('livewire.partials.repo-card', ['r' => $r])
                @endforeach
            </ul>

            @if ($globalRepos->hasPages())
                <div class="kh-pagination">
                    {{ $globalRepos->links() }}
                </div>
            @endif
        </section>
    @endif

    @if (!$hasObservatory && !$hasRegional && !$hasGlobal)
        <div class="kh-empty">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"/>
                <path d="M21 21l-4.35-4.35"/>
            </svg>
            <p>No resources to display yet.</p>
        </div>
    @endif
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Geist:wght@400;500;600;700;800&display=swap');

    .rl-wrap {
        --kh-navy: #022448;
        --kh-navy-mid: #0a3a6e;
        --kh-gold: #FAAF1C;
        --kh-gold-dk: #d4940a;
        --kh-text: #111827;
        --kh-muted: #6b7280;
        --kh-light: #f5f6f8;
        --kh-border: #eef0f3;
        --kh-surface: #ffffff;
        font-family: 'Geist', -apple-system, BlinkMacSystemFont, sans-serif;
        padding-bottom: 3rem;
    }

    /* ═══ Filter bar ═══ */
    .kh-filter-bar {
        background: #fff;
        border: 1px solid var(--kh-border);
        border-radius: 12px;
        padding: 1rem 1.25rem;
        margin-bottom: 1.75rem;
        box-shadow: 0 2px 12px rgba(0,0,0,.04);
        display: flex;
        flex-direction: column;
        gap: .75rem;
    }

    .kh-search-wrap {
        position: relative;
        flex: 1;
    }

    .kh-search-icon {
        position: absolute;
        inset-inline-start: .85rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--kh-muted);
        pointer-events: none;
    }

    .kh-search-input {
        width: 100%;
        padding: .55rem .85rem .55rem 2.4rem;
        border: 1px solid var(--kh-border);
        border-radius: 8px;
        font-size: .875rem;
        font-family: inherit;
        color: var(--kh-text);
        background: var(--kh-light);
        outline: none;
        transition: border-color .2s, box-shadow .2s;
    }

    .kh-search-input:focus {
        border-color: var(--kh-gold);
        box-shadow: 0 0 0 3px rgba(250,175,28,.12);
        background: #fff;
    }

    .kh-search-input::placeholder { color: #9ca3af; }

    .kh-filters-row {
        display: flex;
        flex-wrap: wrap;
        gap: .5rem;
        align-items: center;
    }

    .kh-filter-select {
        padding: .45rem .85rem;
        border: 1px solid var(--kh-border);
        border-radius: 8px;
        font-size: .8rem;
        font-family: inherit;
        font-weight: 600;
        color: var(--kh-navy);
        background: var(--kh-light);
        outline: none;
        cursor: pointer;
        transition: border-color .2s;
        min-width: 110px;
    }

    .kh-filter-select:focus { border-color: var(--kh-gold); }

    .kh-filter-clear {
        display: inline-flex;
        align-items: center;
        gap: .35rem;
        padding: .45rem .8rem;
        border-radius: 8px;
        border: 1px solid #fde68a;
        background: #fef9ee;
        color: var(--kh-gold-dk);
        font-size: .78rem;
        font-weight: 700;
        font-family: inherit;
        cursor: pointer;
        transition: all .2s;
        margin-inline-start: auto;
    }

    .kh-filter-clear:hover {
        background: var(--kh-gold);
        border-color: var(--kh-gold);
        color: #fff;
    }

    .kh-active-chips {
        display: flex;
        flex-wrap: wrap;
        gap: .4rem;
    }

    .kh-chip {
        display: inline-flex;
        align-items: center;
        gap: .35rem;
        padding: .25rem .6rem;
        border-radius: 20px;
        background: var(--kh-navy);
        color: #fff;
        font-size: .72rem;
        font-weight: 600;
    }

    .kh-chip-x {
        background: none;
        border: none;
        color: rgba(255,255,255,.7);
        cursor: pointer;
        font-size: .9rem;
        line-height: 1;
        padding: 0;
        transition: color .15s;
    }

    .kh-chip-x:hover { color: #fff; }

    /* ═══ Top-level section ═══ */
    .kh-sec {
        margin-bottom: 3rem;
    }

    .kh-sec-head {
        display: flex;
        align-items: center;
        gap: 1rem;
        background: #fff;
        border: 1px solid var(--kh-border);
        border-radius: 12px;
        padding: 1rem 1.25rem;
        margin-bottom: 1.25rem;
        box-shadow: 0 2px 12px rgba(0, 0, 0, .04);
    }

    .kh-sec-num {
        flex: 0 0 44px;
        height: 44px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 1.1rem;
        color: #fff;
    }

    .kh-sec--observatory .kh-sec-num { background: linear-gradient(135deg, var(--kh-gold) 0%, var(--kh-gold-dk) 100%); }
    .kh-sec--regional    .kh-sec-num { background: linear-gradient(135deg, #4caf8a 0%, #006644 100%); }
    .kh-sec--global      .kh-sec-num { background: linear-gradient(135deg, var(--kh-navy-mid) 0%, var(--kh-navy) 100%); }

    .kh-sec-head-text {
        flex: 1;
        min-width: 0;
    }

    .kh-sec-title {
        font-size: 1.3rem;
        font-weight: 800;
        color: var(--kh-navy);
        margin: 0 0 .15rem;
        letter-spacing: -.01em;
        line-height: 1.2;
    }

    .kh-sec-sub {
        font-size: .85rem;
        color: var(--kh-muted);
        margin: 0;
    }

    .kh-sec-count {
        flex-shrink: 0;
        padding: .35rem .8rem;
        border-radius: 20px;
        background: var(--kh-light);
        border: 1px solid var(--kh-border);
        font-size: .74rem;
        font-weight: 700;
        color: var(--kh-muted);
        white-space: nowrap;
    }

    /* ═══ Nested sub-sections under Observatory ═══ */
    .kh-subsections {
        display: flex;
        flex-direction: column;
        gap: 1.75rem;
        padding-inline-start: 1.5rem;
        border-inline-start: 2px dashed var(--kh-border);
        margin-inline-start: 1.4rem;
    }

    .kh-subsec {
        position: relative;
    }

    .kh-subsec::before {
        content: "";
        position: absolute;
        inset-inline-start: -1.5rem;
        top: 1.1rem;
        width: 1.4rem;
        height: 2px;
        background: var(--kh-border);
    }

    .kh-subsec-head {
        display: flex;
        align-items: center;
        gap: .65rem;
        margin-bottom: .9rem;
        padding-bottom: .6rem;
        border-bottom: 2px solid var(--kh-light);
    }

    .kh-subsec-letter {
        flex: 0 0 26px;
        height: 26px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #fef9ee;
        color: var(--kh-gold-dk);
        font-weight: 800;
        font-size: .8rem;
        line-height: 1;
        text-transform: lowercase;
    }

    .kh-subsec-title {
        font-size: .95rem;
        font-weight: 700;
        color: var(--kh-navy);
        margin: 0;
        text-transform: uppercase;
        letter-spacing: .05em;
        flex: 1;
    }

    .kh-subsec-count {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 24px;
        height: 22px;
        padding: 0 .55rem;
        border-radius: 11px;
        background: var(--kh-gold);
        color: #fff;
        font-size: .72rem;
        font-weight: 800;
    }

    /* ═══ Card list ═══ */
    .kh-cards {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        gap: .75rem;
    }

    .kh-card {
        display: grid;
        grid-template-columns: 180px 1fr;
        background: var(--kh-surface);
        border: 1px solid var(--kh-border);
        border-radius: 10px;
        overflow: hidden;
        transition: transform .25s cubic-bezier(.22,.61,.36,1), box-shadow .25s ease, border-color .25s ease;
        position: relative;
    }

    .kh-card::after {
        content: "";
        position: absolute;
        inset-inline-start: 0;
        top: 0;
        bottom: 0;
        width: 3px;
        background: transparent;
        transition: background .25s;
    }

    .kh-card:hover {
        transform: translateY(-2px);
        border-color: #e0e2e6;
        box-shadow: 0 6px 22px rgba(2, 36, 72, .08);
    }
    .kh-card:hover::after { background: var(--kh-gold); }

    .kh-card-img-link {
        display: block;
        text-decoration: none;
        height: 100%;
    }

    .kh-card-img {
        position: relative;
        width: 100%;
        height: 100%;
        min-height: 140px;
        overflow: hidden;
        background: var(--kh-light);
    }

    .kh-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .4s cubic-bezier(.22,.61,.36,1);
    }

    .kh-card:hover .kh-card-img img { transform: scale(1.05); }

    .kh-card-img-placeholder {
        width: 100%;
        height: 100%;
        min-height: 140px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f0f2f5 0%, #e8ebf0 100%);
        color: #b0b7c3;
    }

    .kh-card-body {
        padding: .95rem 1.1rem;
        display: flex;
        flex-direction: column;
        gap: .45rem;
        min-width: 0;
    }

    .kh-card-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--kh-text);
        text-decoration: none;
        line-height: 1.4;
        display: block;
        transition: color .2s;
    }

    .kh-card-title:hover { color: var(--kh-gold-dk); text-decoration: none; }

    .kh-card-date {
        font-weight: 500;
        color: var(--kh-muted);
        font-size: .9em;
        white-space: nowrap;
    }

    .kh-card-desc {
        font-size: .82rem;
        color: var(--kh-muted);
        line-height: 1.55;
        margin: 0;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .kh-card-formats {
        display: flex;
        flex-wrap: wrap;
        gap: .3rem;
    }

    .kh-format-badge {
        display: inline-flex;
        align-items: center;
        padding: .18rem .5rem;
        border-radius: 12px;
        font-size: .65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .03em;
        border: 1px solid transparent;
        line-height: 1;
    }

    .kh-format-badge--research { background: #fef9ee; border-color: #fde68a; color: #92400e; }
    .kh-format-badge--talk     { background: #ecfeff; border-color: #a5f3fc; color: #155e75; }
    .kh-format-badge--edu      { background: #f0fdf4; border-color: #bbf7d0; color: #166534; }

    .kh-card-actions {
        display: flex;
        gap: .5rem;
        flex-wrap: wrap;
        margin-top: auto;
        padding-top: .25rem;
    }

    .kh-card-cta {
        display: inline-flex;
        align-items: center;
        gap: .3rem;
        padding: .35rem .7rem;
        border-radius: 6px;
        background: var(--kh-light);
        border: 1px solid var(--kh-border);
        color: #374151;
        font-size: .76rem;
        font-weight: 600;
        text-decoration: none;
        transition: all .2s;
    }

    .kh-card-cta:hover {
        border-color: var(--kh-gold);
        background: #fffdf6;
        color: var(--kh-gold-dk);
        text-decoration: none;
    }

    /* ═══ Pagination ═══ */
    .kh-pagination {
        display: flex;
        justify-content: center;
        margin-top: 1.25rem;
    }

    .kh-pagination .pagination {
        display: flex;
        gap: .3rem;
        list-style: none;
        margin: 0;
        padding: 0;
        flex-wrap: wrap;
        justify-content: center;
    }

    .kh-pagination .page-item .page-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 34px;
        height: 34px;
        padding: 0 .55rem;
        border-radius: 8px;
        border: 1px solid var(--kh-border);
        background: #fff;
        color: var(--kh-navy);
        font-size: .78rem;
        font-weight: 600;
        text-decoration: none;
        transition: all .2s;
        line-height: 1;
    }

    .kh-pagination .page-item .page-link:hover {
        border-color: var(--kh-gold);
        background: #fffdf6;
        color: var(--kh-gold-dk);
    }

    .kh-pagination .page-item.active .page-link {
        background: var(--kh-navy);
        border-color: var(--kh-navy);
        color: #fff;
    }

    .kh-pagination .page-item.disabled .page-link {
        opacity: .4;
        pointer-events: none;
    }

    /* ═══ Empty state ═══ */
    .kh-empty {
        text-align: center;
        padding: 3rem 1rem;
        color: var(--kh-muted);
        background: #fff;
        border: 1px dashed var(--kh-border);
        border-radius: 12px;
    }
    .kh-empty svg { color: #d1d5db; display: block; margin: 0 auto .6rem; }
    .kh-empty p { margin: 0; font-weight: 600; }

    /* ═══ Responsive ═══ */
    @media (max-width: 768px) {
        .kh-filter-bar { padding: .85rem 1rem; }
        .kh-filter-select { min-width: 0; flex: 1; }
        .kh-filter-clear { margin-inline-start: 0; }
        .kh-sec-head { flex-wrap: wrap; padding: .85rem 1rem; }
        .kh-sec-title { font-size: 1.1rem; }
        .kh-sec-sub { font-size: .78rem; }
        .kh-subsections {
            padding-inline-start: 1rem;
            margin-inline-start: .8rem;
            gap: 1.4rem;
        }
        .kh-subsec::before { inset-inline-start: -1rem; width: .9rem; }
        .kh-card {
            grid-template-columns: 110px 1fr;
        }
        .kh-card-img, .kh-card-img-placeholder { min-height: 110px; }
        .kh-card-body { padding: .75rem .85rem; }
        .kh-card-title { font-size: .92rem; }
    }
</style>
