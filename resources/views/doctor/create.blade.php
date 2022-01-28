@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Create Doctor</h3>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('doctor.index')}}" class="btn-sm btn-primary">BACK</a>
                            </div>
                            <hr/>
                        </div>
                    </div>
                    <div>
                        <nav>
                            <div class="nav nav-tabs justify-content-center font-size" id="nav-tab">
                                <button class="nav-link active" id="profile" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Profile</button>
                                <button class="nav-link" id="education" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Education</button>
                                <button class="nav-link" id="qualification" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Qualification</button>
                            </div>
                        </nav>
                    </div>

                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form id="createForm" class="form form-vertical" action="{{route('doctor.store')}}"
                                  method="POST" enctype="multipart/form-data">
                                @csrf
                                @if($errors->any())
                                    <span class="text-danger font-italic">Message: {{ implode(', ', $errors->all(':message')) }}<br> please fill out indicated field(s)</span>
@endif
                                <div class="form-body">
                                    <div class="row">
                                        <div class="mainProfile row">
                                            <div class="col-sm-12 col-md-12 text-center my-4">
                                                <div class="avatar avatar-xl">
                                                    <img src="https://www.w3schools.com/howto/img_avatar.png"
                                                         alt="" srcset="">
                                                </div>
                                                <div class="form-file mt-2" style="margin-left: 8px">
                                                    <label class="form-file-label" for="image">
                                                        <input type="file" class="form-file-input" name="image" id="image"
                                                               hidden required>
                                                        <span class="form-file-button"><i data-feather="upload"></i></span>
                                                    </label>
                                                    <div class="form-group col-sm-6">
                                                        <div id="image-holder"
                                                             style="width: 200px; position: relative"></div>
                                                    </div>
                                                    <span class="text-danger">@error('image'){{ $message }}@enderror</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="email" class="mb-2 d-flex align-items-center"><span
                                                            class="required">*</span> Email Address</label>
                                                    <input type="email" class="form-control" id="email" name="email"
                                                           value="{{ old('email') }}"
                                                           placeholder="example@gmail.com" required>
                                                </div>
                                                <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <fieldset class="form-group">
                                                    <label for="department_id" class="mb-2 d-flex align-items-center"><span class="required">*</span>
                                                        Department</label>
                                                    <select name="department_id" class="form-control select2" style="width: 100%"  required>
                                                        <option hidden value="{{ old('department_id') }}"></option>
                                                        @foreach($departments as $department)
                                                            <option
                                                                value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected': '' }}>{{ $department->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </fieldset>
                                                <span
                                                    class="text-danger">@error('department_id'){{ $message }}@enderror</span>
                                            </div>
                                            <x-doctor-view></x-doctor-view>
                                        </div>

                                        <div class="showEducation row">
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="degree_level" class="mb-2 d-flex align-items-center"> Degree Level</label>
                                                    <input type="text" class="form-control" id="degree_level" name="degree_level"
                                                           value="{{ old('degree_level') }}"
                                                    >
                                                </div>
                                                <span class="text-danger">@error('degree_level'){{ $message }}@enderror</span>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="degree" class="mb-2 d-flex align-items-center"> Degree</label>
                                                    <input type="text" class="form-control" id="degree" name="degree"
                                                           value="{{ old('degree') }}">
                                                </div>
                                                <span class="text-danger">@error('degree'){{ $message }}@enderror</span>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="passing_year" class="mb-2 d-flex align-items-center">Passing Year</label>
                                                    <input type="number" min="0" class="form-control" id="passing_year" name="passing_year"
                                                           value="{{ old('passing_year') }}">
                                                </div>
                                                <span class="text-danger">@error('passing_year'){{ $message }}@enderror</span>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="result" class="mb-2 d-flex align-items-center">Result</label>
                                                    <input type="text" class="form-control" id="result" name="result"
                                                           value="{{ old('result') }}">
                                                </div>
                                                <span class="text-danger">@error('result'){{ $message }}@enderror</span>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="board_university" class="mb-2 d-flex align-items-center">Board / University</label>
                                                    <input type="text" class="form-control" id="board_university" name="board_university"
                                                           value="{{ old('board_university') }}">
                                                </div>
                                                <span class="text-danger">@error('board_university'){{ $message }}@enderror</span>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="major" class="mb-2 d-flex align-items-center">Major</label>
                                                    <input type="text" class="form-control" id="major" name="major"
                                                           value="{{ old('major') }}">
                                                </div>
                                                <span class="text-danger">@error('major'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="showQualification row">
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="org_name" class="mb-2 d-flex align-items-center">Organization Name</label>
                                                    <input type="text" class="form-control" id="org_name" name="org_name"
                                                           value="{{ old('org_name') }}"
                                                    >
                                                </div>
                                                <span class="text-danger">@error('org_name'){{ $message }}@enderror</span>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="position" class="mb-2 d-flex align-items-center">Position</label>
                                                    <input type="text" class="form-control" id="position" name="position"
                                                           value="{{ old('position') }}">
                                                </div>
                                                <span class="text-danger">@error('position'){{ $message }}@enderror</span>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="start_date" class="mb-2 d-flex align-items-center">Start Date</label>
                                                    <input type="date" min="0" class="form-control" id="start_date" name="start_date"
                                                           value="{{ old('start_date') }}">
                                                </div>
                                                <span class="text-danger">@error('start_date'){{ $message }}@enderror</span>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="end_date" class="mb-2 d-flex align-items-center"> End Date</label>
                                                    <input type="date" class="form-control" id="end_date" name="end_date"
                                                           value="{{ old('end_date') }}">
                                                </div>
                                                <span class="text-danger">@error('end_date'){{ $message }}@enderror</span>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="duration" class="mb-2 d-flex align-items-center">Duration</label>
                                                    <input type="text" class="form-control" id="duration" name="duration"
                                                           value="{{ old('duration') }}">
                                                </div>
                                                <span class="text-danger">@error('duration'){{ $message }}@enderror</span>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="responsibilities" class="mb-2 d-flex align-items-center">Responsibilities</label>
                                                    <textarea class="form-control"
                                                              name="responsibilities" id="responsibilities"
                                                              rows="2"></textarea>
                                                </div>
                                                <span class="text-danger">@error('responsibilities'){{ $message }}@enderror</span>
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
        $(document).ready(function (){
            $('.showEducation').hide()
            $('.showQualification').hide()

            $('#education').on('click', function (e){
                $('.mainProfile').hide()
                $('.showEducation').show()
                $('.showQualification').hide()
            })
            $('#qualification').on('click', function (e){
                $('.mainProfile').hide()
                $('.showEducation').hide()
                $('.showQualification').show()

            })
            $('#profile').on('click', function (e){
                $('.mainProfile').show()
                $('.showEducation').hide()
                $('.showQualification').hide()

            })

        })


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

        $("input[name*='same_as_present']").click(function () {
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
            rules: {
                first_name: "required",
                last_name: "required",
                email: "required",
                designation: "required",
                department_id: "required",
                phone_number: {
                    required:true,
                    maxlength:11
                },
                dob: "required",
                gender: "required",
                blood_group: "required",
                nid: "required",
                salary: "required",
                present_address: "required",
                permanent_address: "required",
                status: "required",
                user_type: "required",
            },
            messages: {
                first_name: "First Name is required",
                last_name: "Last Name is required",
                email: "Email is required",
                password: "Password is required",
                designation: "Designation is required",
                department_id: "Department is required",
                phone_number: {
                    required:"Phone Number is required",
                    maxlength: "Phone Number is greater than 11 digits"
                },
                dob: "Date of Birth is required",
                nid: "NID is required",
                salary: "Salary is required",
                gender: "Gender is required",
                blood_group: "Blood Group is required",
                status: "Status is required",
                user_type: "User Type is required",
            }
        });

        $(".select2").select2({
            allowClear: true
        })
    </script>
@endpush
