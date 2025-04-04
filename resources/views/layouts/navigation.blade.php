<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
    <!--begin::Sidebar-->
    <div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
        <!--begin::Logo-->
        <div class="app-sidebar-logo px-6 border-0 justify-content-center" id="kt_app_sidebar_logo">
            <!--begin::Logo image-->
            <a href="{{ route('dashboard') }}">
                <img alt="Logo" src="{{ asset('theme/assets/media/logos/logom3.jpg')}}" class="h-50px app-sidebar-logo-default" />
                <img alt="Logo" src="{{ asset('theme/assets/media/logos/favicon.png')}}" class="h-25px app-sidebar-logo-minimize" />
            </a>
            <!--end::Logo image-->
            <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
                <i class="ki-outline ki-arrow-left rotate-180 fs-3"></i>
            </div>
            <!--end::Sidebar toggle-->
        </div>
        <!--end::Logo-->
        <!--begin::sidebar menu-->
        <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
            <!--begin::Menu wrapper-->
            <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
                <!--begin::Scroll wrapper-->
                <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
                    <!--begin::Menu-->
                    <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">

                        <div class="menu-item">
                            <div class="menu-content">
                                <span class="menu-heading fw-bold text-uppercase fs-7">{{ Auth::user()->roles->first()->display_name }}</span>
                            </div>
                        </div>
                        {{-- @if(Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'staff') --}}
                        <div class="menu-item">
                            <a class="menu-link {{ Route::currentRouteName() == 'survey.create' ? 'active' : '' }}" href="{{ route('survey.create') }}">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-message-question fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Add Survey</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ Route::currentRouteName() == 'survey.index' ? 'active' : '' }}" href="{{ route('survey.index') }}">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-medal-star fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                    </i>
                                </span>
                                <span class="menu-title">View Survey</span>
                            </a>
                        </div>
                        {{-- <div class="menu-item">
                            <a class="menu-link {{ Route::currentRouteName() == 'inital_document.index' ? 'active' : '' }}" href="{{ route('inital_document.index') }}">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-clipboard fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Initial Documents</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ Route::currentRouteName() == 'program-assessment-application.index' ? 'active' : '' }}" href="{{ route('program-assessment-application.index') }}">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-data fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Program Assessment</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ Route::currentRouteName() == 'school-admission.index' ? 'active' : '' }}" href="{{ route('school-admission.index') }}">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-teacher fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">School Admission</span>
                            </a>
                        </div>
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ Route::currentRouteName() == 'immi-form.index' || Route::currentRouteName() == 'personal-requirement.index' || Route::currentRouteName() == 'sponsor.index' ? 'show' : '' }}">
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-element-7 fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Lodgement</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion">
                                <div class="menu-item">
                                    <a class="menu-link {{ Route::currentRouteName() == 'immi-form.index' ? 'active' : '' }}" href="{{ route('immi-form.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Immi Forms</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link {{ Route::currentRouteName() == 'personal-requirement.index' ? 'active' : '' }}" href="{{ route('personal-requirement.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Personal Requirements</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link {{ Route::currentRouteName() == 'sponsor.index' ? 'active' : '' }}" href="{{ route('sponsor.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Sponsor</span>
                                    </a>
                                </div>
                            </div>
                        </div> --}}
                        {{-- @if(Auth::user()->user_type == 'admin') --}}
                        {{-- <div class="menu-item">
                            <a class="menu-link {{ Route::currentRouteName() == 'user.index' ? 'active' : '' }}" href="{{ route('user.index') }}">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-security-user fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Team</span>
                            </a>
                        </div>
                        @endif --}}

                        {{-- @elseif(Auth::user()->user_type == 'client')
                        <div class="menu-item">
                            <a class="menu-link {{ Route::currentRouteName() == 'my-application' ? 'active' : '' }}" href="{{ route('my-application') }}">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-some-files fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">My Applications</span>
                            </a>
                        </div>
                        @endif --}}
                        <div class="menu-item">
                            <a class="menu-link {{ Route::currentRouteName() == 'settings.create'  ? 'active' : '' }}" href="{{ route('settings.create') }}">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-setting-4 fs-2"></i>
                                </span>
                                <span class="menu-title">Account Settings</span>
                            </a>
                        </div>
                    </div>
                    <!--end::Menu-->
                </div>
                <!--end::Scroll wrapper-->
            </div>
            <!--end::Menu wrapper-->
        </div>
        <!--end::sidebar menu-->
        <!--begin::Footer-->
        <div class="app-sidebar-footer flex-column-auto pt-2 pb-6 px-6" id="kt_app_sidebar_footer">
            <a href="{{ route('logout') }}" class="btn btn-flex flex-center btn-custom btn-primary overflow-hidden text-nowrap px-0 h-40px w-100">
                <span class="menu-icon">
                    <i class="ki-duotone ki-exit-right fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </span>
                <span class="ps-2 btn-label">Sign Out</span>
            </a>
        </div>
        <!--end::Footer-->
    </div>
    <!--end::Sidebar-->
    <!--begin::Main-->
