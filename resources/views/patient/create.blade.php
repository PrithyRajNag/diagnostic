@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">{{'Create Patient'}}</h3>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('patient.index')}}" class="btn-sm btn-primary">BACK</a>
                            </div>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" id="createForm" action="{{route('patient.store')}}" method="POST"  enctype="multipart/form-data">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="first_name" class="mb-2"><span class="required">*</span>
                                                    First Name</label>
                                                <input type="text" class="form-control" id="first_name"
                                                       name="first_name" value="{{ old('first_name') }}"
                                                       placeholder="First Name">
                                            </div>
                                            <span class="text-danger">@error('first_name'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="last_name" class="mb-2"><span class="required">*</span> Last
                                                    Name</label>
                                                <input type="text" class="form-control" id="last_name" name="last_name"
                                                       value="{{ old('last_name') }}"
                                                       placeholder="Last Name">
                                            </div>
                                            <span class="text-danger">@error('last_name'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="age" class="mb-2"><span class="required">*</span>
                                                    Age</label>
                                                <input type="number" min="0" class="form-control" id="age" name="age"
                                                       value="{{ old('age') }}"
                                                       placeholder="Age">
                                            </div>
                                            <span class="text-danger">@error('age'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="phone_number" class="mb-2"><span class="required">*</span>
                                                    Phone Number</label>
                                                <input type="text" class="form-control" id="phone_no" name="phone_no"
                                                       value="{{ old('phone_no') }}"
                                                       placeholder="+88">
                                            </div>
                                            <span class="text-danger">@error('phone_no'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <fieldset class="form-group">
                                                <label for="gender" class="mb-2 d-flex align-items-center"><span class="required">*</span> Gender</label>
                                                <select name="gender" class="form-control select2" style="width: 100%" required>
                                                    <option hidden value=""></option>
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
                                                <label for="blood_group" class="mb-2 d-flex align-items-center">Blood Group</label>
                                                <select name="blood_group" class="form-control select2" style="width: 100%">
                                                    <option hidden value=""></option>
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
                                                <label for="religion" class="mb-2 d-flex align-items-center">Religion</label>
                                                <select name="religion" class="form-control select2"  style="width: 100%">
                                                    <option hidden value=""></option>
                                                    <option value="hinduism"
                                                            @if (old('religion') == 'hinduism') selected="selected" @endif>
                                                        Hinduism
                                                    </option>
                                                    <option value="islam"
                                                            @if (old('religion') == 'islam') selected="selected" @endif>
                                                        Islam
                                                    </option>
                                                    <option value="buddhist"
                                                            @if (old('religion') == 'buddhist') selected="selected" @endif>
                                                        Buddhist
                                                    </option>
                                                    <option value="christian"
                                                            @if (old('religion') == 'christian') selected="selected" @endif>
                                                        Christian
                                                    </option>
                                                </select>
                                            </div>
                                            <span class="text-danger">@error('religion'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="address" class="mb-2">Address</label>
                                                <textarea class="form-control" name="address"
                                                          rows="2">{{ old('address') }}</textarea>
                                            </div>
                                            <span class="text-danger">@error('address'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="dob" class="mb-2">Date of Birth</label>
                                                <input type="date" class="form-control" id="dob" name="dob">
                                            </div>
                                            <span class="text-danger">@error('dob'){{ $message }}@enderror</span>
                                        </div>

                                        {{--      /////////Need For Hospital//////////--}}
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="admit_date" class="mb-2">Admit Date & Time</label>
                                                <input type="datetime-local" class="form-control" id="admit_date"
                                                       name="admit_date" value="{{ old('admit_date') }}">
                                            </div>
                                            <span class="text-danger">@error('admit_date'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="discharge_date" class="mb-2">Discharge Date & Time</label>
                                                <input type="datetime-local" class="form-control" id="discharge_date"
                                                       name="discharge_date" value="{{ old("discharge_date") }}">
                                            </div>
                                            <span
                                                class="text-danger">@error("discharge_date"){{ $message }}@enderror</span>
                                        </div>

                                        <div class="col- my-2">
                                            <label for="attendee_information" class="mt-2 font-weight-bolder">Attendee
                                                Information</label>
                                            <hr style="margin: 10px 0px">
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="attendee_name" class="mb-2">Attendee Name</label>
                                                <input type="text" class="form-control" id="attendee_name"
                                                       name="attendee_name" value="{{ old('attendee_name') }}"
                                                       placeholder="Attendee Name">
                                            </div>
                                            <span
                                                class="text-danger">@error('attendee_name'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="attendee_relation" class="mb-2 d-flex align-items-center">Attendee Relation</label>
                                                <select name="attendee_relation" class="form-control select2"  style="width: 100%">
                                                    <option hidden value=""></option>
                                                    <option value="father"
                                                            @if (old('attendee_relation') == 'father') selected="selected" @endif>
                                                        Father
                                                    </option>
                                                    <option value="mother"
                                                            @if (old('attendee_relation') == 'mother') selected="selected" @endif>
                                                        Mother
                                                    </option>
                                                    <option value="sister"
                                                            @if (old('attendee_relation') == 'sister') selected="selected" @endif>
                                                        Sister
                                                    </option>
                                                    <option value="brother"
                                                            @if (old('attendee_relation') == 'brother') selected="selected" @endif>
                                                        Brother
                                                    </option>
                                                    <option value="husband"
                                                            @if (old('attendee_relation') == 'husband') selected="selected" @endif>
                                                        Husband
                                                    </option>
                                                    <option value="wife"
                                                            @if (old('attendee_relation') == 'wife') selected="selected" @endif>
                                                        Wife
                                                    </option>
                                                    <option value="son"
                                                            @if (old('attendee_relation') == 'son') selected="selected" @endif>
                                                        Son
                                                    </option>
                                                    <option value="daughter"
                                                            @if (old('attendee_relation') == 'daughter') selected="selected" @endif>
                                                        Daughter
                                                    </option>
                                                    <option value="other"
                                                            @if (old('attendee_relation') == 'other') selected="selected" @endif>
                                                        Other
                                                    </option>
                                                </select>
                                            </div>
                                            <span
                                                class="text-danger">@error('attendee_relation'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="attendee_phone_no" class="mb-2">Attendee Contact</label>
                                                <input type="text" class="form-control" id="attendee_phone_no"
                                                       name="attendee_phone_no" value="{{ old('attendee_phone_no') }}"
                                                       placeholder="Attendee Contact">
                                            </div>
                                            <span
                                                class="text-danger">@error('attendee_phone_no'){{ $message }}@enderror</span>
                                        </div>

                                        <div class=" my-2">
                                            <label for="doctor_information" class="mt-2 font-weight-bolder ">Doctor
                                                Information (<span class="required">*</span> If Exists)</label>
                                            <hr style="margin: 10px 0px">
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="doctor_type" class="mb-2 d-flex align-items-center">Doctor Type</label>
                                                <select name="doctor_type" id="doctor_type" class="form-control select2"  style="width: 100%">
                                                    <option hidden value=""></option>
                                                    <option value="INDOOR">Indoor</option>
                                                    <option value="OUTDOOR">Outdoor</option>
                                                </select>
                                            </div>
                                            <span
                                                class="text-danger">@error('doctor_type'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <fieldset class="form-group">
                                                <label for="department_id" class="mb-2 d-flex align-items-center">
                                                    Department</label>
                                                <select name="department_id" id="department_id" class="form-control select2"  style="width: 100%" disabled>
                                                    <option hidden value="{{ old('department_id') }}"></option>
                                                    @foreach($departments as $department)
                                                        <option
                                                            value="{{ $department->id }}">{{ $department->title }}</option>
                                                    @endforeach
                                                </select>
                                            </fieldset>
                                            <span
                                                class="text-danger">@error('department_id'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="doctor_id" class="mb-2 d-flex align-items-center">Doctor Name</label>
                                                <select  id="doctor_id" class="form-control select2"  style="width: 100%" disabled>
                                                    <option hidden value=""></option>
                                                </select>
                                            </div>
                                            <span class="text-danger">@error('doctor_id'){{ $message }}@enderror</span>
                                            <input type="text" class="form-control" id="doctor"
                                                   name="doctor_id" hidden>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="assign_date" class="mb-2">Assign Date</label>
                                                <input type="date" class="form-control" id="assign_date"
                                                       name="assign_date" value="{{ old('assign_date') }}">
                                            </div>
                                            <span
                                                class="text-danger">@error('assign_date'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="release_date" class="mb-2">Release Date</label>
                                                <input type="date" class="form-control" id="release_date"
                                                       name="release_date" value="{{ old('release_date') }}">
                                            </div>
                                            <span
                                                class="text-danger">@error('release_date'){{ $message }}@enderror</span>
                                        </div>
                                        <div class=" my-2">
                                            <label for="other_information" class="mt-2 font-weight-bolder">Other
                                                Information</label>
                                            <hr style="margin: 10px 0px">
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="package_id" class="mb-2 d-flex align-items-center">Package Name</label>
                                                <select name="package_id" class="form-control select2"  style="width: 100%">
                                                    <option hidden value="{{ old('package_id') }}"></option>
                                                    @foreach($packages as $package)
                                                        <option
                                                            value="{{ $package->id }}">{{ $package->package_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <span class="text-danger">@error('package_id'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="status"><span class="required">*</span> Status</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status"
                                                           id="active"
                                                           value="1" @if( old('status')) == "1" ? 'checked' : '' @endif
                                                    required>
                                                    <label class="form-check-label" for="active">Active</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status"
                                                           id="inactive"
                                                           value="0" @if( old('status')) == "0" ? 'checked' : '' @endif
                                                    required>
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
        $(document).ready(function () {
            $('#doctor').val($('#doctor_id').val());


            $('#doctor_type').on('change', function (d) {
                let doctor_type = d.target.value;
                document.getElementById("department_id").disabled = false;
                let doctor_department = $("#department_id").val();
                if(doctor_type != null && doctor_department != null ){
                    fetch(`/patient/get-doctor/${doctor_type}/${doctor_department}`)
                        .then(res => res.json())
                        .then(res => {
                            let html = '<option hidden></option>'
                            res.forEach(doctor_id => {
                                html += `<option value="${doctor_id.id}">${doctor_id.first_name + ' ' + doctor_id.last_name}</option>`
                            })
                            $('#doctor_id').html(html)
                        })
                        .catch(err => {
                            console.log(err)
                        })
                }

            })
            $('#department_id').on('change', function (e) {
                let doctor_department = e.target.value;
                document.getElementById("doctor_id").disabled = false;
                let doctor_type = $("#doctor_type").val();
                if(doctor_type != null && doctor_department != null ) {
                    fetch(`/patient/get-doctor/${doctor_type}/${doctor_department}`)
                        .then(res => res.json())
                        .then(res => {
                            let html = '<option hidden> </option>'
                            res.forEach(doctor_id => {
                                html += `<option value="${doctor_id.id}">${doctor_id.first_name + ' ' + doctor_id.last_name}</option>`

                            })
                            $('#doctor_id').html(html)
                        })
                        .catch(err => {
                            console.log(err)
                        })
                }
            })
            $('#doctor_id').on('change', function (e) {
                $('#doctor').val($('#doctor_id').val());
            })
        })
        $("#createForm").validate({
            errorPlacement: function (error, e) {
                e.parents('.form-group').append(error);
            },
            rules: {
                first_name: "required",
                last_name: "required",
                phone_no: {
                    required:true,
                    maxlength:11
                },
                age: "required",
                status: "required",
            },
            messages: {
                first_name: "First Name is required",
                last_name: "Last Name is required",
                phone_no: {
                    required:"Phone Number is required",
                    maxlength: "Phone Number is greater than 11 digits"
                },
                age: "Age is required",
                status: "Status is required",
            }
        });
        $(".select2").select2({
            allowClear: true
        })
    </script>

@endpush
