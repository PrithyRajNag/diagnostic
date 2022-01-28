@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Create Blood Input</h3>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('blood-input.index')}}" class="btn-sm btn-primary">BACK</a>
                            </div>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" action="{{route('blood-input.store')}}" method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="first_name" class="mb-2">First Name</label>
                                                <input type="text"
                                                       value="{{old('first_name') ?? ''}}"
                                                       class="form-control" id="first_name"
                                                       name="first_name" required>
                                            </div>
                                            <span
                                                class="text-danger">@error('first_name'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="last_name" class="mb-2">Last Name</label>
                                                <input type="text"
                                                       value="{{old('last_name') ?? ''}}"
                                                       class="form-control" id="last_name" name="last_name"
                                                       required>
                                            </div>
                                            <span
                                                class="text-danger">@error('last_name'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="age" class="mb-2">Age</label>
                                                <input type="number" value="{{old('age') ?? ''}}"
                                                       class="form-control" id="age"
                                                       name="age"
                                                       required>
                                            </div>
                                            <span
                                                class="text-danger">@error('age'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="phone_number" class="mb-2">Phone Number</label>
                                                <input type="text" value="{{old('phone_number') ?? ''}}"
                                                       class="form-control" id="phone_number"
                                                       name="phone_number"
                                                       required>
                                            </div>
                                            <span
                                                class="text-danger">@error('phone_number'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <fieldset class="form-group">
                                                <label for="gender" class="mb-2">Gender</label>
                                                <select name="gender" class="form-select" required>
                                                    <option value="{{ old('gender') }}" hidden></option>
                                                    <option value="male"
                                                            @if (old('gender') == 'male') selected="selected" @endif>
                                                        Male
                                                    </option>
                                                    <option value="female"
                                                            @if (old('gender') == 'female') selected="selected" @endif>
                                                        Female
                                                    </option>
                                                    <option value="other"
                                                            @if (old('gender') == 'other') selected="selected" @endif>
                                                        Other
                                                    </option>
                                                </select>
                                            </fieldset>
                                            <span
                                                class="text-danger">@error('gender'){{ $message }}@enderror</span>
                                        </div>

                                        <div class="col-sm-12 col-md-6">
                                            <fieldset class="form-group">
                                                <label for="blood_group" class="mb-2">Blood Group</label>
                                                <select name="blood_group" class="form-select" required>
                                                    <option value="{{ old('blood_group') }}" hidden></option>
                                                    <option value="a+"
                                                            @if (old('blood_group') == 'a+') selected="selected" @endif>
                                                        A+
                                                    </option>
                                                    <option value="a-"
                                                            @if (old('blood_group') == 'a-') selected="selected" @endif>
                                                        A-
                                                    </option>
                                                    <option value="b+"
                                                            @if (old('blood_group') == 'b+') selected="selected" @endif>
                                                        B+
                                                    </option>
                                                    <option value="b-"
                                                            @if (old('blood_group') == 'b-') selected="selected" @endif>
                                                        B-
                                                    </option>
                                                    <option value="o+"
                                                            @if (old('blood_group') == 'o+') selected="selected" @endif>
                                                        O+
                                                    </option>
                                                    <option value="o-"
                                                            @if (old('blood_group') == 'o-') selected="selected" @endif>
                                                        O-
                                                    </option>
                                                    <option value="ab+"
                                                            @if (old('blood_group') == 'ab+') selected="selected" @endif>
                                                        AB+
                                                    </option>
                                                    <option value="ab-"
                                                            @if (old('blood_group') == 'ab-') selected="selected" @endif>
                                                        AB-
                                                    </option>
                                                </select>
                                            </fieldset>
                                            <span
                                                class="text-danger">@error('blood_group'){{ $message }}@enderror</span>
                                        </div>

                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="bag_number" class="mb-2">Bag Number</label>
                                                <input type="text" value="{{old('bag_number') ?? ''}}"
                                                       class="form-control" id="bag_number"
                                                       name="bag_number"
                                                       required>
                                            </div>
                                            <span
                                                class="text-danger">@error('bag_number'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="age" class="mb-2">Date</label>
                                                <input type="date" value="{{old('date') ?? ''}}"
                                                       class="form-control" id="date"
                                                       name="date"
                                                       required>
                                            </div>
                                            <span
                                                class="text-danger">@error('date'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <fieldset class="form-group">
                                                <label for="is_regular_donor" class="mb-2">Regular Donor</label>
                                                <select name="is_regular_donor" class="form-select" required>
                                                    <option value="{{ old('is_regular_donor') }}" hidden></option>
                                                    <option value="true"
                                                            @if (old('is_regular_donor') == 'true') selected="selected" @endif>
                                                        Yes
                                                    </option>
                                                    <option value="false"
                                                            @if (old('is_regular_donor') == 'false') selected="selected" @endif>
                                                        No
                                                    </option>
                                                </select>
                                            </fieldset>
                                            <span
                                                class="text-danger">@error('is_regular_donor'){{ $message }}@enderror</span>
                                        </div>

                                        <div class="col- mt-2">
                                            <label for="address" class="mt-2 font-weight-bolder">
                                                Address</label>
                                            <hr style="margin: 10px 0px">
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="address['country']"
                                                       class="mb-2">Country</label>
                                                <input type="text" name="address[country]"
                                                       id="country" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="address[district]"
                                                       class="mb-2">District</label>
                                                <input type="text" name="address[district]" id="present_district"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="address[upazila]" class="mb-2">Thana/Upozila</label>
                                                <input type="text" name="address[upazila]" id="present_upazila"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="address[post_code]" class="mb-2">Post
                                                    Code</label>
                                                <input type="text" name="address[post_code]" id="present_post"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="address[address_line1]" class="mb-2">Address
                                                    Line 1</label>
                                                <textarea class="form-control"
                                                          name="address[address_line1]" id="present_add1" rows="2" required></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="address[address_line2]" class="mb-2">Address
                                                    Line 2</label>
                                                <textarea class="form-control"
                                                          name="address[address_line2]" id="present_add2" rows="2"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit
                                            </button>
                                        </div>
                                    </div>
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
        //For Image Preview
        $("#image").on('change', function () {
            var imgPath = $(this)[0].value;
            var extension = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            if (extension === "gif" || extension === "png" || extension === "jpg" || extension === "jpeg") {
                if (typeof (FileReader) != "undefined") {

                    var image_holder = $("#image-holder");
                    image_holder.empty();

                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $("<img />", {
                            "src": e.target.result,
                            "class": "img-thumbnail"
                        }).appendTo(image_holder);
                    };
                    image_holder.show();
                    reader.readAsDataURL($(this)[0].files[0]);
                } else {
                    alert("This browser does not support FileReader.");
                }
            } else {
                alert("Please Select Image Only !");
            }
        });
        $("input[name*='same_as_present']").click(function (){
            $("#permanent_country").val($("#present_country").val());
            $("#permanent_district").val($("#present_district").val());
            $("#permanent_upazila").val($("#present_upazila").val());
            $("#permanent_post").val($("#present_post").val());
            $("#permanent_add1").val($("#present_add1").val());
            $("#permanent_add2").val($("#present_add2").val());
        })
    </script>
@endpush

