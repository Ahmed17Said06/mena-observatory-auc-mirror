<div class='row my-3 my-lg-5'>
    <div class='col-lg-9'>
        <!-- Enhanced Search and Filter Section -->
        <div class="search-filter-section mb-4">
            <!-- Type Buttons (Knowledge Hub only) -->
            @if(!$is_data_repo_page)
                <div class="type-buttons-container d-none d-lg-flex gap-2 mb-3 flex-wrap">
                    @foreach($repo_types as $type)
                        <button wire:click="setType('{{ $type->id }}')"
                                class="btn-type {{ in_array($type->id, $repo_type_ids) ? 'active' : '' }}">
                            {{ $type->name }}
                        </button>
                    @endforeach
                </div>
            @endif
            
            <!-- Enhanced Search Box -->
            <div class="search-box-enhanced">
                <div class="search-input-wrapper">
                    <svg class="search-icon" width="20" height="20" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_703_6664)">
                            <path d="M5.80292 11.413C2.62774 11.413 0 8.91304 0 5.76087C0 2.6087 2.62774 0 5.80292 0C8.9781 0 11.6058 2.6087 11.6058 5.76087C11.6058 8.91304 8.9781 11.413 5.80292 11.413ZM5.80292 1.08696C3.17518 1.08696 1.09489 3.15217 1.09489 5.76087C1.09489 8.36957 3.17518 10.4348 5.80292 10.4348C8.43066 10.4348 10.5109 8.36957 10.5109 5.76087C10.5109 3.15217 8.32117 1.08696 5.80292 1.08696Z" fill="currentColor"/>
                            <path d="M9.68313 8.99118L8.90894 9.75977L14.2509 15.063L15.0251 14.2944L9.68313 8.99118Z" fill="currentColor"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_703_6664">
                                <rect width="15" height="15" fill="white"/>
                            </clipPath>
                        </defs>
                    </svg>
                    <input class="search-input" 
                           wire:model.defer="search"
                           wire:keydown.enter="filterUpdated()"
                           placeholder="Search publications, reports, and data..."
                           type="text">
                    @if($search)
                        <button type="button" class="clear-search-btn" wire:click="clearSearch()">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M12 4L4 12M4 4L12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </button>
                    @endif
                    <button type="button" class="search-submit-btn" wire:click="filterUpdated()">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="d-none d-sm-inline">
                            <circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2"/>
                            <path d="M21 21L16.65 16.65" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                        Search
                    </button>
                </div>
                
                <!-- Quick Search Suggestions -->
                <div class="quick-search-tags mt-2 d-none d-md-flex flex-wrap gap-2">
                    <span class="quick-tag-label">Popular:</span>
                    <button type="button" class="quick-tag" wire:click="$set('search', 'AI Policy')">AI Policy</button>
                    <button type="button" class="quick-tag" wire:click="$set('search', 'Ethics')">Ethics</button>
                    <button type="button" class="quick-tag" wire:click="$set('search', 'Governance')">Governance</button>
                    <button type="button" class="quick-tag" wire:click="$set('search', 'Research')">Research</button>
                </div>
            </div>
        </div>

        <!-- Results Container -->
        <div id='repos' class="results-container">
            @foreach($repos as $index => $r)
                @php
                    $linkUrl = $r->data_link ?: (
                        $r->en_pdf ? Storage::url($r->en_pdf) : (
                            $r->ar_pdf ? Storage::url($r->ar_pdf) : '#'
                        )
                    );
                @endphp
                <article class='result-card lazy-item'>
                    <div class='row g-3'>
                        <div class='col-lg-3 col-md-4'>
                            <a href="{{$linkUrl}}" target="_blank" rel="noopener noreferrer" class="image-link">
                                <div class="image-wrapper">
                                    <img class="result-image" src='{{Storage::url($r->image)}}' alt="{{$r->title}}">
                                    <div class="image-overlay">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M10 6H6C4.89543 6 4 6.89543 4 8V18C4 19.1046 4.89543 20 6 20H16C17.1046 20 18 19.1046 18 18V14M14 4H20M20 4V10M20 4L10 14" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class='col-lg-9 col-md-8 d-flex flex-column'>
                            <div class="result-content">
                                <a href="{{$linkUrl}}" target="_blank" rel="noopener noreferrer" class="result-title">
                                    {{$r->title}}
                                </a>
                                <p class="result-description">
                                    {{$r->description}}
                                </p>
                            </div>
                            
                            @if(count($r->tags) > 0)
                                <div class="tags-container">
                                    @foreach($r->tags as $tag)
                                        <a class="tag-badge" href="/search?tag={{$tag->name}}">
                                            {{$tag->name}}
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                            
                            <div class="result-actions">
                                @if($r->ar_pdf)
                                    <a class="download-button" href="{{Storage::url($r->ar_pdf)}}" target="_blank">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                            <path d="M21 15V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V15M7 10L12 15M12 15L17 10M12 15V3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <span>Arabic</span>
                                    </a>
                                @endif
                                @if($r->en_pdf)
                                    <a class="download-button" href="{{Storage::url($r->en_pdf)}}" target="_blank">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                            <path d="M21 15V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21H5C4.46957 21 3.96086 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V15M7 10L12 15M12 15L17 10M12 15V3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <span>English</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <!-- Load More / End of List -->
        @if($hasMorePages)
            <div class="load-more-section">
                <button 
                    type="button"
                    class="load-more-btn"
                    wire:click="loadMore"
                    wire:loading.attr="disabled"
                    wire:loading.class="is-loading"
                >
                    <span class="btn-text">Load More Results</span>
                    <span class="btn-loading">
                        <span class="spinner-border spinner-border-sm"></span>
                        Loading...
                    </span>
                </button>
            </div>
        @else
            @if($repos->count() > 0)
                <div class="end-message">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span>You've reached the end</span>
                </div>
            @endif
        @endif
    </div>

    <!-- Enhanced Sidebar Filters -->
    <div class='col-lg-3'>
        <div class="filters-sidebar">
            <div class="filters-header">
                <h6 class="filters-title">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                        <path d="M22 3H2L10 12.46V19L14 21V12.46L22 3Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Filters
                </h6>
            </div>

            <div class="filters-content">
                @if(count($authors)>0)
                    <div class="filter-group">
                        <p class="filter-group-title">Author</p>
                        <div class='filter-options'>
                            @foreach($authors as $author)
                                <label class="filter-checkbox">
                                    <input wire:model.defer="selectedAuthorsIds" 
                                           type="checkbox"
                                           value='{{$author->id}}'>
                                    <span class="checkmark"></span>
                                    <span class="label-text">{{ $author->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(count($fields) > 0)
                    <div class="filter-group">
                        <p class="filter-group-title">Field</p>
                        <div class='filter-options'>
                            @foreach($fields as $field)
                                <label class="filter-checkbox">
                                    <input wire:model.defer="selectedFields" 
                                           type="checkbox"
                                           value='{{$field}}'>
                                    <span class="checkmark"></span>
                                    <span class="label-text">{{ $field }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(count($subjects) > 0)
                    <div class="filter-group">
                        <p class="filter-group-title">Subject</p>
                        <div class='filter-options'>
                            @foreach($subjects as $subject)
                                <label class="filter-checkbox">
                                    <input wire:model.defer="selectedSubjects" 
                                           type="checkbox"
                                           value='{{$subject}}'>
                                    <span class="checkmark"></span>
                                    <span class="label-text">{{ $subject }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(count($projects) > 0)
                    <div class="filter-group">
                        <p class="filter-group-title">Project</p>
                        <div class='filter-options'>
                            @foreach($projects as $project)
                                <label class="filter-checkbox">
                                    <input wire:model.defer="selectedProjects" 
                                           type="checkbox"
                                           value='{{$project}}'>
                                    <span class="checkmark"></span>
                                    <span class="label-text">{{ $project }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(count($publish_dates) > 0)
                    <div class="filter-group">
                        <p class="filter-group-title">Year</p>
                        <div class='filter-options'>
                            @foreach($publish_dates as $publish_date)
                                <label class="filter-checkbox">
                                    <input wire:model.defer="selectedPublishDates" 
                                           type="checkbox"
                                           value='{{$publish_date}}'>
                                    <span class="checkmark"></span>
                                    <span class="label-text">{{ $publish_date }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(!$is_data_repo_page && count($repo_types)>0)
                    <div class="filter-group">
                        <p class="filter-group-title">Type</p>
                        <div class='filter-options'>
                            @foreach($repo_types as $type)
                                <label class="filter-checkbox">
                                    <input wire:model.defer="repo_type_ids" 
                                           type="checkbox"
                                           value='{{$type->id}}'>
                                    <span class="checkmark"></span>
                                    <span class="label-text">{{$type->name}}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(count($allCountries)>0)
                    <div class="filter-group">
                        <p class="filter-group-title">Country</p>
                        <div class='filter-options'>
                            @foreach($allCountries as $country)
                                <label class="filter-checkbox">
                                    <input wire:model.defer="selectedCountryIds" 
                                           type="checkbox"
                                           value='{{$country->id}}'>
                                    <span class="checkmark"></span>
                                    <span class="label-text">{{$country->name}}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="filters-actions">
                <button class="btn-clear" wire:click="clear">
                    Clear All
                </button>
                <button class="btn-apply" wire:click="filterUpdated()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                        <path d="M20 6L9 17L4 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Apply
                </button>
            </div>
        </div>
    </div>
</div>

<style>
/* Search and Filter Section */
.search-filter-section {
    background: #fff;
    padding: 1.5rem;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
}

/* Search Header - Results Count & Filters */
.search-header {
    padding-bottom: 1rem;
    border-bottom: 1px solid #f0f0f0;
}

.results-info {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.results-count {
    color: #374151;
    font-size: 0.95rem;
}

.results-count strong {
    color: #FAAF1C;
    font-weight: 700;
}

.search-term {
    color: #6b7280;
    font-size: 0.9rem;
}

.search-term em {
    color: #FAAF1C;
    font-style: normal;
    font-weight: 600;
}

/* Active Filters Badge */
.active-filters-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 0.75rem;
    background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
    border: 1px solid #fbbf24;
    border-radius: 20px;
    font-size: 0.813rem;
    font-weight: 600;
    color: #1f2937;
}

.active-filters-badge svg {
    width: 14px;
    height: 14px;
    color: #92400e;
}

.clear-filters-btn {
    background: #1f2937;
    border: none;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    font-size: 14px;
    line-height: 1;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    transition: all 0.2s ease;
    margin-left: 0.25rem;
}

.clear-filters-btn:hover {
    background: #dc2626;
    transform: scale(1.1);
}

/* Mobile Filter Toggle */
.mobile-filter-toggle {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.625rem 1rem;
    background: #fff;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.875rem;
    color: #374151;
    cursor: pointer;
    transition: all 0.2s ease;
}

.mobile-filter-toggle:hover {
    border-color: #FAAF1C;
    color: #FAAF1C;
}

.filter-count-badge {
    background: #FAAF1C;
    color: #fff;
    font-size: 0.75rem;
    font-weight: 700;
    padding: 0.125rem 0.5rem;
    border-radius: 10px;
    min-width: 20px;
    text-align: center;
}

/* Quick Search Tags */
.quick-search-tags {
    align-items: center;
}

.quick-tag-label {
    color: #9ca3af;
    font-size: 0.813rem;
    font-weight: 500;
}

.quick-tag {
    padding: 0.375rem 0.75rem;
    background: #f3f4f6;
    border: 1px solid #e5e7eb;
    border-radius: 16px;
    font-size: 0.813rem;
    color: #4b5563;
    cursor: pointer;
    transition: all 0.2s ease;
}

.quick-tag:hover {
    background: #FAAF1C;
    border-color: #FAAF1C;
    color: #fff;
    transform: translateY(-1px);
}


.type-buttons-container {
    gap: 0.75rem;
}

.btn-type {
    padding: 0.625rem 1.25rem;
    border-radius: 8px;
    border: 2px solid #e5e7eb;
    background: #fff;
    color: #374151;
    font-weight: 500;
    font-size: 0.875rem;
    transition: all 0.2s ease;
    cursor: pointer;
}

.btn-type:hover {
    border-color: #FAAF1C;
    color: #FAAF1C;
    transform: translateY(-1px);
}

.btn-type.active {
    background: #FAAF1C;
    border-color: #FAAF1C;
    color: #fff;
    box-shadow: 0 4px 12px rgba(250, 175, 28, 0.3);
}

/* Enhanced Search Box */
.search-box-enhanced {
    width: 100%;
}

.search-input-wrapper {
    position: relative;
    display: flex;
    align-items: center;
    background: #f9fafb;
    border: 2px solid #e5e7eb;
    border-radius: 10px;
    padding: 0.5rem;
    transition: all 0.2s ease;
}

.search-input-wrapper:focus-within {
    background: #fff;
    border-color: #FAAF1C;
    box-shadow: 0 0 0 3px rgba(250, 175, 28, 0.1);
}

.search-icon {
    color: #9ca3af;
    margin: 0 0.75rem;
    flex-shrink: 0;
}

.search-input {
    flex: 1;
    border: none;
    background: transparent;
    padding: 0.5rem;
    font-size: 1rem;
    color: #111827;
    outline: none;
}

.search-input::placeholder {
    color: #9ca3af;
}

.clear-search-btn {
    background: none;
    border: none;
    color: #6b7280;
    padding: 0.5rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 6px;
    transition: all 0.2s ease;
}

.clear-search-btn:hover {
    background: #f3f4f6;
    color: #374151;
}

.search-submit-btn {
    background: #FAAF1C;
    color: #fff;
    border: none;
    padding: 0.625rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.875rem;
    cursor: pointer;
    transition: all 0.2s ease;
    margin-left: 0.5rem;
}

.search-submit-btn:hover {
    background: #e89d0f;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(250, 175, 28, 0.3);
}

/* Results Container */
.results-container {
    margin-bottom: 2rem;
}

.result-card {
    background: #fff;
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    transition: all 0.3s ease;
    border: 1px solid #f3f4f6;
}

.result-card:hover {
    box-shadow: 0 8px 24px rgba(0,0,0,0.12);
    transform: translateY(-2px);
}

.image-link {
    display: block;
    text-decoration: none;
}

.image-wrapper {
    position: relative;
    width: 100%;
    padding-top: 75%;
    border-radius: 8px;
    overflow: hidden;
    background: #f3f4f6;
}

.result-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.image-wrapper:hover .image-overlay {
    opacity: 1;
}

.image-wrapper:hover .result-image {
    transform: scale(1.05);
}

.result-content {
    flex: 1;
    margin-bottom: 1rem;
}

.result-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #111827;
    text-decoration: none;
    display: block;
    margin-bottom: 0.75rem;
    line-height: 1.4;
    transition: color 0.2s ease;
}

.result-title:hover {
    color: #FAAF1C;
}

.result-description {
    color: #6b7280;
    font-size: 0.938rem;
    line-height: 1.6;
    margin: 0;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.tags-container {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-bottom: 1rem;
}

.tag-badge {
    display: inline-block;
    padding: 0.375rem 0.875rem;
    background: #f3f4f6;
    color: #374151;
    border-radius: 6px;
    font-size: 0.813rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s ease;
}

.tag-badge:hover {
    background: #FAAF1C;
    color: #fff;
    transform: translateY(-1px);
}

.result-actions {
    display: flex;
    gap: 0.75rem;
    flex-wrap: wrap;
}

.download-button {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.625rem 1.125rem;
    background: #fff;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    color: #374151;
    font-weight: 600;
    font-size: 0.875rem;
    text-decoration: none;
    transition: all 0.2s ease;
}

.download-button:hover {
    border-color: #FAAF1C;
    color: #FAAF1C;
    background: #fffbf0;
    transform: translateY(-1px);
}

/* Load More Section */
.load-more-section {
    display: flex;
    justify-content: center;
    padding: 2rem 0;
}

.load-more-btn {
    padding: 0.875rem 2.5rem;
    background: #fff !important;
    border: 2px solid #FAAF1C;
    color: #000000 !important;
    border-radius: 10px;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
}

.load-more-btn .btn-text,
.load-more-btn .btn-loading,
.load-more-btn .btn-loading span,
.load-more-btn span {
    color: #000000 !important;
}

.load-more-btn .btn-text {
    display: inline;
}

.load-more-btn .btn-loading {
    display: none;
    align-items: center;
    gap: 0.5rem;
}

.load-more-btn.is-loading .btn-text {
    display: none;
}

.load-more-btn.is-loading .btn-loading {
    display: inline-flex;
}

.load-more-btn:hover:not(:disabled):not(.is-loading) {
    background: #FAAF1C;
    color: #1f2937;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(250, 175, 28, 0.3);
}

.load-more-btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

.end-message {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    padding: 2rem;
    color: #6b7280;
    font-size: 1rem;
    font-weight: 500;
}

.end-message svg {
    color: #10b981;
}

/* Filters Sidebar */
.filters-sidebar {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    position: sticky;
    top: 2rem;
    max-height: calc(100vh - 4rem);
    display: flex;
    flex-direction: column;
}

.filters-header {
    padding: 1.5rem;
    border-bottom: 1px solid #e5e7eb;
}

.filters-title {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1.125rem;
    font-weight: 700;
    color: #111827;
    margin: 0;
}

.filters-title svg {
    color: #FAAF1C;
}

.filters-content {
    flex: 1;
    overflow-y: auto;
    padding: 1rem 1.5rem;
}

.filter-group {
    margin-bottom: 1.5rem;
}

.filter-group:last-child {
    margin-bottom: 0;
}

.filter-group-title {
    font-size: 0.813rem;
    font-weight: 700;
    color: #6b7280;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 0.875rem;
}

.filter-options {
    display: flex;
    flex-direction: column;
    gap: 0.625rem;
}

.filter-checkbox {
    display: flex;
    align-items: center;
    cursor: pointer;
    position: relative;
    padding-left: 2rem;
    user-select: none;
}

.filter-checkbox input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0;
}

.checkmark {
    position: absolute;
    left: 0;
    height: 1.25rem;
    width: 1.25rem;
    background-color: #fff;
    border: 2px solid #d1d5db;
    border-radius: 4px;
    transition: all 0.2s ease;
}

.filter-checkbox:hover input ~ .checkmark {
    border-color: #FAAF1C;
}

.filter-checkbox input:checked ~ .checkmark {
    background-color: #FAAF1C;
    border-color: #FAAF1C;
}

.checkmark:after {
    content: "";
    position: absolute;
    display: none;
    left: 6px;
    top: 3px;
    width: 4px;
    height: 8px;
    border: solid white;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
}

.filter-checkbox input:checked ~ .checkmark:after {
    display: block;
}

.label-text {
    color: #374151;
    font-size: 0.938rem;
    line-height: 1.4;
}

.filters-actions {
    display: flex;
    gap: 0.75rem;
    padding: 1.5rem;
    border-top: 1px solid #e5e7eb;
}

.btn-clear {
    flex: 1;
    padding: 0.75rem;
    background: #fff;
    border: 2px solid #e5e7eb;
    color: #6b7280;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.875rem;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-clear:hover {
    border-color: #d1d5db;
    color: #374151;
    background: #f9fafb;
}

.btn-apply {
    flex: 1;
    padding: 0.75rem;
    background: #FAAF1C;
    border: 2px solid #FAAF1C;
    color: #fff;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.875rem;
    cursor: pointer;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.btn-apply:hover {
    background: #e89d0f;
    border-color: #e89d0f;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(250, 175, 28, 0.3);
}

/* Responsive Design */
@media (max-width: 991px) {
    .filters-sidebar {
        position: fixed;
        top: 0;
        right: -100%;
        width: 320px;
        max-width: 85vw;
        height: 100vh;
        max-height: 100vh;
        margin-top: 0;
        z-index: 9999;
        border-radius: 0;
        box-shadow: -4px 0 24px rgba(0,0,0,0.15);
        transition: right 0.3s ease;
    }
    
    .filters-sidebar.show {
        right: 0;
    }
    
    .filters-sidebar::before {
        content: '';
        position: fixed;
        top: 0;
        left: -100vw;
        width: 100vw;
        height: 100vh;
        background: rgba(0,0,0,0.5);
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease;
        z-index: -1;
    }
    
    .filters-sidebar.show::before {
        opacity: 1;
        visibility: visible;
    }
    
    .filters-header {
        position: relative;
    }
    
    .filters-sidebar.show .filters-header::after {
        content: '×';
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        font-size: 1.5rem;
        cursor: pointer;
        color: #6b7280;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #f3f4f6;
    }
    
    .result-card {
        padding: 1.25rem;
    }
    
    .search-filter-section {
        padding: 1rem;
    }
    
    .search-header {
        flex-direction: column;
        align-items: flex-start;
    }
}

@media (max-width: 767px) {
    .result-title {
        font-size: 1.125rem;
    }
    
    .download-button {
        font-size: 0.813rem;
        padding: 0.5rem 0.875rem;
    }
    
    .search-submit-btn {
        padding: 0.625rem 1rem;
        font-size: 0.813rem;
    }
}
</style>