<div>
    {{-- Search --}}
    <div class="trl-search-wrap mb-4">
        <div class="input-group" style="max-width:480px;">
            <input type="text"
                   class="form-control"
                   wire:model.debounce.400ms="search"
                   placeholder="Search..."
                   style="border-radius:8px 0 0 8px; border:1px solid #d1d5db; padding: 0.6rem 1rem;">
            <span class="input-group-text" style="background:#022448; border:none; border-radius:0 8px 8px 0; color:#fff;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
                </svg>
            </span>
        </div>
    </div>

    {{-- Results --}}
    @forelse($repos as $r)
        @php
            $hasImage = $r->image && \Storage::exists($r->image);
            $imgUrl   = $hasImage ? \Storage::url($r->image) : null;
        @endphp
        <article class="trl-card mb-3" wire:key="repo-{{ $r->id }}">
            <div class="row g-0 align-items-stretch">
                @if($imgUrl)
                <div class="col-md-2 d-none d-md-block">
                    <a href="{{ route('repo.single', $r->id) }}">
                        <img src="{{ $imgUrl }}" alt="{{ $r->title }}"
                             style="width:100%; height:100%; object-fit:cover; border-radius:10px 0 0 10px; min-height:110px; max-height:140px;">
                    </a>
                </div>
                @endif
                <div class="{{ $imgUrl ? 'col-md-10' : 'col-12' }} p-3">
                    <div class="d-flex flex-wrap gap-1 mb-1">
                        @foreach($r->tags->take(4) as $tag)
                            <span class="badge" style="background:#f0f4ff; color:#022448; font-size:0.72rem; font-weight:600; border-radius:20px; padding:3px 10px;">
                                {{ $tag->name }}
                            </span>
                        @endforeach
                    </div>
                    <h5 class="mb-1" style="font-size:1rem; font-weight:700; color:#022248;">
                        <a href="{{ route('repo.single', $r->id) }}" style="color:inherit; text-decoration:none;">
                            {{ $r->title }}
                        </a>
                    </h5>
                    @if($r->description)
                        <p class="mb-1" style="font-size:0.88rem; color:#6b7280; line-height:1.5;">
                            {{ \Illuminate\Support\Str::limit($r->description, 160) }}
                        </p>
                    @endif
                    <div class="d-flex align-items-center gap-3 mt-1">
                        @if($r->publish_date)
                            <small style="color:#9ca3af;">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:middle; margin-right:3px">
                                    <rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/>
                                    <line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                                </svg>
                                {{ \Carbon\Carbon::parse($r->publish_date)->format('M Y') }}
                            </small>
                        @endif
                        <a href="{{ route('repo.single', $r->id) }}"
                           style="font-size:0.85rem; color:#c8870a; font-weight:600; text-decoration:none;">
                            View →
                        </a>
                    </div>
                </div>
            </div>
        </article>
    @empty
        <div class="text-center py-5" style="color:#9ca3af;">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:1rem; opacity:.4;">
                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                <polyline points="14 2 14 8 20 8"/>
            </svg>
            <p>No items found.</p>
        </div>
    @endforelse

    {{-- Load More --}}
    @if($hasMorePages)
        <div class="text-center mt-4">
            <button class="btn" wire:click="loadMore" wire:loading.attr="disabled"
                    style="background:#022448; color:#fff; border-radius:8px; padding:0.6rem 2rem; font-weight:600;">
                <span wire:loading.remove wire:target="loadMore">Load More</span>
                <span wire:loading wire:target="loadMore">Loading…</span>
            </button>
        </div>
    @endif
</div>

<style>
    .trl-card {
        background: #fff;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
        overflow: hidden;
        transition: box-shadow 0.2s, transform 0.2s;
    }
    .trl-card:hover {
        box-shadow: 0 4px 20px rgba(2,36,72,.10);
        transform: translateY(-2px);
    }
</style>
