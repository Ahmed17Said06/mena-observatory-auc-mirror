<div class='col-12'>
    <div class='row' @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl" @endif>
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
                     
                            <img class="w-100" src='{{Storage::url($p->logo)}}'>
                    </div>
                </div>
                @php $counter++; @endphp
                @endforeach
                @if ($counter > 0)
                @endif
            </div>
        </div>
    </div>
