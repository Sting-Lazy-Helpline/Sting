<x-app-layout>
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Survey</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted text-hover-primary">Home</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-fluid">
                <div class="row g-5 g-xl-8">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header border-0 pt-6">
                                <div class="card-title">
                                    <div class="d-flex align-items-center position-relative my-1" style="margin-right: 20px;">
                                        <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <input type="text" data-kt-user-table-filter="search" class="form-control form-control-sm form-control-solid w-min-250px ps-14 search" placeholder="Search ..." />
                                    </div>
                                    <div class="d-flex align-items-center position-relative my-1">
                                        <input class="form-control form-control-sm form-control-solid w-min-250px ps-10 search" placeholder="Pick date rage" id="kt_daterangepicker_1"/>
                                    </div>
                                </div>
                            </div>
    
                            <div class="card-body py-4">
                                <table class="table align-middle table-row-dashed fs-6 gy-5 " id="kt_datatable_example_1">
                                    <thead>
                                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0 no-wrap">
                                            <th hidden>Id</th>
                                            <th>Full Name</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Created At</th>
                                            <th class="text-end min-w-100px"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-gray-600 fw-semibold">
                                        {{-- @foreach ($survey as $item)
                                        <tr>
                                            <td>
                                                {{ $item->name }}
                                            </td>
                                            <td>
                                                {{ $item->phone_number }}
                                            </td>
                                            <td>
                                                {{ $item->address }}
                                            </td>
                                            <td>
                                                {{ $item->created_at }}
                                            </td>
                                            <td class="text-end nowrap">
                                                <button class="btn btn-icon btn-sm btn-color-gray-400 btn-active-icon-success" onclick="openModalBox('modal_large','{{ route('survey.show',$item->id) }}','View Survey')">
                                                    <i class="ki-outline ki-eye fs-1" data-bs-toggle="tooltip" title="View Survey"> </i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
    </x-app-layout>
    <script>
        let startDate = '';
        let endDate = '';
        $(document).ready(function() {
                // Initialize
                dt = $('#kt_datatable_example_1').DataTable({
                    searching: false,
                    processing: true,
                    serverSide: true,
                    scrollX: true,
                    "bLengthChange": false, 
                    fixedHeader: {
                        header: true,
                        headerOffset: 65,
                    },
                    order: [
                        [0, 'desc']
                    ],
                    ajax: {
                        url: "{{ route('survey.index') }}",
                        data: function(d) {
                            d.start_date = startDate;
                            d.end_date = endDate;
                        }
                    },
                    columns: [{
                            "visible": false,
                            data: 'id',
                            name: 'id',
                            searchable: false,
                        },
                        {
                            class: 'nowrap',
                            data: 'name',
                            name: 'name',
                            render: renderData 
                        },
                        {
                            class: 'nowrap',
                            data: 'phone_number',
                            name: 'phone_number',
                            render: renderData 
                        },
                        {
                            class: 'nowrap',
                            data: 'address',
                            name: 'address',
                            render: renderData 
                        },
                        {
                            class: 'nowrap',
                            data: 'created_at',
                            name: 'created_at',
                            render: renderData 
                        },
                        {
                            class: 'text-end',
                            data: '',
                            name: '',
                            searchable: false,
                            orderable: false, 
                            render: function(data, type, row) {
                                var url = "{{ route('survey.show', ':id') }}";
                                url = url.replace(':id', row.id);
                              
                                // debugger
                                return `
                                <button class="btn btn-icon btn-sm btn-color-gray-400 btn-active-icon-success" onclick="openModalBox('modal_large','${url}','View Survey')">
                                                    <i class="ki-outline ki-eye fs-1" data-bs-toggle="tooltip" title="View Survey"> </i>
                                                </button>`;
                            }
                        },
                        
                    ],
                   
                    aLengthMenu: [
                        [10, 25, 50, 100, 200, -1],
                        [10, 25, 50, 100, 200, "All"]
                    ]
                });
                table = dt.$;
                dt.on('draw', function() {
                    // KTMenu.createInstances();
                    // $('[data-bs-toggle="tooltip"]').tooltip();
                });
            });

 
       $(function () {
    $('#kt_daterangepicker_1').daterangepicker();

        $('#kt_daterangepicker_1').on('apply.daterangepicker', function(ev, picker) {
            startDate = picker.startDate.format('YYYY-MM-DD');
            endDate = picker.endDate.format('YYYY-MM-DD');
            $('#kt_datatable_example_1').DataTable().ajax.reload();
        });
    });
    </script>