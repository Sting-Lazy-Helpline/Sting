<!DOCTYPE html>
<html lang="en" data-bs-theme-mode="light">
<!-- <html lang="en"> -->
<!--begin::Head-->

<head>
    <title>Do It Visa - Web Application</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('theme/assets/media/logos/logom3.jpg')}}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ asset('theme/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/assets/plugins/custom/jkanban/jkanban.bundle.css')}}" rel="stylesheet" type="text/css" />
    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }
    </script>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_app_body" data-kt-app-layout="light-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
    <!--begin::Theme mode setup on page load-->
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }

        // Function to toggle sidebar minimize attribute and add/remove "active" class through custom conditions
        function toggleSidebarMinimize() {
            var currentUrl = window.location.href;
            var segments = currentUrl.split('/');
            var lastSegment = segments[segments.length - 1];
            const body = document.getElementById('kt_app_body');
            const sidebarMinimized = window.matchMedia("(max-width: 1200px)").matches;
            const sidebarToggle = document.getElementById('kt_app_sidebar_toggle');

            if (sidebarMinimized || lastSegment == "properties_list.php") {
                body.setAttribute('data-kt-app-sidebar-minimize', 'on');
                sidebarToggle.classList.add('active');
            } else {
                body.setAttribute('data-kt-app-sidebar-minimize', 'off');
                sidebarToggle.classList.remove('active');
            }
        }

        // Call the function on page load and window resize
        window.addEventListener('load', toggleSidebarMinimize);
        window.addEventListener('resize', toggleSidebarMinimize);
    </script>
    <!--end::Theme mode setup on page load-->
    <!--begin::App-->
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Page-->
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            <!--begin::Header-->
            <div id="kt_app_header" class="app-header" data-kt-sticky="true" data-kt-sticky-activate="{default: true, lg: true}" data-kt-sticky-name="app-header-minimize" data-kt-sticky-offset="{default: '200px', lg: '0'}" data-kt-sticky-animation="false">
                <!--begin::Header container-->
                <div class="app-container container-fluid d-flex align-items-stretch justify-content-between" id="kt_app_header_container">
                    <!--begin::Sidebar mobile toggle-->
                    <div class="d-flex align-items-center d-lg-none ms-n3 me-1 me-md-2" title="Show sidebar menu">
                        <div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_sidebar_mobile_toggle">
                            <i class="ki-duotone ki-abstract-14 fs-2 fs-md-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                    </div>
                    <!--end::Sidebar mobile toggle-->
                    <!--begin::Mobile logo-->
                    <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                        <a href="{{ route('dashboard') }}" class="d-lg-none">
                            <!-- Show for light mode only -->
                            <img alt="Logo" src="{{ asset('theme/assets/media/logos/logom3.jpg')}}" class="theme-light-show h-30px" />
                            <!-- Show for dark mode light-->
                            <img alt="Logo" src="{{ asset('theme/assets/media/logos/logom3.jpg')}}" class="theme-dark-show h-30px" />
                        </a>
                    </div>
                    <!--end::Mobile logo-->
                    <!--begin::Header wrapper-->
                    <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-0" id="kt_app_header_wrapper">
                        <!--begin::Navbar-->
                        <div class="app-navbar flex-shrink-0">
                            <!--begin::User menu-->
                            <div class="app-navbar-item ms-1 ms-md-4" id="kt_header_user_menu_toggle">
                                <!--begin::Menu wrapper-->
                                <div class="cursor-pointer symbol symbol-35px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                                    <img src="{{ asset(Auth::user()->profile_picture) }}" class="rounded-3" alt="user" />
                                </div>
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-auto" data-kt-menu="true">
                                    <div class="menu-item px-3">
                                        <div class="menu-content d-flex align-items-center px-3">
                                            <div class="symbol symbol-50px me-5">
                                                <img alt="User Image" src="{{ asset(Auth::user()->profile_picture) }}" />
                                            </div>
                                            <div class="d-flex flex-column">
                                                <div class="fw-bold d-flex align-items-center fs-5">{{ Auth::user()->name }}
                                                    <span class="badge badge-light-primary fw-bold fs-8 px-2 py-1 ms-2">{{ Auth::user()->roles->first()->display_name }}</span>
                                                </div>
                                                <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">{{Auth::user()->email}}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="separator my-2"></div>
                                    <div class="menu-item px-5 my-1">
                                        <a href="{{ route('settings.create') }}" class="menu-link px-5">Account
                                            Settings</a>
                                    </div>
                                    <div class="menu-item px-5">
                                        <a href="{{ route('logout') }}" class="menu-link px-5">Sign Out</a>
                                    </div>
                                </div>
                                <!--end::Menu wrapper-->
                            </div>
                            <!--end::User menu-->
                            <!--end::Header menu toggle-->
                        </div>
                        <!--end::Navbar-->
                    </div>
                    <!--end::Header wrapper-->
                </div>
                <!--end::Header container-->
            </div>
            @include('layouts.navigation')
            @include('layouts.modal')
            <div class="app-main flex-column flex-row-fluid mt-lg-0 mt-7" id="kt_app_main">
                {{ $slot }}
            </div>
        <!--end:::Main-->
        </div>
        <!--end::Wrapper-->
        </div>
        <!--end::Page-->
        </div>
        <!--end::App-->
        
        <!--begin::Scrolltop-->
        <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
            <i class="ki-duotone ki-arrow-up">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>
        <!--end::Scrolltop-->
        
        <!--begin::Javascript-->
        <script>
            var hostUrl = "assets/";
        </script>
        <script src="{{ asset('theme/assets/plugins/global/plugins.bundle.js')}}"></script>
        <script src="{{ asset('theme/assets/js/scripts.bundle.js')}}"></script>
        <script src="{{ asset('theme/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
        <script src="{{ asset('theme/assets/plugins/custom/fslightbox/fslightbox.bundle.js')}}"></script>
        <script src="{{ asset('theme/assets/js/widgets.bundle.js')}}"></script>
        <script src="{{ asset('theme/assets/js/custom/widgets.js')}}"></script>
        <script src="{{ asset('theme/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script>
        <script src="{{ asset('theme/assets/js/custom/apps/calendar/calendar.js')}}"></script>
        <script src="{{ asset('theme/assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js')}}"></script>
        <script src="{{ asset('theme/assets/plugins/custom/draggable/draggable.bundle.js')}}"></script>
        <script src="{{ asset('theme/assets/plugins/custom/jkanban/jkanban.bundle.js')}}"></script>
        <script src="{{ asset('theme/assets/plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>
        <script src="{{ asset('theme/custom/main.js')}}"></script>

        
        <!--end::Javascript-->
        
        <!--begin::Custom Javascript-->
        <script>
            $(document).ready(function() {
                let maxRepeaterCount = 3; // Set the maximum number of repeaters
                let repeaterContainer = $('.kt_docs_repeater_basic');
        
                // Initialize the repeater
                repeaterContainer.repeater({
                    initEmpty: false,
        
                    defaultValues: {
                        'text-input': 'foo'
                    },
        
                    show: function() {
                        $(this).slideDown();
        
                        // Check if the limit is reached
                        let repeaterCount = repeaterContainer.find('[data-repeater-item]').length;
                        if (repeaterCount >= maxRepeaterCount) {
                            repeaterContainer.find('[data-repeater-create]').hide();
                        }
                    },
        
                    hide: function(deleteElement) {
                        $(this).slideUp(function() {
                            $(this).remove(); // Remove the element completely after animation
        
                            // Re-check the number of items
                            let repeaterCount = repeaterContainer.find('[data-repeater-item]').length;
                            if (repeaterCount < maxRepeaterCount) {
                                repeaterContainer.find('[data-repeater-create]').show();
                            }
                        });
                    }
                });
        
                // Initial check to hide add button if limit is already reached
                let initialRepeaterCount = repeaterContainer.find('[data-repeater-item]').length;
                if (initialRepeaterCount >= maxRepeaterCount) {
                    repeaterContainer.find('[data-repeater-create]').hide();
                }
            });
        
        
            $(document).ready(function() {
                // Date and Time Picker
                // -- Date Picker
                $(".kt_datepicker_2").flatpickr();
        
                // -- Date & Time Picker
                $(".kt_datepicker_3").flatpickr({
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                });
        
                // -- Time Picker
                $(".kt_datepicker_8").flatpickr({
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i",
                });
                // $(".kt_datatable_example_2").DataTable();
                // Datatables
                var table = $('.kt_datatable_example_1').DataTable({
                    // order: [],
                    // "scrollY": "500px",
                    info: !1,
                    "aaSorting": [],
                    pageLength: 10,
                    lengthChange: !1,
                    columnDefs: [
                        // {
                        //     orderable: !1,
                        //     targets: 0
                        // },
                        {
                            orderable: !1,
                            targets: -1
                        },
                    ],
                });
                var table2 = $('.kt_datatable_example_2').DataTable({
                    info: !1,
                    "aaSorting": [],
                    pageLength: 10,
                    lengthChange: !1,
                    columnDefs: [{
                            orderable: !1,
                            targets: 0
                        },
                        // {
                        //     orderable: !1,
                        //     targets: -1
                        // },
                    ],
                });
                $('.search').on('keyup', function() {
                    table.search(this.value).draw();
                    table2.search(this.value).draw();
                });
        
                // Quill Summernote
                var quill = new Quill('.kt_docs_quill_basic', {
                    modules: {
                        toolbar: [
                            [{
                                header: [1, 2, false]
                            }],
                            ['bold', 'italic', 'underline', 'link'],
                            ['image', 'code-block']
                        ]
                    },
                    placeholder: 'Type your text here...',
                    theme: 'snow' // or 'bubble'
                });
        
                // TinyMCE
                tinymce.init({
                    selector: "#default",
                    menubar: false,
                    toolbar: ["styleselect fontselect fontsizeselect", "table tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol",
                        "undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify",
                        "bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code"
                    ],
                    plugins: "table advlist autolink link image lists charmap print preview code"
                });
        
        
                // Tagify
                var input2 = document.querySelector(".kt_tagify_2");
                new Tagify(input2);
            });
        
            // CK Editor
            ClassicEditor
                .create(document.querySelector('#ckeditor_classic'))
                .then(editor => {
                    console.log(editor);
                })
                .catch(error => {
                    console.error(error);
                });
        
            $(document).ready(function() {
                const element = document.getElementById("kt_docs_fullcalendar_basic");
        
                var todayDate = moment().startOf("day");
                var YM = todayDate.format("YYYY-MM");
                var YESTERDAY = todayDate.clone().subtract(1, "day").format("YYYY-MM-DD");
                var TODAY = todayDate.format("YYYY-MM-DD");
                var TOMORROW = todayDate.clone().add(1, "day").format("YYYY-MM-DD");
        
                var calendarEl = document.getElementById("kt_docs_fullcalendar_basic");
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    headerToolbar: {
                        left: "prev,next today",
                        center: "title",
                        right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
                    },
        
                    height: 800,
                    contentHeight: 780,
                    aspectRatio: 3, // see: https://fullcalendar.io/docs/aspectRatio
        
                    nowIndicator: true,
                    now: TODAY + "T09:25:00", // just for demo
        
                    views: {
                        dayGridMonth: {
                            buttonText: "month"
                        },
                        timeGridWeek: {
                            buttonText: "week"
                        },
                        timeGridDay: {
                            buttonText: "day"
                        }
                    },
        
                    initialView: "dayGridMonth",
                    initialDate: TODAY,
        
                    editable: true,
                    dayMaxEvents: true, // allow "more" link when too many events
                    navLinks: true,
                    events: [
        
                    ]
                });
        
                calendar.render();
            });
        
            $(document).ready(function() {
                "use strict";
        
                // Class definition
                var KTJKanbanDemoRich = function() {
                    // Private functions
                    var exampleRich = function() {
                        var kanban = new jKanban({
                            element: '#kt_docs_jkanban_rich',
                            gutter: '0',
                            widthBoard: '400px',
                            // click: function(el) {
                            //     alert(el.innerHTML);
                            // },
                            boards: [{
                                    'id': 'pending',
                                    'title': 'PENDING',
                                    'class': 'light-dark',
                                    'item': [{
                                        'title': `
                                                <div class="d-flex align-items-center">
                                                    <div class="d-flex align-items-center flex-grow-1">
                                                        <div class="symbol symbol-50px">
                                                            <img src="assets/media/avatars/300-4.jpg" alt="" class="w-50px me-3" />
                                                        </div>                
                                                        <div class="d-flex flex-column">
                                                            <a class="text-gray-900 fs-6 fw-bold">Anna Bell</a>
                                                            <span class="text-gray-500 fw-bold">Volunteer Hour Form</span>
                                                        </div>
                                                    </div>
                                                    <div class="m-0">
                                                        <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                                            <i class="ki-duotone ki-dots-square fs-1">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                                <span class="path3"></span>
                                                                <span class="path4"></span>
                                                            </i>
                                                        </button>
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 fw-semibold w-200px" data-kt-menu="true">
                                                            <div class="menu-item">
                                                                <a href="#" class="menu-link">View</a>
                                                                <a href="#" class="menu-link">Edit</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            `,
                                    }]
                                },
                                {
                                    'id': 'accepted',
                                    'title': 'ACCEPTED',
                                    'class': 'light-dark',
                                    'item': [{
                                            'title': `
                                                <div class="d-flex align-items-center">
                                                    <div class="d-flex align-items-center flex-grow-1">
                                                        <div class="symbol symbol-50px">
                                                            <img src="assets/media/avatars/300-1.jpg" alt="" class="w-50px me-3" />
                                                        </div>                
                                                        <div class="d-flex flex-column">
                                                            <a class="text-gray-900 fs-6 fw-bold">Wesley Wade</a>
                                                            <span class="text-gray-500 fw-bold">Volunteer Hour Form</span>
                                                        </div>
                                                    </div>
                                                    <div class="m-0">
                                                        <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                                            <i class="ki-duotone ki-dots-square fs-1">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                                <span class="path3"></span>
                                                                <span class="path4"></span>
                                                            </i>
                                                        </button>
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 fw-semibold w-200px" data-kt-menu="true">
                                                            <div class="menu-item">
                                                                <a href="#" class="menu-link">View</a>
                                                                <a href="#" class="menu-link">Edit</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            `,
                                        },
                                        {
                                            'title': `
                                                <div class="d-flex align-items-center">
                                                    <div class="d-flex align-items-center flex-grow-1">
                                                        <div class="symbol symbol-50px">
                                                            <img src="assets/media/avatars/300-2.jpg" alt="" class="w-50px me-3" />
                                                        </div>                
                                                        <div class="d-flex flex-column">
                                                            <a class="text-gray-900 fs-6 fw-bold">Julia Markson</a>
                                                            <span class="text-gray-500 fw-bold">Volunteer Hour Form</span>
                                                        </div>
                                                    </div>
                                                    <div class="m-0">
                                                        <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                                            <i class="ki-duotone ki-dots-square fs-1">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                                <span class="path3"></span>
                                                                <span class="path4"></span>
                                                            </i>
                                                        </button>
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 fw-semibold w-200px" data-kt-menu="true">
                                                            <div class="menu-item">
                                                                <a href="#" class="menu-link">View</a>
                                                                <a href="#" class="menu-link">Edit</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            `,
                                        }
                                    ]
                                },
                                {
                                    'id': 'rejected',
                                    'title': 'REJECTED',
                                    'class': 'light-dark',
                                    'item': [{
                                        'title': `
                                                <div class="d-flex align-items-center">
                                                    <div class="d-flex align-items-center flex-grow-1">
                                                        <div class="symbol symbol-50px">
                                                            <img src="assets/media/avatars/300-3.jpg" alt="" class="w-50px me-3" />
                                                        </div>                
                                                        <div class="d-flex flex-column">
                                                            <a class="text-gray-900 fs-6 fw-bold">Anthony Smith</a>
                                                            <span class="text-gray-500 fw-bold">Volunteer Hour Form</span>
                                                        </div>
                                                    </div>
                                                    <div class="m-0">
                                                        <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                                            <i class="ki-duotone ki-dots-square fs-1">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                                <span class="path3"></span>
                                                                <span class="path4"></span>
                                                            </i>
                                                        </button>
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 fw-semibold w-200px" data-kt-menu="true">
                                                            <div class="menu-item">
                                                                <a href="#" class="menu-link">View</a>
                                                                <a href="#" class="menu-link">Edit</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            `,
                                    }]
                                }
                            ]
                        });
                    }
        
                    return {
                        // Public Functions
                        init: function() {
                            exampleRich();
                        }
                    };
                }();
        
                // On document ready
                KTUtil.onDOMContentLoaded(function() {
                    KTJKanbanDemoRich.init();
                });
            });
        
            $(document).ready(function() {
                // Draggable
                var containers = document.querySelectorAll(".draggable-zone");
                if (containers.length === 0) {
                    return false;
                }
                var swappable = new Swappable.default(containers, {
                    draggable: ".draggable",
                    handle: ".draggable .draggable-handle",
                    mirror: {
                        //appendTo: selector,
                        appendTo: "body",
                        constrainDimensions: true
                    }
                });
            });
        
            $(document).ready(function() {
        
                // Hide and show dropdown options based on selection from another dropdown
                $(document).ready(function() {
                    const servicesByCountry = {
                        Canada: [
                            "Free Study Visa Application Assistance",
                            "Free Offer Letter Assistance",
                            "GCMS Notes",
                            "Tourist Visa",
                            "PGP Sponsorship"
                        ],
                        Australia: [
                            "Free Study Visa Application Assistance",
                            "Free Offer Letter Assistance",
                            "Tourist Visa"
                        ],
                        "New Zealand": [
                            "Free Study Visa Application Assistance",
                            "Tourist Visa"
                        ],
                        Ireland: ["Free Study Visa Application Assistance"],
                        "United Kingdom": ["Free Study Visa Application Assistance"],
                        USA: ["Free Study Visa Application Assistance"],
                        Germany: [
                            "Study Visa Application Assistance",
                            " Offer Letter Assistance",
                            "Tourist Visa"
                        ],
                        Spain: [
                            "Study Visa Application Assistance",
                            " Offer Letter Assistance",
                            "Tourist Visa"
                        ],
                        Poland: [
                            "Study Visa Application Assistance",
                            " Offer Letter Assistance",
                            "Tourist Visa"
                        ],
                        Malta: [
                            "Study Visa Application Assistance",
                            " Offer Letter Assistance",
                            "Tourist Visa"
                        ],
                        Other: [
                            "Study Visa Application Assistance",
                            " Offer Letter Assistance",
                            "Tourist Visa"
                        ],
                    };
        
                    $('.country').change(function() {
                        const selectedCountry = $(this).val();
                        const $serviceDropdown = $('.service');
        
                        // Clear existing options
                        $serviceDropdown.empty();
                        $serviceDropdown.append('<option>-- Service --</option>');
        
                        // Populate options based on selected country
                        if (servicesByCountry[selectedCountry]) {
                            servicesByCountry[selectedCountry].forEach(function(service) {
                                $serviceDropdown.append(`<option value="${service}">${service}</option>`);
                            });
                        }
                    });
                });
        
        
                // Hide/ Show Fields on User List
                // Hide all fields initially
                $(".field").hide('fast');
        
                // Show the default selected field
                var defaultSelection = $("input[name='method']:checked").val();
                $(".field-" + defaultSelection).show('fast');
        
                // Handle radio button change event
                $("input[name='method']").change(function() {
                    var selectedValue = $(this).val();
        
                    // Hide all fields
                    $(".field").hide('fast');
        
                    // Show the selected field
                    $(".field-" + selectedValue).show('fast');
                });
        
                // SweetAlert
                var button = document.getElementsByClassName('delete_sweetalert')[0];
                // Add the event listener to the button
                button.addEventListener('click', function(e) {
                    e.preventDefault();
        
                    Swal.fire({
                        html: `Are you sure you want to delete this?`,
                        icon: "warning",
                        buttonsStyling: false,
                        showCancelButton: true,
                        confirmButtonText: "Yes, Delete it!",
                        cancelButtonText: 'No',
                        customClass: {
                            confirmButton: "btn btn-danger",
                            cancelButton: 'btn btn-light'
                        }
                    });
                });
            });
        
            // Tagify
            var input2 = document.querySelector(".kt_tagify_2");
            new Tagify(input2, {
                whitelist: [
                    "sean@dellito.com",
                    "brian@exchange.com",
                    "mikaela@pexcom.com",
                    "f.mitcham@kpmg.com.au",
                    "olivia@corpmail.com",
                    "owen.neil@gmail.com",
                    "dam@consilting.com",
                    "emma@intenso.com",
                    "ana.cf@limtel.com",
                    "robert@benko.com",
                    "lucy.m@fentech.com",
                    "ethan@loop.com.au",
                ],
                maxTags: 10,
                dropdown: {
                    maxItems: 20,
                    classname: "tagify__inline__suggestions",
                    enabled: 0,
                    closeOnSelect: !1,
                },
            });
        
            // Copy Paste Clipboard Script
            const target = document.getElementById('kt_clipboard_4');
            const button = target.nextElementSibling;
            clipboard = new ClipboardJS(button, {
                target: target,
                text: function() {
                    return target.innerHTML;
                }
            });
            clipboard.on('success', function(e) {
                var checkIcon = button.querySelector('.ki-check');
                var copyIcon = button.querySelector('.ki-copy');
                if (checkIcon) {
                    return;
                }
                checkIcon = document.createElement('i');
                checkIcon.classList.add('ki-duotone');
                checkIcon.classList.add('ki-check');
                checkIcon.classList.add('fs-2x');
                checkIcon.classList.add('text-success');
                button.appendChild(checkIcon);
                const classes = ['text-success', 'fw-boldest'];
                target.classList.add(...classes);
                copyIcon.classList.add('d-none');
                setTimeout(function() {
                    copyIcon.classList.remove('d-none');
                    button.removeChild(checkIcon);
                    target.classList.remove(...classes);
                    button.classList.remove('btn-success');
                }, 3000)
            });
        
            // Select2
            $('.js-example-basic-single').select2();
        
            $(".js-example-tags").select2({
                tags: true
            });
        
            // Phone
            Inputmask({
                "mask": "(999) 999-9999"
            }).mask(".kt_inputmask_2");
        
            // Page Loader
            const showButton = document.getElementById("show-3-seconds-btn");
            const loaderWrapper = document.querySelector(".loader-wrapper");
        
            showButton.addEventListener("click", () => {
                loaderWrapper.classList.add("active");
                setTimeout(() => {
                    loaderWrapper.classList.remove("active");
                }, 3000); // Remove the loader after 3 seconds
            });
        </script>
        <!--end::Custom Javascript-->
        
        </body>
        <!--end::Body-->
        
        </html>

{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html> --}}
