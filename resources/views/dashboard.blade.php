<x-app-layout>
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Dashboard</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('dashboard')}}" class="text-muted text-hover-primary">Home</a>
                        </li>
                    </ul>
                </div>
                 
            </div>
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-fluid">
                <!--begin::Row-->
                <div class="row g-5 g-xl-8">
                    <div class="col-12 col-md-6 col-xl-3">
                        <a href="#" class="card bg-body hoverable card-xl-stretch mb-xl-8 hover-elevate-up shadow-hover">
                            <div class="card-body">
                                <i class="ki-duotone ki-two-credit-cart text-primary fs-2x ms-n1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                                <div class="text-gray-900 fw-bold fs-2 mb-2 mt-5">655</div>
                                <div class="fw-semibold text-gray-600">Total Calls</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3">
                        <a href="#" class="card bg-body hoverable card-xl-stretch mb-xl-8 hover-elevate-up shadow-hover">
                            <div class="card-body">
                                <i class="ki-duotone ki-clipboard text-primary fs-2x ms-n1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                                <div class="text-gray-900 fw-bold fs-2 mb-2 mt-5">1526</div>
                                <div class="fw-semibold text-gray-600">Answer Calls</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3">
                        <a href="#" class="card bg-body hoverable card-xl-stretch mb-xl-8 hover-elevate-up shadow-hover">
                            <div class="card-body">
                                <i class="ki-duotone ki-calendar text-primary fs-2x ms-n1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <div class="text-gray-900 fw-bold fs-2 mb-2 mt-5">152</div>
                                <div class="fw-semibold text-gray-600">No Answer Calls</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3">
                        <a href="#" class="card bg-body hoverable card-xl-stretch mb-xl-8 hover-elevate-up shadow-hover">
                            <div class="card-body">
                                <i class="ki-duotone ki-data text-primary fs-2x ms-n1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                    <span class="path7"></span>
                                </i>
                                <div class="text-gray-900 fw-bold fs-2 mb-2 mt-5">3456</div>
                                <div class="fw-semibold text-gray-600">Duration</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3">
                        <a href="#" class="card bg-body hoverable card-xl-stretch mb-xl-8 hover-elevate-up shadow-hover">
                            <div class="card-body">
                                <i class="ki-duotone ki-data text-primary fs-2x ms-n1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                    <span class="path7"></span>
                                </i>
                                <div class="text-gray-900 fw-bold fs-2 mb-2 mt-5">3456</div>
                                <div class="fw-semibold text-gray-600">Talk Time</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
