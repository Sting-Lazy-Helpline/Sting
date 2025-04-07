    <div class="row g-5">
        <div class="form-group">
            <div class="col-12">
                <div class="border border-1 p-5 rounded">
                    <div class="form-group row g-5">
                        <div class="col-xl-4 col-lg-6">
                            <label class="fs-6 fw-semibold mb-2 required">Name</label>
                            <input type="text" required class="form-control form-control-solid" placeholder="Enter the full name" name="name" value="{{ $survey->name }}" disabled/>
                        </div>
                        <div class="col-xl-4 col-lg-6">
                            <label class="fs-6 fw-semibold mb-2 required">Phone Number</label>
                            <input type="text" required class="form-control form-control-solid" placeholder="Enter the phone number" name="phone_number" value="{{ $survey->phone_number }}" disabled/>
                        </div>
                        <div class="col-xl-4 col-lg-6">
                            <label class="fs-6 fw-semibold mb-2 required">Address</label>
                            <input type="text" required class="form-control form-control-solid" placeholder="Enter the address" name="address" value="{{ $survey->address }}" disabled/>
                        </div>
                        @foreach ($data as $item)
                            @if($item->type == 'radio')
                            <div class="col-xl-6 col-lg-6">
                                <label class="fs-6 fw-semibold mb-2 required">{{ $item->question }}</label>
                                <div class="fs-6 form-control "style="display: flex !important">
                                    <div class="form-check col-lg-3">
                                        <input class="form-check-input" type="radio" value="yes" id="flexCheckDefault{{$item->id}}" name="answer___{{$item->id}}" {{ $item->answer == 'yes' ? 'checked' : '' }} disabled>
                                        <label class="form-check-label" for="flexCheckDefault{{$item->id}}">
                                            Yes
                                        </label>
                                    </div>
                    
                                    <div class="form-check col-lg-3">
                                        <input class="form-check-input" type="radio" value="no" id="flexCheckChecked{{$item->id}}" name="answer___{{$item->id}}"  {{ $item->answer == 'no' ? 'checked' : '' }} disabled>
                                        <label class="form-check-label" for="flexCheckChecked{{$item->id}}" >
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @elseif($item->type == 'input')
                            <div class="col-xl-6 col-lg-6">
                                <label class="fs-6 fw-semibold mb-2 required">{{ $item->question }}</label>
                                <input type="text" readonly class="form-control form-control-solid" placeholder="Enter the {{ $item->question }}" value="{{ $item->answer }}" name="answer___{{$item->id}}" disabled/>
                            </div>
                            @endif
                        @endforeach
                </div>
            </div>
        </div>
    </div>
                        