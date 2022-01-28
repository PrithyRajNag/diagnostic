@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Add Ambulance</h3>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('ambulance.index')}}" class="btn-sm btn-primary">BACK</a>
                            </div>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form id="createForm" class="form form-vertical" action="{{route('ambulance.store')}}" method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="vehicle_number" class="mb-2"><span class="required">*</span> Vehicle Number</label>
                                                <input type="text" class="form-control" id="vehicle_number" name="vehicle_number" value="{{ old('vehicle_number') }}"
                                                       placeholder="vehicle number" required>
                                            </div>
                                            <span class="text-danger">@error('vehicle_number'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="vehicle_model" class="mb-2"><span class="required">*</span> Vehicle Model</label>
                                                <input type="text" class="form-control" id="vehicle_model" name="vehicle_model" value="{{ old('vehicle_model') }}"
                                                       placeholder="vehicle model" required>
                                            </div>
                                            <span class="text-danger">@error('vehicle_model'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="driver_name" class="mb-2"><span class="required">*</span> Driver Name</label>
                                                <input type="text" class="form-control" id="driver_name" name="driver_name" value="{{ old('driver_name') }}"
                                                       placeholder="driver name" required>
                                            </div>
                                            <span class="text-danger">@error('driver_name'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="driver_phone_number" class="mb-2"><span class="required">*</span> Driver Phone Number</label>
                                                <input type="text" class="form-control" id="driver_phone_number" name="driver_phone_number" value="{{ old('driver_phone_number') }}"
                                                       placeholder="driver phone number" required>
                                            </div>
                                            <span class="text-danger">@error('driver_phone_number'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="driver_license" class="mb-2"><span class="required">*</span> Driver License</label>
                                                <input type="text" class="form-control" id="driver_license" name="driver_license" value="{{ old('driver_license') }}"
                                                       placeholder="driver license" required>
                                            </div>
                                            <span class="text-danger">@error('driver_license'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="divider">
                                            <div class="divider-text">Address</div>
                                        </div>
                                        <div class="col- mt-2">
                                            <label for="present_address" class="mt-2 font-weight-bolder">Present
                                                Address</label>
                                            <hr style="margin: 10px 0px">
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="present_address['country']"
                                                       class="mb-2"><span class="required">*</span> Country</label>
                                                <input type="text" name="present_address[country]"
                                                       id="present_country" class="form-control"
                                                       value="{{old('present_address[country]')}}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="present_address[district]"
                                                       class="mb-2"><span class="required">*</span> District</label>
                                                <input type="text" name="present_address[district]" id="present_district"
                                                       class="form-control"
                                                       value="{{old('present_address[district]')}}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="present_address[upazila]" class="mb-2"><span class="required">*</span> Thana/Upazila</label>
                                                <input type="text" name="present_address[upazila]" id="present_upazila"
                                                       class="form-control"
                                                       value="{{old('present_address[upazila]')}}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="present_address[post_code]" class="mb-2"><span class="required">*</span> Post
                                                    Code</label>
                                                <input type="text" name="present_address[post_code]" id="present_post"
                                                       class="form-control"
                                                       value="{{old('present_address[post_code]')}}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="present_address[address_line1]" class="mb-2"><span class="required">*</span> Address
                                                    Line
                                                    1</label>
                                                <textarea class="form-control"
                                                          name="present_address[address_line1]" id="present_add1"
                                                          rows="2"
                                                          required></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="present_address[address_line2]" class="mb-2">Address
                                                    Line
                                                    2</label>
                                                <textarea class="form-control"
                                                          name="present_address[address_line2]" id="present_add2"
                                                          rows="2"></textarea>
                                            </div>
                                        </div>

                                        <div class="col- mt-2">
                                            <label for="permanent_address" class="mt-2 font-weight-bolder">Permanent
                                                Address &nbsp; &nbsp;</label>
                                            <input type="checkbox" id="same_as_present" name="same_as_present">
                                            <label for="same_as_present">Same as Present</label>
                                            <hr style="margin: 10px 0px">
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="permanent_address['country']" class="mb-2"><span class="required">*</span> Country</label>
                                                <input type="text" name="permanent_address[country]" id="permanent_country"
                                                       class="form-control"
                                                       value="{{old('permanent_address[country]')}}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="permanent_address[district]" class="mb-2"><span class="required">*</span> District</label>
                                                <input type="text" name="permanent_address[district]" id="permanent_district"
                                                       class="form-control"
                                                       value="{{old('permanent_address[district]')}}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="permanent_address[upazila]" class="mb-2"><span class="required">*</span> Thana/Upozila</label>
                                                <input type="text" name="permanent_address[upazila]" id="permanent_upazila"
                                                       class="form-control"
                                                       value="{{old('permanent_address[upazila]')}}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="permanent_address[post_code]" class="mb-2"><span class="required">*</span> Post
                                                    Code</label>
                                                <input type="text" name="permanent_address[post_code]" id="permanent_post"
                                                       class="form-control"
                                                       value="{{old('permanent_address[post_code]')}}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="permanent_address[address_line1]" class="mb-2"><span class="required">*</span> Address
                                                    Line
                                                    1</label>
                                                <textarea class="form-control"
                                                          name="permanent_address[address_line1]" id="permanent_add1"
                                                          rows="2"
                                                          required></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="permanent_address[address_line2]" class="mb-2">Address
                                                    Line
                                                    2</label>
                                                <textarea class="form-control"
                                                          name="permanent_address[address_line2]" id="permanent_add2"
                                                          rows="2"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="status"><span class="required">*</span> Status</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status" id="active"
                                                           value="1" required>
                                                    <label class="form-check-label" for="active">Active</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status" id="inactive"
                                                           value="0" required>
                                                    <label class="form-check-label" for="inactive">Inactive</label>
                                                </div>
                                                <span class="text-danger">@error('status'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('customScripts')
    <script>
        $("input[name*='same_as_present']").click(function (){
            $("#permanent_country").val($("#present_country").val());
            $("#permanent_district").val($("#present_district").val());
            $("#permanent_upazila").val($("#present_upazila").val());
            $("#permanent_post").val($("#present_post").val());
            $("#permanent_add1").val($("#present_add1").val());
            $("#permanent_add2").val($("#present_add2").val());
        })
        $("#createForm").validate({
            errorPlacement: function (error, e) {
                e.parents('.form-group').append(error);
            },
            rules:{
                vehicle_number: "required",
                vehicle_model: "required",
                driver_name:"required",
                driver_phone_number: {
                    required:true,
                    maxlength:11
                },
                driver_license:"required",
                present_address:"required",
                permanent_address:"required",
                status: "required",

            },
            messages:{
                vehicle_number: "Vehicle Number is required",
                vehicle_model: "Vehicle Model is required",
                driver_name: "Driver Name is required",
                driver_phone_number: {
                    required:"Driver Phone Number is required",
                    maxlength: "Phone Number is greater than 11 digits"
                },
                driver_license: "Driver License is required",
                present_address: "Present Address is required",
                permanent_address: "Permanent Address is required",
                status: "Status Field is required",
            }
        });

    </script>
@endpush
