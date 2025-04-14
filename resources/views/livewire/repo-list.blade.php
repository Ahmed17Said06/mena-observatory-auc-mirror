<div class='row my-3 my-lg-5'>
    <div class='col-lg-9'>
        <div class="d-lg-flex d-none justify-content-between align-items-center flex-column flex-lg-row mb-3 gap-2">
            {{--            <a hreflang="{{ getLang() }}" class="btn btn-mena-2">--}}
            {{--                RESEARCH OUTPUTS--}}
            {{--            </a>--}}
            {{--            <a hreflang="{{ getLang() }}" class="btn btn-mena-2">--}}
            {{--                EDUCATIONAL RESOURCES--}}
            {{--            </a>--}}
            {{--            <a hreflang="{{ getLang() }}" class="btn btn-mena-2">--}}
            {{--                DATA DEPOSITORY--}}
            {{--            </a>--}}
            @foreach($repo_types as $type)
                <button wire:click="setType('{{ $type->id }}')"
                        class="btn btn-mena-4 {{ in_array($type->id, $repo_type_ids) ? 'active' : 'btn-mena-4' }}">
                    {{ $type->name }}
                    <script>
    console.log("Type name: {{ $type}}");
</script>
                </button>
            @endforeach
            <div class="search-box event">
                <div class="d-flex">
                    <input class="search" wire:model.defer="search"
                           wire:keydown.enter="filterUpdated()"
                           placeholder="Search">
                    @if($search)
                        {{--TODO: need restyle the clear button showed after apply search--}}
                        <button type="submit" wire:click="clearSearch()">
                            Clear
                        </button>
                    @endif
                    <button type="submit">
                        <svg width="20" height="20" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg"
                             wire:click="filterUpdated()">
                            <g clip-path="url(#clip0_703_6664)">
                                <path
                                    d="M5.80292 11.413C2.62774 11.413 0 8.91304 0 5.76087C0
                                     2.6087 2.62774 0 5.80292 0C8.9781 0 11.6058 2.6087 11.6058
                                     5.76087C11.6058 8.91304 8.9781 11.413 5.80292 11.413ZM5.80292
                                     1.08696C3.17518 1.08696 1.09489 3.15217 1.09489 5.76087C1.09489
                                     8.36957 3.17518 10.4348 5.80292 10.4348C8.43066 10.4348 10.5109
                                     8.36957 10.5109 5.76087C10.5109 3.15217 8.32117 1.08696 5.80292 1.08696Z"
                                    fill="#FAAF1C"/>
                                <path
                                    d="M9.68313 8.99118L8.90894 9.75977L14.2509 15.063L15.0251 14.2944L9.68313 8.99118Z"
                                    fill="#FAAF1C"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_703_6664">
                                    <rect width="15" height="15" fill="white"/>
                                </clipPath>
                            </defs>
                        </svg>
                    </button>
                </div>
            </div>
            {{--            <div style="margin: 0px 10px">--}}
            {{--                <div class="dropdown">--}}
            {{--                    <a class="dropbtn">--}}
            {{--                        <img src="/img/sort-icon.svg">--}}
            {{--                        <span class="d-none d-lg-inline"--}}
            {{--                              style="font-size: 14px;color: #2E2E2E;font-weight: bold;margin-left: 10px">--}}
            {{--                            SORT BY--}}
            {{--                        </span>--}}
            {{--                    </a>--}}
            {{--                    <div class="dropdown-content">--}}
            {{--                        <a class="active">Newest</a>--}}
            {{--                        <a>Oldest</a>--}}
            {{--                        <a>Alphabetical (A -> Z)</a>--}}
            {{--                        <a>Alphabetical (Z -> A</a>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--                <script>--}}
            {{--                    $(document).ready(function () {--}}
            {{--                        $(".dropbtn").click(function (event) {--}}
            {{--                            event.stopPropagation(); // Prevent click event from propagating to document--}}
            {{--                            $(".dropdown-content").show();--}}
            {{--                        });--}}

            {{--                        $(".dropdown-content").click(function (event) {--}}
            {{--                            event.stopPropagation(); // Prevent click event from propagating to document--}}
            {{--                        });--}}

            {{--                        $(document).click(function (event) {--}}
            {{--                            if (!$(event.target).closest(".dropdown-content").length && !$(event.target).is(".dropbtn")) {--}}
            {{--                                $(".dropdown-content").hide();--}}
            {{--                            }--}}
            {{--                        });--}}
            {{--                    });--}}
            {{--                </script>--}}
            {{--            </div>--}}
            {{--            <div class="d-inline" style="margin-left: 10px">--}}
            {{--                <div style="">--}}
            {{--                    <dialog id="filters-popup">--}}
            {{--                        <div class="popup-header">--}}
            {{--                            <h3>Filters</h3>--}}
            {{--                            <a id="closebtn" class="closebtn">×</a>--}}
            {{--                        </div>--}}
            {{--                        <div class="popup-content mb-3">--}}
            {{--                            <div class="d-flex justify-content-between">--}}
            {{--                                <h6>Applied filters</h6>--}}
            {{--                                <p class="clear-filter">Clear all</p>--}}
            {{--                            </div>--}}
            {{--                            <div class="d-flex flex-wrap" style="gap: 10px;flex-shrink: 0;">--}}
            {{--                                <a class="filter-option active">--}}
            {{--                                    Science--}}
            {{--                                    <i>x</i>--}}
            {{--                                </a>--}}
            {{--                                <a class="filter-option">--}}
            {{--                                    Science--}}
            {{--                                    <i>+</i>--}}
            {{--                                </a>--}}
            {{--                                <a class="filter-option">--}}
            {{--                                    Science--}}
            {{--                                    <i>+</i>--}}
            {{--                                </a>--}}
            {{--                            </div>--}}
            {{--                            <div class="d-flex justify-content-between mt-3">--}}
            {{--                                <h6>Date</h6>--}}
            {{--                            </div>--}}
            {{--                            <div class="d-flex flex-wrap" style="gap: 10px;flex-shrink: 0;">--}}
            {{--                                <input type="date" class="start-date">--}}
            {{--                                <input type="date" class="end-date">--}}
            {{--                            </div>--}}
            {{--                            <div class="d-flex justify-content-between mt-3">--}}
            {{--                                <h6>Category</h6>--}}
            {{--                            </div>--}}
            {{--                            <div class="d-flex flex-wrap" style="gap: 10px;flex-shrink: 0;">--}}
            {{--                                <a class="filter-option active">--}}
            {{--                                    Science--}}
            {{--                                    <i>x</i>--}}
            {{--                                </a>--}}
            {{--                                <a class="filter-option">--}}
            {{--                                    Science--}}
            {{--                                    <i>+</i>--}}
            {{--                                </a>--}}
            {{--                                <a class="filter-option">--}}
            {{--                                    Science--}}
            {{--                                    <i>+</i>--}}
            {{--                                </a>--}}
            {{--                            </div>--}}
            {{--                            <div class="d-flex justify-content-between mt-3">--}}
            {{--                                <h6>Author</h6>--}}
            {{--                            </div>--}}
            {{--                            <div class="d-flex" style="gap: 10px;flex-shrink: 0;">--}}
            {{--                                <select class="form-select" aria-label="Any">--}}
            {{--                                    <option selected>Any</option>--}}
            {{--                                    <option value="1">One</option>--}}
            {{--                                    <option value="2">Two</option>--}}
            {{--                                    <option value="3">Three</option>--}}
            {{--                                </select>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <button class="btn btn-mena-2">Apply</button>--}}
            {{--                    </dialog>--}}
            {{--                    <a id="showDialog" style="cursor: pointer">--}}
            {{--                        <img src="/img/filter-icon.svg">--}}
            {{--                    </a>--}}
            {{--                    <script>--}}
            {{--                        (() => {--}}
            {{--                            const updateButton = document.getElementById("showDialog");--}}
            {{--                            const closeButton = document.getElementById("closebtn");--}}
            {{--                            const dialog = document.getElementById("filters-popup");--}}

            {{--                            // Update button opens a modal dialog--}}
            {{--                            updateButton.addEventListener("click", () => {--}}
            {{--                                dialog.showModal();--}}
            {{--                                openCheck(dialog);--}}
            {{--                            });--}}

            {{--                            // Form close button closes the dialog box--}}
            {{--                            closeButton.addEventListener("click", () => {--}}
            {{--                                dialog.close();--}}
            {{--                            });--}}
            {{--                        })();--}}
            {{--                    </script>--}}
            {{--                </div>--}}
            {{--            </div>--}}
        </div>
        <div id='repos' style='margin-bottom: 40px;'>
            @foreach($repos as $r)
                <div class='row' style='margin-bottom:30px;'>
                    <div class='col-lg-3'>
                        {{--                        <a href="{{route('resources.single',$r->id)}}" >--}}
                        <a href="{{$r->data_link}}">
                            <img class="event_img" src='{{Storage::url($r->image)}}' width='100%;'> </a>
                    </div>
                    <div class='col-lg-9 d-flex justify-content-between flex-column'>
                        <div>
                            <a href="{{$r->data_link}}" class="event-title">
                                {{$r->title}}
                                {{--                                <span style='float:right;' class="country_tag">{{$r->country->name}}--}}
                                {{--                        <img style="object-fit: contain;max-width: 46px;margin-left: 10px" src="/img/egypt.svg">--}}
                                {{--                    </span>--}}
                            </a>
                            <p class="event-description">
                                {{$r->description}}
                            </p>
                        </div>
                        <div class="d-flex flex-row flex-wrap">
                            @foreach($r->tags as $tag)
                                <a class="tag" href="/search?tag={{$tag->name}}">
                                    {{$tag->name}}
                                </a>
                            @endforeach
                        </div>
                        <div class="d-flex pt-3 pt-lg-0" style="gap: 20px;
    justify-content: right;">
                            {{--                            @isset($r->file)--}}
                            {{--                                <a href="{{Storage::url($r->file)}}" target="_blank" class="d-flex">--}}
                            {{--                                    <img style="object-fit: contain;max-width: 29px;" src="/img/download.svg">--}}
                            {{--                                </a>--}}
                            {{--                            @endisset--}}
                            @if($r->ar_pdf)
                                <a class="download-btn" href="{{Storage::url($r->ar_pdf)}}" target="_blank"
                                   class="d-flex">
                                    <span>AR</span>
                                    <img style="object-fit: contain;max-width: 29px;" src="/img/download.svg">
                                </a>
                            @endif
                            @if($r->en_pdf)
                                <a class="download-btn" href="{{Storage::url($r->en_pdf)}}" target="_blank"
                                   class="d-flex">
                                    <span>EN</span>
                                    <img style="object-fit: contain;max-width: 29px;" src="/img/download.svg">
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <hr class="my-3">
            @endforeach
        </div>
    </div>
    <div class='col-lg-3 filter-container py-2'>
        <div class="d-flex justify-content-between">
            <h6>
                Filter by
            </h6>
        </div>

        <div>
            @if(count($authors)>0)
                <p class="filter-title">AUTHOR</p>
                <div class='filter'>
                    @foreach($authors as $author)
                        <div class="form-check">
                            <input class="form-check-input" wire:model.defer="selectedAuthorsIds" name='authors'
                                   type="checkbox"
                                   value='{{$author->id}}' id="{{ $author->name }}">
                            <label class="form-check-label" for="{{ $author->name }}">
                                {{ $author->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            @endif
            @if(count($fields) > 0)
                <p class="filter-title">FIELD</p>
                <div class='filter'>
                    @foreach($fields as $field)
                        <div class="form-check">
                            <input class="form-check-input" wire:model.defer="selectedFields" name='fields'
                                   type="checkbox"
                                   value='{{$field}}' id="{{ $field }}">
                            <label class="form-check-label" for="{{ $field }}">
                                {{ $field }}
                            </label>
                        </div>
                    @endforeach
                </div>
            @endif

            @if(count($subjects) > 0)
                <p class="filter-title">SUBJECT</p>
                <div class='filter'>
                    @foreach($subjects as $subject)
                        <div class="form-check">
                            <input class="form-check-input" wire:model.defer="selectedSubjects" name='subjects'
                                   type="checkbox"
                                   value='{{$subject}}' id="{{ $subject }}">
                            <label class="form-check-label" for="{{ $subject }}">
                                {{ $subject }}
                            </label>
                        </div>
                    @endforeach
                </div>
            @endif

            @if(count($projects) > 0)
                <p class="filter-title">PROJECT</p>
                <div class='filter'>
                    @foreach($projects as $project)
                        <div class="form-check">
                            <input class="form-check-input" wire:model.defer="selectedProjects" name='projects'
                                   type="checkbox"
                                   value='{{$project}}' id="{{ $project }}">
                            <label class="form-check-label" for="{{ $project }}">
                                {{ $project }}
                            </label>
                        </div>
                    @endforeach
                </div>
            @endif

            @if(count($publish_dates) > 0)
                <p class="filter-title">Year</p>
                <div class='filter'>
                    @foreach($publish_dates as $publish_date)
                        <div class="form-check">
                            <input class="form-check-input" wire:model.defer="selectedPublishDates" name='publish_dates'
                                   type="checkbox"
                                   value='{{$publish_date}}' id="{{ $publish_date }}">
                            <label class="form-check-label" for="{{ $publish_date }}">
                                {{ $publish_date }}
                            </label>
                        </div>
                    @endforeach
                </div>
            @endif
            @if(count($repo_types)>0)
                <p class="filter-title">TYPE</p>
                <div class='filter'>
                    @foreach($repo_types as $type)
                        <div class="form-check">
                            <input class="form-check-input" wire:model.defer="repo_type_ids" name='types'
                                   type="checkbox"
                                   value='{{$type->id}}' id="{{$type->name}}">
                            <label class="form-check-label" for="{{$type->name}}">
                                {{$type->name}}
                            </label>
                        </div>
                    @endforeach
                </div>
            @endif
            @if(count($allCountries)>0)
                <p class="filter-title">COUNTRY</p>
                <div class='filter'>
                    @foreach($allCountries as $country)
                        <div class="form-check">
                            <input class="form-check-input" wire:model.defer="selectedCountryIds" name='types'
                                   type="checkbox"
                                   value='{{$country->id}}' id="{{$country->name}}">
                            <label class="form-check-label" for="{{$country->name}}">
                                {{$country->name}}
                            </label>
                        </div>
                    @endforeach
                </div>
            @endif
            {{--            <p class="filter-title">TAGS</p>--}}
            {{--            <div class='filter'>--}}

            {{--                @foreach($repo_tags as $tag)--}}

            {{--                    <div class="form-check">--}}
            {{--                        <input class="form-check-input" wire:model.defer="tags" name='tags' type="checkbox"--}}
            {{--                               value='{{$tag->name}}' id="{{$tag->name}}">--}}
            {{--                        <label class="form-check-label" for="{{$tag->name}}">--}}
            {{--                            {{$tag->name}}--}}
            {{--                        </label>--}}
            {{--                    </div>--}}

            {{--                @endforeach--}}
            {{--            </div>--}}

            {{--            @if(count($repo_themes)>0)--}}
            {{--                <p class="filter-title">THEMES</p>--}}
            {{--                <div class='filter'>--}}
            {{--                    @foreach($repo_themes as $theme)--}}
            {{--                        <div class="form-check">--}}
            {{--                            <input class="form-check-input " wire:model.defer="repo_theme_ids" name='themes'--}}
            {{--                                   type="checkbox"--}}
            {{--                                   value='{{$theme->id}}' id="{{$theme->name}}">--}}
            {{--                            <label class="form-check-label" for="{{$theme->name}}">--}}
            {{--                                {{$theme->name}}--}}
            {{--                            </label>--}}
            {{--                        </div>--}}
            {{--                    @endforeach--}}
            {{--                </div>--}}
            {{--            @endif--}}
            <div class="m-lg-3 my-sm-2" style='float:right;'>
                <button class="btn login" style='background-color:transparent;border:0;box-shadow: none'
                        wire:click="clear">CLEAR
                </button>
                <button class="btn login" wire:click="filterUpdated()"><i class="fas fa-check"></i> Apply</button>
            </div>
        </div>
    </div>
</div>
