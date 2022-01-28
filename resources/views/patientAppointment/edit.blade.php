@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Edit Appointment Information</h3>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('appointment.index')}}" class="btn-sm btn-primary">BACK</a>
                            </div>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" action="{{route('appointment.update', $appointment->uuid)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="patient_id" class="mb-2 d-flex align-items-center">PID</label>
                                                <select name="patient_id" class="form-select select2"style="width: 100%"  disabled>
                                                    <option hidden value="" >{{old('patient_id', $appointment->patients->pid ?? '')}}</option>
                                                    @foreach($patients as $patient)
                                                        <option value="{{ $patient->id }}" {{$appointment->patient_id == $patient->id ? "selected" : '' }}>{{ $patient->pid }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <span class="text-danger">@error('patient_id'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="first_name" class="mb-2"><span class="required">*</span> First Name</label>
                                                <input type="text" class="form-control" id="first_name" value="{{$appointment->patients->first_name}}"
                                                       name="first_name"  required readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="last_name" class="mb-2"><span class="required">*</span> Last Name</label>
                                                <input type="text" class="form-control" id="last_name" value="{{$appointment->patients->last_name}}"
                                                       name="last_name"  required readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="phone_no" class="mb-2"><span class="required">*</span> Phone Number</label>
                                                <input type="text" class="form-control" id="phone_no" value="{{$appointment->patients->phone_no}}"
                                                       name="phone_no"  required readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="age" class="mb-2"><span class="required">*</span> Age</label>
                                                <input type="text" class="form-control" id="age" value="{{$appointment->patients->age}}"
                                                       name="age"  required readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="gender" class="mb-2"><span class="required">*</span> Gender</label>
                                                <input type="text" class="form-control" id="gender" value="{{ucfirst($appointment->patients->gender)}}"
                                                       name="gender"  required readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="doctor_type" class="mb-2 d-flex align-items-center">Doctor Type</label>
                                                <select  id="doctor_type" class="form-control select2" style="width: 100%">
                                                    <option hidden value="{{ $appointment->doctors->user_type ?? '' }}">{{ $appointment->doctors->user_type ?? '' }}</option>
<option value="INDOOR">Indoor</option>
                                                    <option value="OUTDOOR">Outdoor</option>
                                                </select>
                                            </div>
                                            <span class="text-danger">@error('doctor_type'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <fieldset class="form-group">
                                                <label for="department_id" class="mb-2 d-flex align-items-center">Department</label>
                                                <select name="department_id" id="department_id" class="department form-select select2" style="width: 100%" disabled>
                                                    <option hidden value="{{$appointment->doctors->departments->title ?? ''}}">{{$appointment->doctors->departments->title ?? ''}}</option>
@foreach($departments as $department)
                                                        <option
                                                            value="{{ $department->id }}">{{ $department->title }}</option>
                                                    @endforeach
                                                </select>
                                            </fieldset>
                                            <span class="text-danger">@error('department_id'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <fieldset class="form-group">
                                                <label for="doctor_id" class="mb-2 d-flex align-items-center">Doctor Name</label>
                                                <select name="doctor_id" id="doctor_id" class="doctor form-select select2" style="width: 100%" disabled>
<option hidden value="{{ $appointment->doctors->id ?? '' }}">{{ $appointment->doctors->full_name ?? '' }}</option>
                                                </select>
                                            </fieldset>
                                            <span class="text-danger">@error('doctor_id'){{ $message }}@enderror</span>
                                            <input type="text" name="doctor_id" id="doctor" hidden>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="appointment_date" class="mb-2">Appointment Date</label>
<input type="text" name="appointment_date" id="appointment_date"
                                                       class="form-control input-date" value="{{ old('appointment_date', $appointment->appointment_date) }}">
                                            </div>
                                            <span class="text-danger">@error('appointment_date'){{ $message }}@enderror</span>
                                        </div>

                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="schedule_id" class="mb-2">Slot</label>
                                                <div class="form-check">

                                                    <input class="form-check-input form-check-success" type="radio" name="schedule_id" value="{{$appointment->schedule_id}}" checked  >
                                                    <label class="form-check-label" for="schedule_id" >{{date('h:i a', strtotime($appointment->schedules->start_time)) . ' - '. date('h:i a', strtotime($appointment->schedules->end_time)) }}</label>
                                                    <ul class="p-0" id="slots"></ul>

                                                </div>
                                            </div>
                                            <span class="text-danger">@error('slot'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="problem" class="mb-2">Problem</label>
                                                <textarea class="form-control"
                                                          name="problem"
                                                          id="problem"
                                                          rows="3">{{$appointment->problem}}</textarea>
                                            </div>
                                            <span class="text-danger">@error('problem'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status" id="active"
                                                           value="1" {{($appointment->status == "1") ? "checked" : ""}}>
                                                    <label class="form-check-label" for="active">Active</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status" id="inactive"
                                                           value="0" {{($appointment->status == "0") ? "checked" : ""}}>
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
    $('.input-date').datepicker({
        format: 'yyyy-mm-dd',
        autoclose:true
    });
    $(document).ready(function () {
        let doctor = $('#doctor_id').val()
        $('#doctor').val(doctor)
    })
    $('#doctor_id').on('change', function (){
        document.getElementById("doctor").disabled = true;
    })

    $('#doctor_type').on('change', function (d) {
        let doctor_type = d.target.value;
        console.log(d.target.value)
        document.getElementById("department_id").disabled = false;

        let doctor_department = $("#department_id").val();
        if(doctor_type != null && doctor_department != null ){
            fetch(`/appointment/get-doctor/${doctor_type}/${doctor_department}`)
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
            fetch(`/appointment/get-doctor/${doctor_type}/${doctor_department}`)

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


    $('#appointment_date').on('change', function (e) {
        let appointment_date = e.target.value;
        console.log(appointment_date)
        let doctor = $("#doctor_id").val()
        let days = ["sunday", "monday", "tuesday", "wednesday", "thursday", "friday", "saturday"];
        let today= days[new Date(appointment_date).getDay()]
        console.log(today)

        fetch(`/appointment/get-slot/${doctor}/${today}`)
            .then(res => res.json())
            .then(res => {
                console.log(res)
                if (res.length === 0){
                    $("#slots").html('<span class="error font-bold">No schedule found for selected date</span>')
                }
                else {
                    $("#slots").html(res.map((slot) => `<div class="form-check"><input class="form-check-input form-check-success" type="radio" name="schedule_id" id="schedule_id" value="${slot.id}" required><label class="form-check-label" for="time">${tConvert(slot.start_time) + ' - ' + tConvert(slot.end_time)}</label></div>`).join(' '))
                }

            })
            .catch(err => {
                console.log(err)
            })
    })

    //convert 24 hour format time 12 hour format time
    function tConvert (time) {
        // Check correct time format and split into components
        time = time.toString().match (/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];

        if (time.length > 1) { // If time format correct
            time = time.slice (1);  // Remove full string match value
            time[5] = +time[0] < 12 ? 'am' : 'pm'; // Set AM/PM
            time[0] = +time[0] % 12 || 12; // Adjust hours
        }
        return time.join (''); // return adjusted time or original string
    }

    $(".select2").select2({
        allowClear: true
    })
    $(".department").select2({
        placeholder : '-- Select Doctor Type First --',
        allowClear: true
    })
    $(".doctor").select2({
        placeholder : '-- Select Department First --',
        allowClear: true
    })




</script>
@endpush

