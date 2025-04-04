<x-app-layout>
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Team</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-fluid">
                <div class="card">
                    <div class="card-header border-0 pt-6">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1">
                                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <input type="text" data-kt-user-table-filter="search" class="form-control form-control-sm form-control-solid w-min-250px ps-14 search" placeholder="Search ..." />
                            </div>
                        </div>
                        <div class="card-toolbar">
                            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                                <button type="button" class="btn btn-sm btn-primary" onclick="openModalBox('modal_large','{{ route('user.create') }}','Add Team')">
                                    <i class="ki-duotone ki-plus fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    Add Team
                                </button>
                            </div>
                        </div>
                    </div>
                    @php 
                     $userId=Auth::user()->id;
                    @endphp
                    <div class="card-body py-4">
                        <table class="table align-middle table-row-dashed fs-6 gy-5 kt_datatable_example_1">
                            <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0 no-wrap">
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th class="text-end min-w-100px"></th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold">
                                @foreach ($user as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a>
                                                    <div class="symbol-label">
                                                        <img src="{{ asset($item->profile_picture) }}" alt="Avatar" class="w-100" />
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="d-block">
                                                <a class="fw-bolder text-gray-800 text-hover-primary mb-1">{{ $item->name }}</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a class="fw-normal text-gray-800">{{ $item->email }}</a>
                                    </td>
                                    <td>
                                        @if($item->user_type == 'admin')
                                            <span class="badge badge-dark fw-bold fs-8 px-2 py-1">Admin</span>
                                        @else
                                            <span class="badge badge-secondary fw-bold fs-8 px-2 py-1">Staff</span>
                                        @endif
                                    </td>
                                    <td class="text-end nowrap">
                                        <button class="btn btn-icon btn-sm btn-color-gray-400 btn-active-icon-primary" onclick="openModalBox('modal_large','{{ route('user.edit',$item->id) }}','Edit Team')">
                                            <i class="ki-outline ki-pencil fs-1" data-bs-toggle="tooltip" title="Edit"></i>
                                        </button>
                                        @if($userId != $item->id)
                                        <button type="button" class="btn btn-icon btn-sm btn-color-gray-400 btn-active-icon-danger " onclick="deleteSweerAlert('This User has been deleted.','{{ route('user.destroy',$item->id) }}','{{route('user.index')}}')">
                                            <i class="ki-outline ki-trash fs-1" data-bs-toggle="tooltip" title="Delete"></i>
                                        </button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
</x-app-layout>
