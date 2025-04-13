<div class='col-12'>
    <div class='row' @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl" @endif>
        <div class="col-9">
            <div class="search-box event">
                <form>
                    <input class="search" type="text" placeholder="@lang('translation.search-posts')"
                           name="blogs_keywords" wire:keyup="updateSearch" wire:model="search" id='blogs_keywords'>
                    <button type="submit">
                        <svg width="20" height="20" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_703_6664)">
                                <path
                                    d="M5.80292 11.413C2.62774 11.413 0 8.91304 0 5.76087C0 2.6087 2.62774 0 5.80292 0C8.9781 0 11.6058 2.6087 11.6058 5.76087C11.6058 8.91304 8.9781 11.413 5.80292 11.413ZM5.80292 1.08696C3.17518 1.08696 1.09489 3.15217 1.09489 5.76087C1.09489 8.36957 3.17518 10.4348 5.80292 10.4348C8.43066 10.4348 10.5109 8.36957 10.5109 5.76087C10.5109 3.15217 8.32117 1.08696 5.80292 1.08696Z"
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
                </form>
            </div>
        </div>
        <div class="col-3 justify-content-end d-flex align-items-center">
            <div style="margin: 0px 15px">
                <div class="dropdown">
                    {{--                        <div class="dropbtn">--}}
                    {{--                            <img src="/img/sort-icon.svg">--}}
                    {{--                            <span class="d-none d-lg-inline" style="font-size: 14px;color: #2E2E2E;font-weight: bold;margin-left: 10px">--}}
                    {{--                            SORT BY--}}
                    {{--                        </span>--}}
                    {{--                        </div>--}}
                    <div class="dropdown-content">
                        <a class="active">Newest</a>
                        <a>Oldest</a>
                        <a>Alphabetical (A -> Z)</a>
                        <a>Alphabetical (Z -> A</a>
                    </div>
                    <script>
                        $(document).ready(function () {
                            $(".dropbtn").click(function (event) {
                                event.stopPropagation(); // Prevent click event from propagating to document
                                $(".dropdown-content").show();
                            });

                            $(".dropdown-content").click(function (event) {
                                event.stopPropagation(); // Prevent click event from propagating to document
                            });

                            $(document).click(function (event) {
                                if (!$(event.target).closest(".dropdown-content").length && !$(event.target).is(".dropbtn")) {
                                    $(".dropdown-content").hide();
                                }
                            });
                        });
                    </script>
                </div>
            </div>

            <dialog id="filters-popup">
                <div class="popup-header">
                    <h3>Filters</h3>
                    <a id="closebtn" class="closebtn">×</a>
                </div>
                <div class="popup-content mb-3">
                    <div class="d-flex justify-content-between">
                        <h6>Applied filters</h6>
                        <p class="clear-filter">Clear all</p>
                    </div>
                    <div class="d-flex flex-wrap" style="gap: 10px;flex-shrink: 0;">
                        <a class="filter-option active">
                            Science
                            <i>x</i>
                        </a>
                        <a class="filter-option">
                            Science
                            <i>+</i>
                        </a>
                        <a class="filter-option">
                            Science
                            <i>+</i>
                        </a>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <h6>Date</h6>
                    </div>
                    <div class="d-flex flex-wrap" style="gap: 10px;flex-shrink: 0;">
                        <input type="date" class="start-date">
                        <input type="date" class="end-date">
                    </div>
                    {{--                                    <div class="d-flex justify-content-between mt-3">--}}
                    {{--                                        <h6>Category</h6>--}}
                    {{--                                    </div>--}}
                    {{--                                    <div class="d-flex flex-wrap" style="gap: 10px;flex-shrink: 0;">--}}
                    {{--                                        <a class="filter-option active">--}}
                    {{--                                            Science--}}
                    {{--                                            <i>x</i>--}}
                    {{--                                        </a>--}}
                    {{--                                        <a class="filter-option">--}}
                    {{--                                            Science--}}
                    {{--                                            <i>+</i>--}}
                    {{--                                        </a>--}}
                    {{--                                        <a class="filter-option">--}}
                    {{--                                            Science--}}
                    {{--                                            <i>+</i>--}}
                    {{--                                        </a>--}}
                    {{--                                    </div>--}}
                    <div class="d-flex justify-content-between mt-3">
                        <h6>Country</h6>
                    </div>
                    <div class="d-flex" style="gap: 10px;flex-shrink: 0;">
                        <select class="form-select" aria-label="Any">
                            <option selected>Any</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>
                <button class="btn btn-mena-2">Apply</button>
            </dialog>
            {{--                <a id="showDialog" style="cursor: pointer">--}}
            {{--                    <img src="/img/filter-icon.svg">--}}
            {{--                </a>--}}
            <script>
                (() => {
                    const updateButton = document.getElementById("showDialog");
                    const closeButton = document.getElementById("closebtn");
                    const dialog = document.getElementById("filters-popup");

                    // Update button opens a modal dialog
                    updateButton.addEventListener("click", () => {
                        dialog.showModal();
                        openCheck(dialog);
                    });

                    // Form close button closes the dialog box
                    closeButton.addEventListener("click", () => {
                        dialog.close();
                    });
                })();
            </script>
        </div>
    </div>
    <div id="blogs">
    <div class="row g-4" style="padding-bottom: 50px;">
        @foreach($blogs as $n)
            <div class="col-12 col-md-6 col-lg-4 d-flex">
                <div class="post-container w-100">
                    <div class="post-loop-community position-relative overflow-hidden h-100">
                        <img class="post-img w-100" src="{{ Storage::url($n->thumbnail_image) }}">
                        <div class="post-content" lang="en">
                            <h4 style="color:#FFF;" class="slide_title">
                                <a href="{{ route('community_single', ['id' => $n->id]) }}">{{ $n->name }}</a>
                            </h4>
                            <p style="color:#FFF;" class="slide_description">{{ $n->description }}</p>

                            <a href="{{ route('community_single', ['id' => $n->id]) }}">
                                <button class="btn learn_more"><i class="fas fa-plus"></i> Learn More</button>
                            </a>
                        </div>
                        <div class="overlay-1"></div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

        <div class='row' style='overflow-x: scroll; padding-bottom: 80px; padding-top: 40px;'>
            <h3 hreflang="{{ getLang() }}">@lang('translation.collaborators')</h3>
            <div class="d-flex flex-wrap align-items-center partners-imgs justify-content-center">
                <div class="row w-100">
                    @php $counter = 0; @endphp
                    @foreach ($partners as $p)
                        @if ($counter % 4 == 0)
                            @if ($counter > 0)
                </div>
                @endif
                @endif
                <div class="col-12 col-lg-3">
                    <div class="square-holder">
                        <a href='{{$p->url}}'>
                            <img src='{{Storage::url($p->logo)}}'></a>
                    </div>
                </div>
                @php $counter++; @endphp
                @endforeach
                @if ($counter > 0)
                @endif
            </div>
        </div>
    </div>
