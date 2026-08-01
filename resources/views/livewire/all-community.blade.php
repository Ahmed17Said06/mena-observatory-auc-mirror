<style>
    /* Community people — circular profile card layout */
    #blogs .row.g-4 {
        justify-content: center;
        row-gap: 2.5rem !important;
    }
    .community-person-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 0 0.5rem;
    }
    .community-circle {
        width: 180px;
        height: 180px;
        border-radius: 50%;
        overflow: hidden;
        margin-bottom: 1rem;
        flex-shrink: 0;
    }
    .community-circle img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: top center;
        display: block;
    }
    .community-name {
        font-size: 1rem;
        font-weight: 700;
        color: #022248;
        margin-bottom: 0.4rem;
    }
    .community-name a {
        color: #022248;
        text-decoration: underline;
    }
    .community-name a:hover {
        color: #c8870a;
    }
    .community-desc {
        font-size: 0.82rem;
        color: #555;
        line-height: 1.55;
        margin: 0;
        display: -webkit-box;
        -webkit-line-clamp: 4;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* ── A–Z jump rail ─────────────────────────────────── */
    html { scroll-behavior: smooth; }
    .comm-az-wrap {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
    }
    .comm-people { flex: 1 1 auto; min-width: 0; padding-bottom: 50px; }
    .comm-letter-head {
        font-size: 1.4rem;
        font-weight: 800;
        color: #022248;
        border-bottom: 2px solid #FAAF1C;
        display: inline-block;
        padding: 0 .35rem .15rem;
        margin: 1.5rem 0 1rem;
        scroll-margin-top: 90px;
    }
    .comm-people .comm-letter-head:first-child { margin-top: 0; }
    .comm-az-rail {
        position: sticky;
        top: 90px;
        flex: 0 0 auto;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1px;
        padding: .35rem .15rem;
        background: #fff;
        border: 1px solid #eef0f3;
        border-radius: 999px;
        max-height: calc(100vh - 120px);
        overflow-y: auto;
    }
    .comm-az-rail a,
    .comm-az-rail span {
        font-size: .72rem;
        font-weight: 700;
        line-height: 1;
        width: 22px;
        height: 22px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        text-decoration: none;
    }
    .comm-az-rail a {
        color: #022248;
        transition: background .15s, color .15s;
    }
    .comm-az-rail a:hover {
        background: #FAAF1C;
        color: #022248;
    }
    .comm-az-rail span {
        color: #c7cbd1;
        cursor: default;
    }
    @media (max-width: 575px) {
        .comm-az-rail {
            flex-direction: row;
            flex-wrap: wrap;
            position: static;
            border-radius: 12px;
            max-height: none;
            order: -1;
            width: 100%;
            justify-content: center;
        }
        .comm-az-wrap { flex-direction: column; }
    }
</style>

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
                    if (updateButton && dialog) {
                        updateButton.addEventListener("click", () => {
                            dialog.showModal();
                        });
                    }

                    // Form close button closes the dialog box
                    if (closeButton && dialog) {
                        closeButton.addEventListener("click", () => {
                            dialog.close();
                        });
                    }
                })();
            </script>
        </div>
    </div>
    @php
        $grouped = $blogs->groupBy(function ($p) {
            $c = mb_strtoupper(mb_substr(trim($p->name), 0, 1));
            return preg_match('/[A-Z]/', $c) ? $c : '#';
        });
        $letters = collect(range('A', 'Z'))->push('#');
    @endphp

    <div class="comm-az-wrap">
        <div id="blogs" class="comm-people">
            @foreach($letters as $L)
                @if($grouped->has($L))
                    <div id="ltr-{{ $L }}" class="comm-letter-head">{{ $L }}</div>
                    <div class="row g-4 mb-4">
                        @foreach($grouped[$L] as $n)
                            <div class="col-6 col-md-4 col-lg-3">
                                @php
                                    $thumbSrc = !$n->thumbnail_image
                                        ? '/img/card-placeholder.svg'
                                        : (\Illuminate\Support\Str::startsWith($n->thumbnail_image, ['http://', 'https://'])
                                            ? $n->thumbnail_image
                                            : Storage::url($n->thumbnail_image));
                                    // Show approved Arabic name/bio in AR locale; fall back to English.
                                    $isAr = getLang() === 'ar';
                                    $displayName = $isAr && $n->name_ar ? $n->name_ar : $n->name;
                                    $displayDesc = $isAr && $n->description_ar ? $n->description_ar : $n->description;
                                @endphp
                                <div class="community-person-card">
                                    <a href="{{ route('community_single', ['id' => $n->id]) }}" class="community-circle">
                                        <img src="{{ $thumbSrc }}" alt="{{ $displayName }}">
                                    </a>
                                    <h4 class="community-name">
                                        <a href="{{ route('community_single', ['id' => $n->id]) }}">{{ $displayName }}</a>
                                    </h4>
                                    <p class="community-desc" @if($isAr && $n->description_ar) dir="rtl" @endif>{{ $displayDesc }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @endforeach
        </div>

        <nav class="comm-az-rail" aria-label="A to Z">
            @foreach($letters as $L)
                @if($grouped->has($L))
                    <a href="#ltr-{{ $L }}">{{ $L }}</a>
                @else
                    <span aria-disabled="true">{{ $L }}</span>
                @endif
            @endforeach
        </nav>
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
                     
                            <img class="w-100" src='{{ $p->logo ? Storage::url($p->logo) : '/img/card-placeholder.svg' }}' alt="{{ $p->name }}" onerror="this.onerror=null;this.src='/img/card-placeholder.svg'">
                    </div>
                </div>
                @php $counter++; @endphp
                @endforeach
                @if ($counter > 0)
                @endif
            </div>
        </div>
    </div>
