<div class="container mt-4">
    <div class='row'>
        <div class='col-lg-5 col-md-8 py-3'>
            <h3>Events</h3>
            <div class="d-none d-lg-flex">
                <div class="align-self-center" style="margin-right: 20px">
                    <span>VIEW AS</span>
                </div>
                <div class="event-switcher" wire:click="switchView">
                    <a class="list @if(!$isMonthView) active @endif">
                        LIST
                    </a>
                    <a class="month @if($isMonthView) active @endif">
                        Month
                    </a>
                </div>
            </div>
        </div>
        <div class='col-lg-7 col-md-4 d-flex justify-content-end align-items-center'>
            <div class="search-box">
                <form>
                    <input class="search" type="text" placeholder="Search Upcomming Events" wire:model="searchInput" name="events_keywords" wire:keyup="search" id='events_keywords'>
                    <button type="submit"><svg width="20" height="20" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_703_6664)">
                                <path d="M5.80292 11.413C2.62774 11.413 0 8.91304 0 5.76087C0 2.6087 2.62774 0 5.80292 0C8.9781 0 11.6058 2.6087 11.6058 5.76087C11.6058 8.91304 8.9781 11.413 5.80292 11.413ZM5.80292 1.08696C3.17518 1.08696 1.09489 3.15217 1.09489 5.76087C1.09489 8.36957 3.17518 10.4348 5.80292 10.4348C8.43066 10.4348 10.5109 8.36957 10.5109 5.76087C10.5109 3.15217 8.32117 1.08696 5.80292 1.08696Z" fill="#FAAF1C"/>
                                <path d="M9.68313 8.99118L8.90894 9.75977L14.2509 15.063L15.0251 14.2944L9.68313 8.99118Z" fill="#FAAF1C"/>
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
            <div class="col-3 justify-content-end d-flex align-items-center">
                <div style="margin: 0px 15px">
                    <div class="dropdown">
{{--                        <a class="dropbtn">--}}
{{--                            <img src="/img/sort-icon.svg">--}}
{{--                            <span class="d-none d-lg-inline" style="font-size: 14px;color: #2E2E2E;font-weight: bold;margin-left: 10px">--}}
{{--                            SORT BY--}}
{{--                        </span>--}}
{{--                        </a>--}}
                        <div class="dropdown-content">
                            <a class="active">Newest</a>
                            <a>Oldest</a>
                            <a>Alphabetical (A -> Z)</a>
                            <a>Alphabetical (Z -> A</a>
                        </div>
                        <script>
                            $(document).ready(function() {
                                $(".dropbtn").click(function(event) {
                                    event.stopPropagation(); // Prevent click event from propagating to document
                                    $(".dropdown-content").show();
                                });

                                $(".dropdown-content").click(function(event) {
                                    event.stopPropagation(); // Prevent click event from propagating to document
                                });

                                $(document).click(function(event) {
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
        <div class='col-md-12' @if($isMonthView) style="display: none" @endif>
            <x-frontend.events_list :events="$events"></x-frontend.events_list>
            @if ($hasMorePages)
                <div class="d-flex justify-content-center mt-4">
                    <button
                        class="px-4 py-3 btn btn-mena-2"
                        wire:click="loadPosts"
                    >
                        Load More
                    </button>
                </div>
            @endif
        </div>
    </div>
    <div @if(!$isMonthView) style="display: none" @endif>
        <div class="calendar-container d-flex flex-lg-row flex-column my-5" >
            @if($eventDetails)

                <div id="event-details" class="col-lg-3">
                    <div>
                        <p class="event_year">{{ $eventDetails->start_date->format('Y') }}</p>
                        <div class="d-flex justify-content-between position-relative">
                            <p class="event_date">{{ $eventDetails->start_date->format('M') }}
                                <br class="d-none d-lg-block">
                                {{ $eventDetails->start_date->format('d') }}
                            </p>
                            <div class="vl"></div>
                            <p class="event_date">{{ $eventDetails->end_date->format('M') }}
                                <br class="d-none d-lg-block">
                                {{ $eventDetails->end_date->format('d') }}
                            </p>
                        </div>
                        <p class="event-date">@ {{ $eventDetails->start_date->format('h:i') }} - {{ $eventDetails->end_date->format('h:i') }}</p>

                        <p class="event-title">{{ $eventDetails->title }}</p>
                        <p class="event-description">{{ $eventDetails->description }}</p>
                    </div>
                    <div class="d-flex">
                        <a class="notify_me btn" target="_blank"  href="http://www.google.com/calendar/event?action=TEMPLATE&text={{urlencode($eventDetails->title)}}&dates={{str_replace(' ', '', date('Y m d \T h m s Z', strtotime($eventDetails->start_date)))}}/{{str_replace(' ', '', date('Y m d \T h m s Z', strtotime($eventDetails->end_date)))}}&details={{urlencode($eventDetails->description)}}&location={{urlencode($eventDetails->gmaps_url)}}"><i class="fa fa-bell"></i></a>
                        <livewire:save-event :eventId="$eventDetails->id"  :wire:key="'data1'.$eventDetails->id"/>

                    </div>
                </div>
            @endif
            <div   class="col">
                <div wire:ignore  id="calendar"></div>
                <div class="d-flex gap-4" style="padding: 20px;float: right;">
                    <span class="event_attendance online">Online</span>
                    <span class="event_attendance hybrid">Hybrid</span>
                    <span class="event_attendance in-person">In Person</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        document.addEventListener('livewire:load', () => {
            let calendarEl = document.getElementById('calendar');
            let calendar = new FullCalendar.Calendar(calendarEl, {
                rerenderDelay:200,
                handleWindowResize:true,
                initialView: 'dayGridMonth',
                fixedWeekCount: true,
                headerToolbar:{

                    start: '', // will normally be on the left. if RTL, will be on the right
                    center: 'prev title,next',
                    end: '' // will normally be on the right. if RTL, will be on the left
                },
                events: {!! $calendarEvents->map(function ($event) {
    return [
        'id' => $event->id,
        'title' => $event->title,
        'start' => $event->start_date->toDateTimeString(),
        'end' => $event->end_date->toDateTimeString(),
        'classNames' => $event->type,
         'allDay' => false

    ];
})->toJson() !!},
                eventContent: function (info) {
                    let eventEl = document.createElement('div');
                    eventEl.classList.add('w-100', 'px-2');
                    console.log(info)
                    type = (info.event.classNames == "Online")?  '<span class="event_attendance online"/>':
                        (info.event.classNames == "Hybrid")?  '<span class="event_attendance hybrid"/>':'<span class="event_attendance in-person"/>'
                    eventEl.innerHTML = `<div class="event-title"><span>${info.event.title}</span>`+type+`</div>`;
                    return { domNodes: [eventEl] };
                },
                eventClick: function (info) {
                    Livewire.emit('showEventDetails', info.event.id);

                },

            });
            window.addEventListener('calendarUpdated', () =>  {
                // setTimeout(function ()
                // {
                //     calendar.updateSize()
                //
                //
                // }, 200)

            })
            window.addEventListener('eventsUpdated', (events) =>  {
                    calendar.removeAllEvents();
                    console.log(events)

                events.detail.forEach(event => {
                        calendar.addEvent({
                            id: event.id,
                            title: event.title,
                            start: event.start_date,
                            end: event.end_date,
                            classNames: event.type,
                            allDay: false

                });
                    });

            })
            calendar.render();
        });
    </script>
    <script>

    </script>

@endpush
