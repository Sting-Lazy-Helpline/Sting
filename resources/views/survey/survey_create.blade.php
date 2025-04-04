<x-app-layout>
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Add - Survey</h1>
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
                            <form id="form_add" class="form" method="POST" action="{{ route('survey.store') }}">
                                @csrf
                            
                                <div class="row g-5">
                                    <div class="form-group">
                                        <div class="col-12">
                                            <div class="border border-1 p-5 rounded">
                                                <div class="form-group row g-5">
                                                    <div class="col-xl-4 col-lg-6">
                                                        <label class="fs-6 fw-semibold mb-2 required">Name</label>
                                                        <input type="text" required class="form-control form-control-solid" placeholder="Enter the full name" name="name" />
                                                    </div>
                                                    <div class="col-xl-4 col-lg-6">
                                                        <label class="fs-6 fw-semibold mb-2 required">Phone Number</label>
                                                        <input type="text" required class="form-control form-control-solid" placeholder="Enter the phone number" name="phone_number" />
                                                    </div>
                                                    <div class="col-xl-4 col-lg-6">
                                                        <label class="fs-6 fw-semibold mb-2 required">Address</label>
                                                        <input type="text" required class="form-control form-control-solid" placeholder="Enter the address" name="address" />
                                                    </div>
                                                    @foreach ($question as $item)
                                                        @if($item->type == 'radio')
                                                        <div class="col-xl-6 col-lg-6">
                                                            <label class="fs-6 fw-semibold mb-2 required">{{ $item->question }}</label>
                                                            <div class="fs-6 form-control "style="display: flex !important">
                                                                <div class="form-check col-lg-3">
                                                                    <input class="form-check-input" type="radio" value="yes" id="flexCheckDefault{{$item->id}}" name="answer___{{$item->id}}">
                                                                    <label class="form-check-label" for="flexCheckDefault{{$item->id}}">
                                                                        Yes
                                                                    </label>
                                                                </div>
                                                
                                                                <div class="form-check col-lg-3">
                                                                    <input class="form-check-input" type="radio" value="no" id="flexCheckChecked{{$item->id}}" name="answer___{{$item->id}}"  checked>
                                                                    <label class="form-check-label" for="flexCheckChecked{{$item->id}}" >
                                                                        No
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @elseif($item->type == 'input')
                                                        <div class="col-xl-6 col-lg-6">
                                                            <label class="fs-6 fw-semibold mb-2 required">{{ $item->question }}</label>
                                                            <input type="text" required class="form-control form-control-solid" placeholder="Enter the {{ $item->question }}" name="answer___{{$item->id}}" />
                                                        </div>
                                                        @endif
                                                    @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer flex-center p-5">
                                    <button id="submitbutton" type="button" onclick="addUpdateData('submitbutton','form_add','modal_large_xl','yes')"
                                        class="btn btn-lg btn-primary">
                                        <label class="indicator-label">Upload</label>
                                        <label class="indicator-progress">Please wait...
                                            <label class="spinner-border spinner-border-sm align-middle ms-2"></label></label>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>