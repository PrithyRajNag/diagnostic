@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Edit Patient Information</h3>
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
                            <form class="form form-vertical" action="{{route('patient.update', $patient->uuid)}}" method="POST" id="editForm">
                                @csrf
                                @method('PUT')
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="first_name" class="mb-2">First Name</label>
                                                <input type="text" value="{{ucwords($patient->first_name)}}"  class="form-control" id="first_name" name="first_name">
                                            </div>
                                            <span class="text-danger">@error('first_name'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="last_name" class="mb-2">Last Name</label>
                                                <input type="text" value="{{ ucwords($patient->last_name )}}" class="form-control" id="last_name" name="last_name">
                                            </div>
                                            <span class="text-danger">@error('last_name'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="age" class="mb-2">Age</label>
                                                <input type="number" value="{{old('age',$patient->age) ?? ''  }}" class="form-control" id="age" name="age">
                                            </div>
                                            <span class="text-danger">@error('age'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="phone_no" class="mb-2">Phone NUmber</label>
                                                <input type="text" value="{{ old('phone_no',$patient->phone_no) }}" class="form-control" id="phone_no" name="phone_no">
                                            </div>
                                            <span class="text-danger">@error('phone_no'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <fieldset class="form-group">
                                                <label for="gender" class="mb-2 d-flex align-items-center">Gender</label>
                                                <select name="gender" class="form-select select2"  style="width: 100%" required>
                                                    <option hidden value=""></option>
                                                    <option value="male" {{ $patient->gender == 'male' ? 'selected': '' }}>Male</option>
                                                    <option value="female" {{ $patient->gender == 'female' ? 'selected': '' }}>Female</option>
                                                    <option value="other" {{ $patient->gender == 'other' ? 'selected': '' }}>Other</option>
                                                </select>
                                            </fieldset>
                                            <span
                                                class="text-danger">@error('gender'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <fieldset class="form-group">
                                                <label for="blood_group" class="mb-2 d-flex align-items-center">Blood Group</label>
                                                <select name="blood_group" class="form-select select2"  style="width: 100%">
                                                    <option hidden value=""></option>
                                                    <option value="a+" {{ $patient->blood_group == 'a+' ? 'selected': '' }}>A+</option>
                                                    <option value="a-" {{ $patient->blood_group == 'a-' ? 'selected': '' }}>A-</option>
                                                    <option value="b+" {{ $patient->blood_group == 'b+' ? 'selected': '' }}>B+</option>
                                                    <option value="b-" {{ $patient->blood_group == 'b-' ? 'selected': '' }}>B-</option>
                                                    <option value="o+" {{ $patient->blood_group == 'o+' ? 'selected': '' }}>O+</option>
                                                    <option value="o-" {{ $patient->blood_group == 'o-' ? 'selected': '' }}>O-</option>
                                                    <option value="ab+" {{ $patient->blood_group == 'ab+' ? 'selected': '' }}>AB+</option>
                                                    <option value="ab-" {{ $patient->blood_group == 'ab-' ? 'selected': '' }}>AB-</option>
                                                </select>
                                            </fieldset>
                                            <span
                                                class="text-danger">@error('blood_group'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <fieldset class="form-group">
                                                <label for="religion" class="mb-2 d-flex align-items-center">Religion</label>
                                                <select name="religion" class="form-select select2"  style="width: 100%">
                                                    <option hidden value=""></option>
                                                    <option value="hinduism" {{ $patient->religion == 'hinduism' ? 'selected': '' }}>Hinduism</option>
                                                    <option value="islam" {{ $patient->religion == 'islam' ? 'selected': '' }}>Islam</option>
                                                    <option value="buddhist" {{ $patient->religion == 'buddhist' ? 'selected': '' }}>Buddhist</option>
                                                    <option value="christian" {{ $patient->religion == 'christian' ? 'selected': '' }}>Christian</option>
                                                </select>
                                            </fieldset>
                                            <span class="text-danger">@error('religion'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="address" class="mb-2">Address</label>
                                                <textarea class="form-control" name="address" rows="3">{{ old('address', $patient->address) }}</textarea>
                                            </div>
                                            <span class="text-danger">@error('address'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="dob" class="mb-2">Date of Birth</label>
                                                <input type="date" value="{{old('dob') ?? $patient->dob ?? ''}}" class="form-control" id="dob" name="dob">
                                            </div>
                                            <span class="text-danger">@error('dob'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="admit_date" class="mb-2">Admit Date & Time</label>
                                                <input type="datetime-local" class="form-control" id="admit_date" name="admit_date" value="{{ date('Y-m-d\TH:i', strtotime($patient->admit_date)) }}">
                                            </div>
                                            <span class="text-danger">@error('admit_date'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="discharge_date" class="mb-2">Discharge Date & Time</label>
                                                <input type="datetime-local" class="form-control" id="discharge_date" name="discharge_date" value="{{ date('Y-m-d\Th:i', strtotime($patient->discharge_date)) }}">
                                            </div>
                                            <span class="text-danger">@error("discharge_date"){{ $message }}@enderror</span>
                                        </div>
                                        {{--      /////////Need For Hospital//////////--}}
                                        <div class="col- my-2">
                                            <label for="other_information" class="mt-2 font-weight-bolder">Attendee
                                                Information</label>
                                            <hr style="margin: 10px 0px">
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="attendee_name" class="mb-2">Attendee Name</label>
                                                <input type="text" class="form-control" id="attendee_name" name="attendee_name" value="{{ $patient->attendee_name ?? '' }}"
                                                       placeholder="Attendee Name">
                                            </div>
                                            <span class="text-danger">@error('attendee_name'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="attendee_relation" class="mb-2 d-flex align-items-center">Attendee Relation</label>
                                                <select name="attendee_relation" class="form-control select2"  style="width: 100%">
                                                    <option hidden value=""></option>
                                                    <option value="father" {{ $patient->attendee_relation == 'father' ? 'selected': '' }}>Father</option>
                                                    <option value="mother" {{ $patient->attendee_relation == 'mother' ? 'selected': '' }}>Mother</option>
                                                    <option value="sister" {{ $patient->attendee_relation == 'sister' ? 'selected': '' }}>Sister</option>
                                                    <option value="brother" {{ $patient->attendee_relation == 'brother' ? 'selected': '' }}>Brother</option>
                                                    <option value="husband" {{ $patient->attendee_relation == 'husband' ? 'selected': '' }}>Husband</option>
                                                    <option value="wife" {{ $patient->attendee_relation == 'wife' ? 'selected': '' }}>Wife</option>
                                                    <option value="son" {{ $patient->attendee_relation == 'son' ? 'selected': '' }}>Son</option>
                                                    <option value="daughter" {{ $patient->attendee_relation == 'daughter' ? 'selected': '' }}>Daughter</option>
                                                </select>
                                            </div>
                                            <span class="text-danger">@error('attendee_relation'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="attendee_phone_no" class="mb-2">Attendee Contact</label>
                                                <input type="text" class="form-control" id="attendee_phone_no" name="attendee_phone_no" value="{{ $patient->attendee_phone_no ?? '' }}" placeholder="Attendee Contact">
                                            </div>
                                            <span class="text-danger">@error('attendee_phone_no'){{ $message }}@enderror</span>
                                        </div>

                                        <div class="col- my-2">
                                            <label for="other_information" class="mt-2 font-weight-bolder">Doctor
                                                Information</label>
                                            <hr style="margin: 10px 0px">
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="doctor_category_id" class="mb-2 d-flex align-items-center">Doctor Type</label>
                                                <select name="doctor_type" id="doctor_type" class="form-control select2"  style="width: 100%">
                                                    <option hidden value=""></option>
                                                    <option value="INDOOR" @if ($patient->doctor_id != null ) {{ $patient->doctors->user_type == 'INDOOR' ? 'selected': '' }}  @endif>Indoor</option>
                                                    <option value="OUTDOOR"  @if ($patient->doctor_id != null) {{ $patient->doctors->user_type == 'OUTDOOR' ? 'selected': '' }} @endif>Outdoor</option>
                                                </select>
                                            </div>
                                            <span class="text-danger">@error('doctor_type'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <fieldset class="form-group">
                                                <label for="department_id" class="mb-2 d-flex align-items-center">
                                                    Department</label>
                                                <select name="department_id" id="department_id" class="form-control select2"  style="width: 100%" disabled required>
                                                    <option hidden value=""></option>
                                                    @foreach($departments as $department)
                                                        <option
                                                            value="{{ $department->id }}" @if ($patient->doctor_id != null ) {{ $patient->doctors->departments->id == $department->id ? 'selected': '' }} @endif>{{ $department->title }}</option>
                                                    @endforeach
                                                </select>
                                            </fieldset>
                                            <span
                                                class="text-danger">@error('department_id'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="doctor_id" class="mb-2 d-flex align-items-center">Doctor Name</label>
                                                <select id="doctor_id" class="form-control select2"  style="width: 100%" disabled>
                                                    <option value="{{ $patient->doctors->id ?? '' }}">{{ $patient->doctors->full_name ?? '' }}</option>
                                                </select>
                                            </div>
                                            <span class="text-danger">@error('doctor_id'){{ $message }}@enderror</span>
                                            <input type="text" class="form-control" id="doctor"
                                                   name="doctor_id" hidden>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="assign_date" class="mb-2">Assign Date</label>
                                                <input type="date" class="form-control" id="assign_date" name="assign_date" value="{{ $patient->assign_date ?? '' }}">
                                            </div>
                                            <span class="text-danger">@error('assign_date'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="release_date" class="mb-2">Release Date</label>
                                                <input type="date" class="form-control" id="release_date" name="release_date" value="{{ $patient->release_date ?? '' }}">

                                            </div>
                                            <span class="text-danger">@error('release_date'){{ $message }}@enderror</span>
                                        </div>

                                        <div class="col- my-2">
                                            <label for="other_information" class="mt-2 font-weight-bolder">Other
                                                Information</label>
                                            <hr style="margin: 10px 0px">
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="package_id" class="mb-2 d-flex align-items-center">Package Name</label>
                                                <select name="package_id" class="form-control select2"  style="width: 100%">
                                                    <option hidden value=""></option>
                                                    @foreach($packages as $package)
                                                        <option
                                                            value="{{ $package->id }}" {{ $patient->package_id == $package->id ? 'selected': '' }}>{{ $package->package_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <span class="text-danger">@error('package_id'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="status"><span class="required">*</span> Status</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status" id="active"
                                                           value="1" {{($patient->status == "1") ? "checked" : ""}}>
                                                    <label class="form-check-label" for="active">Active</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status" id="inactive"
                                                           value="0" {{($patient->status == "0") ? "checked" : ""}}>
                                                    <label class="form-check-label" for="inactive">Inactive</label>
                                                </div>
                                                <span class="text-danger">@error('status'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end mb-2">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
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
                console.log(d.target.value)
                let doctor_type = d.target.value;
                // console.log(e.target.value)
                document.getElementById("department_id").disabled = false;
                let doctor_department = $("#department_id").val();
                if(doctor_type != null && doctor_department != null ){
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
            $('#department_id').on('change', function (e) {
                console.log(e.target.value)
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
        })
        $('#doctor_id').on('change', function (e) {
            $('#doctor').val($('#doctor_id').val());
        })
        $(".select2").select2({
            allowClear: true
        })
        $("#editForm").validate({
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
    </script>
@endpush

