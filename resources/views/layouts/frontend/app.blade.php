<!DOCTYPE html>
<html @if(LaravelLocalization::getCurrentLocale() === 'ar') lang="ar" @endif>
<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="76x76" href="/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/img/favicon.png">
    <title>
        MENA AI OBSERVATORY
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />    <link id="pagestyle" href="/assets/css/argon-dashboard.css" rel="stylesheet" />
    <link id="pagestyle" href="/assets/css/main.css?v=<?php echo rand();?>" rel="stylesheet" />

<link href="https://fonts.cdnfonts.com/css/montserrat" rel="stylesheet">

<link href="https://fonts.cdnfonts.com/css/gotham" rel="stylesheet">
    <script src="/assets/js/simplemap/mapdata.js?v=<?php echo rand();?>"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.7.2/main.css">


    <script src="/assets/js/simplemap/worldmap.js"></script>
 <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    @stack('header')

    @livewireStyles
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
{{--        <script defer>--}}
{{--            document.addEventListener('DOMContentLoaded', function () {--}}
{{--                function runAnimation() {--}}
{{--                    const selectorsToAnimate = [--}}
{{--                        'span', 'form', 'ul', 'img:not(.post-img)', '.position-relative.overflow-hidden',--}}
{{--                        '.post-container', 'p', 'a', 'h1', 'h3', 'h4', 'button'--}}
{{--                    ];--}}

{{--                    const elements = document.querySelectorAll(--}}
{{--                        selectorsToAnimate.map(selector => `${selector}:not(header *):not(footer *):not(.map_container *):not(.dropdown-content *):not(dialog *):not(#map *):not(.search-box *)`).join(', ')--}}
{{--                    );--}}

{{--                    const observer = new IntersectionObserver(entries => {--}}
{{--                        entries.forEach(entry => {--}}
{{--                            if (entry.isIntersecting) {--}}
{{--                                entry.target.classList.add('FadeInUp');--}}
{{--                            }--}}
{{--                        });--}}
{{--                    });--}}

{{--                    elements.forEach(element => {--}}
{{--                        observer.observe(element);--}}
{{--                    });--}}
{{--                }--}}

{{--                runAnimation(); // Run the animation on initial page load--}}

{{--                // Assuming pagination links have class "page-link"--}}
{{--                const paginationLinks = document.querySelectorAll('.pagination a.page-link');--}}
{{--                paginationLinks.forEach(link => {--}}
{{--                    link.addEventListener('click', function (event) {--}}
{{--                        event.preventDefault();--}}

{{--                        // Perform pagination logic here--}}

{{--                        // After pagination, rerun the animation after 300ms--}}
{{--                        setTimeout(runAnimation, 500);--}}
{{--                    });--}}
{{--                });--}}

{{--                // Assuming all buttons have class "custom-button"--}}
{{--                const buttons = document.querySelectorAll('button.btn');--}}
{{--                buttons.forEach(button => {--}}
{{--                    button.addEventListener('click', function () {--}}
{{--                        // Perform button logic here--}}

{{--                        // After button press, rerun the animation after 300ms--}}
{{--                        setTimeout(runAnimation, 300);--}}
{{--                    });--}}
{{--                });--}}
{{--            });--}}
{{--        </script>--}}
    <script defer>
        document.addEventListener('DOMContentLoaded', function () {
            function runAnimation() {
                const selectorsToAnimate = [
                    'span', 'form', 'ul', 'img:not(.post-img)', '.position-relative.overflow-hidden',
                    '.post-container', 'p', 'a', 'h1', 'h3', 'h4', 'button'
                ];

                const elements = document.querySelectorAll(
                    selectorsToAnimate.map(selector => `${selector}:not(header *):not(footer *):not(.map_container *):not(.dropdown-content *):not(dialog *):not(#map *):not(.search-box *):not(.slide_description):not(#repos *):not(.btn-mena-4):not(.filter-container):not(#blogs *)`).join(', ')
                );

                const observer = new IntersectionObserver(entries => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('FadeInUp');
                        }
                    });
                });

                elements.forEach(element => {
                    observer.observe(element);
                });
            }

            runAnimation(); // Run the animation on initial page load

            function addStaticHTML() {
                // Add your static HTML content with the specified styles
                const staticHTML = `
                <style>
span:not(header *):not(footer *):not(.map_container *):not(.dropdown-content *):not(dialog *):not(#map *):not(#subscribe-popup *):not(#repos *):not(.filter-container):not(#blogs *):not(.slide_title):not(.slide_description):not(.subs *),
form:not(header *):not(footer *):not(.map_container *):not(.dropdown-content *):not(dialog *):not(#map *):not(#subscribe-popup *):not(#repos *):not(.filter-container):not(#blogs *):not(.subs *),
ul:not(header *):not(footer *):not(.map_container *):not(.dropdown-content *):not(dialog *):not(#map *):not(#subscribe-popup *):not(#repos *):not(.filter-container):not(#blogs *):not(.subs *),
img:not(header *):not(footer *):not(.map_container *):not(.dropdown-content *):not(dialog *):not(.post-img):not(#map *):not(#subscribe-popup *):not(#repos *):not(.filter-container):not(#blogs *):not(.subs *),
.position-relative.overflow-hidden:not(header *):not(footer *):not(.map_container *):not(.dropdown-content *):not(dialog *):not(#map *):not(#subscribe-popup *):not(#repos *):not(.filter-container):not(#blogs *)
.post-container:not(header *):not(footer *):not(.map_container *):not(.dropdown-content *):not(dialog *):not(#map *):not(#subscribe-popup *):not(#repos *):not(.filter-container):not(#blogs *),
p:not(header *):not(footer *):not(.map_container *):not(.dropdown-content *):not(dialog *):not(#map *):not(#subscribe-popup *):not(.slide_description):not(#repos *):not(.filter-container):not(#blogs *):not(.subs *),
a:not(header *):not(footer *):not(.map_container *):not(.dropdown-content *):not(dialog *):not(#map *):not(#subscribe-popup *):not(#repos *):not(.filter-container):not(#blogs *):not(.subs *),
h1:not(header *):not(footer *):not(.map_container *):not(.dropdown-content *):not(dialog *):not(#map *):not(#subscribe-popup *):not(#repos *):not(.filter-container):not(#blogs *):not(.subs *),
h3:not(header *):not(footer *):not(.map_container *):not(.dropdown-content *):not(dialog *):not(#map *):not(#subscribe-popup *):not(#repos *):not(.filter-container):not(#blogs *):not(.subs *),
h4:not(header *):not(footer *):not(.map_container *):not(.dropdown-content *):not(dialog *):not(#map *):not(#subscribe-popup *):not(#repos *):not(.filter-container):not(#blogs *):not(.subs *),
button:not(header *):not(footer *):not(.map_container *):not(.dropdown-content *):not(dialog *):not(#map *):not(.search-box *):not(#subscribe-popup *):not(#repos *):not(.btn-mena-4):not(.filter-container):not(#blogs *):not(.subs *){
    opacity: 1!important;
    transform: translateY(0px)!important;
    transition: background 0.3s, color 0.3s, opacity 0.5s ease-in-out, transform 0.5s ease-in-out;
    color: #333333!important;
}
                </style>
            `;

                // Insert the static HTML after the <body> tag
                document.body.insertAdjacentHTML('beforeend', staticHTML);
            }

            function setupListeners() {
                // Assuming pagination links have class "page-link"
                const paginationLinks = document.querySelectorAll('.pagination li a, .pagination li a i');
                paginationLinks.forEach(link => {
                    link.addEventListener('click', function (event) {
                        event.preventDefault();

                        // Perform pagination logic here

                        // After pagination, run the animation and add static HTML after 300ms
                        setTimeout(function () {
                            addStaticHTML();
                            runAnimation();
                        }, 500);
                    });
                });

                // Assuming all buttons have class "custom-button"
                const buttons = document.querySelectorAll('button.btn');
                buttons.forEach(button => {
                    button.addEventListener('click', function () {
                        // Perform button logic here

                        // After button press, run the animation and add static HTML after 300ms
                        setTimeout(function () {
                            addStaticHTML();
                            runAnimation();
                        }, 300);
                    });
                });

                // Assuming all buttons have class "custom-button"
                const buttonss = document.querySelectorAll('button[type="submit"]');
                buttonss.forEach(button => {
                    button.addEventListener('click', function () {
                        // Perform button logic here

                        // After button press, run the animation and add static HTML after 300ms
                        setTimeout(function () {
                            addStaticHTML();
                            setupListeners(); // Re-run setupListeners
                            runAnimation();
                        }, 1000);
                    });
                });

            }

            // Run setupListeners initially
            setupListeners();

            // ... (your existing code)

        });
    </script>

    <script defer src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body class="">


<livewire:subscribe-form wire:key='subscribe'/>


    @yield('content')
    <!--   Core JS Files   -->
    <script src="/assets/js/core/popper.min.js"></script>
    <script src="/assets/js/core/bootstrap.min.js"></script>
    <script src="/assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="/assets/js/plugins/smooth-scrollbar.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.6/index.global.min.js'></script>


        @livewireScripts
        @stack('scripts')

        @stack('js')
<script>
    window.addEventListener('alert', event => {
        toastr[event.detail.type](event.detail.message,
            event.detail.title ?? ''), toastr.options = {
            "closeButton": true,
            "progressBar": true,
        }
    });
</script>

</body>

</html>
