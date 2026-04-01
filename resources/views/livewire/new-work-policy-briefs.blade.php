<div class="container">
    <h3 class="mb-4" @if(LaravelLocalization::getCurrentLocale()==='ar' ) dir="rtl" @endif>
        @lang('translation.policy-briefs')
    </h3>

    <div class='row my-3 my-lg-5'>
        <div class='col-lg-9'>
            <!-- Top bar with search -->
            <div class="d-lg-flex d-none justify-content-between align-items-center flex-column flex-lg-row mb-3 gap-2">
                <div class="search-box event" style="width: 100% !important; ">
                    <div class="d-flex">
                        <input class="search"
                            style="border: 1px solid #CFCFCF; border-right: 0; padding-block: 14px; padding-inline: 12px;"
                            wire:model.defer="search" wire:keydown.enter="filterUpdated()"
                            placeholder="@lang('translation.search')">
                        {{-- @if($search ?? false)
                            <button type="submit" wire:click="clearSearch()">
                                Clear
                            </button>
                        @endif --}}
                        <button type="submit" wire:click="filterUpdated()"
                            style="border: 1px solid #CFCFCF; border-left: 0; padding-block: 14px; padding-inline: 12px;">
                            <svg width="20" height="20" viewBox="0 0 15 15" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_703_6664)">
                                    <path d="M5.80292 11.413C2.62774 11.413 0 8.91304 0 5.76087C0
                                         2.6087 2.62774 0 5.80292 0C8.9781 0 11.6058 2.6087 11.6058
                                         5.76087C11.6058 8.91304 8.9781 11.413 5.80292 11.413ZM5.80292
                                         1.08696C3.17518 1.08696 1.09489 3.15217 1.09489 5.76087C1.09489
                                         8.36957 3.17518 10.4348 5.80292 10.4348C8.43066 10.4348 10.5109
                                         8.36957 10.5109 5.76087C10.5109 3.15217 8.32117 1.08696 5.80292 1.08696Z"
                                        fill="#757575" />
                                    <path
                                        d="M9.68313 8.99118L8.90894 9.75977L14.2509 15.063L15.0251 14.2944L9.68313 8.99118Z"
                                        fill="#757575" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_703_6664">
                                        <rect width="15" height="15" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <div wire:loading.flex class="justify-content-center my-4">
                <div class="spinner-border" role="status" aria-label="Loading"></div>
            </div>
            <!-- Policy Briefs Listing -->
            <div wire:loading.remove id='policy-briefs' class="lazy-items-container" style='margin-bottom: 40px;'>
                @if($policyBriefs && $policyBriefs->count() > 0)
                @foreach($policyBriefs as $index => $brief)
                <div class='row mb-4 lazy-item'>
                    <div class='col-lg-3'>
                        <a href="{{ $brief->en_pdf ? asset('storage/' . $brief->en_pdf) : '#' }}" target="_blank">
                            <img class="event_img"
                                src="{{ $brief->image ? asset('storage/' . $brief->image) : asset('storage/' . "storage/680e75fc3ae42995d06462837d3d5085.png") }}"
                                alt="{{ $brief->title }}">
                        </a>
                    </div>
                    <div class='col-lg-9 d-flex justify-content-between flex-column'>
                        <div>
                            <a href="{{ $brief->en_pdf ? asset('storage/' . $brief->en_pdf) : '#' }}"
                                class="event-title" target="_blank">
                                {{ $brief->title }}
                            </a>
                            <p class="event-description">
                                {{ Str::limit(strip_tags($brief->description), 150) }}
                            </p>
                        </div>

                        <div class="d-flex flex-row flex-wrap">
                            @foreach($brief->tags as $tag)
                            <a class="tag" href="/search?tag={{ $tag->name }}">
                                {{ $tag->name }}
                            </a>
                            @endforeach
                        </div>

                        <div class="d-flex pt-3 pt-lg-0" style="gap: 20px; justify-content: right;">
                            @if($brief->en_pdf || $brief->ar_pdf)
                            <a class="download-btn"
                                style="background-color: #F1C268; padding-block: 16px; color: var(--menablue) !important; border-radius: 6px; font-weight: bold;"
                                href="{{ $brief->en_pdf ? asset('storage/' . $brief->en_pdf) : asset('storage/' . $brief->ar_pdf )}}"
                                target="_blank">
                                <span>@lang('translation.download')</span>
                                <img style="object-fit: contain;max-width: 20px;" src="/img/download.svg">
                            </a>
                            @else
                            <button class="download-btn disabled">
                                <span>Not Available</span>
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
                <hr class="my-3 lazy-item">
                @endforeach
                @else
                <div class="text-center py-5">
                    <img src="{{ asset('storage/' . "storage/680e75fc3ae42995d06462837d3d5085.png") }}"
                        alt="Policy Brief Image" style="max-width:120px;">
                    <h5 class="mt-3">No Policy Brief</h5>
                    <p>No policy briefs available yet. Please add policy briefs from the admin panel.</p>
                </div>
                @endif
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
            @else
                @if($policyBriefs->count() > 0)
                    <div class="end-of-list">
                        You've reached the end
                    </div>
                @endif
            @endif
        </div>

        <!-- Filters Section (optional) -->
        <div class='col-lg-3 filter-container py-2'>
            <div class="d-flex justify-content-between">
                <h6>@lang('translation.filter-by')</h6>
            </div>
            <!-- Example filter by year -->
            @if(isset($publish_dates) && count($publish_dates) > 0)
            <p class="filter-title">@lang('translation.year')</p>
            <div class='filter'>
                @foreach($publish_dates as $year)
                <div class="form-check">
                    <input class="form-check-input" wire:model.defer="selectedPublishDates" type="checkbox"
                        value='{{$year}}' id="year-{{$year}}">
                    <label class="form-check-label" for="year-{{$year}}">
                        {{$year}}
                    </label>
                </div>
                @endforeach
            </div>
            @endif

            {{-- Filter by Authors --}}
            @if(isset($authors) && count($authors) > 0)
            <p class="filter-title">Authors</p>
            <div class='filter'>
                @foreach($authors as $author)
                <div class="form-check">
                    <input class="form-check-input" wire:model.defer="selectedAuthorsIds" type="checkbox"
                        value="{{ $author['id'] }}" id="author-{{ $author['id'] }}">
                    <label class="form-check-label" for="author-{{ $author['id'] }}">
                        {{ $author['name'] }}
                    </label>
                </div>
                @endforeach
            </div>
            @endif

            {{-- Filter by Subjects --}}
            @if(isset($subjects) && count($subjects) > 0)
            <p class="filter-title">Subjects</p>
            <div class='filter'>
                @foreach($subjects as $subject)
                <div class="form-check">
                    <input class="form-check-input" wire:model.defer="selectedSubjects" type="checkbox"
                        value="{{ $subject }}" id="subject-{{ $loop->index }}">
                    <label class="form-check-label" for="subject-{{ $loop->index }}">
                        {{ $subject }}
                    </label>
                </div>
                @endforeach
            </div>
            @endif

            {{-- Filter by Projects --}}
            @if(isset($projects) && count($projects) > 0)
            <p class="filter-title">Projects</p>
            <div class='filter'>
                @foreach($projects as $project)
                <div class="form-check">
                    <input class="form-check-input" wire:model.defer="selectedProjects" type="checkbox"
                        value="{{ $project }}" id="project-{{ $loop->index }}">
                    <label class="form-check-label" for="project-{{ $loop->index }}">
                        {{ $project }}
                    </label>
                </div>
                @endforeach
            </div>
            @endif

            {{-- Filter by Countries --}}
            @if(isset($allCountries) && count($allCountries) > 0)
            <p class="filter-title">Countries</p>
            <div class='filter'>
                @foreach($allCountries as $country)
                <div class="form-check">
                    <input class="form-check-input" wire:model.defer="selectedCountryIds" type="checkbox"
                        value="{{ $country['id'] }}" id="country-{{ $country['id'] }}">
                    <label class="form-check-label" for="country-{{ $country['id'] }}">
                        {{ $country['name'] }}
                    </label>
                </div>
                @endforeach
            </div>
            @endif

            {{-- Filter by Repo Types --}}
            <!-- @if(isset($repo_types) && count($repo_types) > 0)
            <p class="filter-title">Repo Types</p>
            <div class='filter'>
                @foreach($repo_types as $type)
                <div class="form-check">
                    <input class="form-check-input" wire:model.defer="repo_type_ids" type="checkbox"
                        value="{{ $type['id'] }}" id="type-{{ $type['id'] }}">
                    <label class="form-check-label" for="type-{{ $type['id'] }}">
                        {{ $type['name'] }}
                    </label>
                </div>
                @endforeach
            </div>
            @endif -->

            <div class="m-lg-3 my-sm-2" style='float:right;'>
                <button class="btn login" style='background-color:transparent;border:0;box-shadow: none'
                    wire:click="clear">CLEAR</button>
                <button class="btn login" wire:click="filterUpdated()"><i class="fas fa-check"></i> Apply</button>
            </div>
        </div>
    </div>
</div>