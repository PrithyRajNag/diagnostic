@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Create Appointment</h3>
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
                            <form id="createForm" class="form form-vertical" action="{{route('appointment.store')}}" method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="row form-group">
                                                <label for="has_pid" class="mb-2">Do you have PID?<small> (please select)</small> </label>
                                                <div class="form-check col-md-4" style="margin-left: 10px">
                                                    <input class="form-check-input" type="radio" name="has_pid" id="yes"
                                                           value="1">
                                                    <label class="form-check-label" for="yes">Yes</label>
                                                </div>
                                                <div class="form-check col-md-4">
                                                    <input class="form-check-input" type="radio" name="has_pid" id="no"
                                                           value="0">
                                                    <label class="form-check-label" for="no">No</label>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <fieldset class="form-group">
                                                <label for="patient_id" class="mb-2 d-flex align-items-center">PID</label>
                                                <select name="patient_id" id="patient_id" class="form-select select2" style="width: 100%">
                                                    <option hidden value=""></option>
                                                    @foreach($patients as $patient)
                                                        <option value="{{ $patient->id }}">{{ $patient->pid }}</option>
                                                    @endforeach
                                                </select>
                                            </fieldset>
                                            <span class="text-danger">@error('patient_id'){{ $message }}@enderror</span>
                                        </div>
                                        <div id="no_pid">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="first_name" class="mb-2"><span class="required">*</span> First Name</label>
                                                        <input type="text" class="form-control" id="first_name"
                                                               name="first_name" placeholder="First Name" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="last_name" class="mb-2"><span class="required">*</span> Last Name</label>
                                                        <input type="text" class="form-control" id="last_name"
                                                               name="last_name" placeholder="Last Name" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="phone_no" class="mb-2"><span class="required">*</span> Phone Number </label>
                                                        <input type="text" class="form-control" id="phone_no"
                                                               name="phone_no" placeholder="Phone Number" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="age" class="mb-2"> Age</label>
                                                        <input type="number" min="0" class="form-control" id="age" name="age"
                                                               value="{{ old('age') }}"
                                                               placeholder="Age" >
                                                    </div>
                                                    <span class="text-danger">@error('age'){{ $message }}@enderror</span>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="gender" class="mb-2 d-flex align-items-center">Gender</label>
                                                        <select name="gender" id="gender"
                                                                class="form-control selector select2" style="width: 100%" >
                                                            <option hidden value="" ></option>
                                                            <option value="male"
                                                                    @if (old('gender') == 'male') selected="selected" @endif >
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
                                                    </div>
                                                    <span class="text-danger">@error('gender'){{ $message }}@enderror</span>
                                                </div>
                                            </div>

                                        </div>



                                        <div class="col-sm-12 col-md-6">
                                            <fieldset class="form-group">
                                                <label for="doctor_type" class="mb-2 d-flex align-items-center">Doctor Type</label>
                                                <select  id="doctor_type" class="form-control select2" style="width: 100%">
                                                    <option hidden value=""></option>
                                                    <option value="INDOOR">Indoor</option>
                                                    <option value="OUTDOOR">Outdoor</option>
                                                </select>
                                            </fieldset>
                                            <span
                                                class="text-danger">@error('doctor_type'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <fieldset class="form-group">
                                                <label for="department_id" class="mb-2 d-flex align-items-center">Department</label>
                                                <select  id="department_id" class="department form-select select2" style="width: 100%" disabled>
                                                    <option hidden></option>
                                                    @foreach($departments as $department)
                                                        <option value="{{ $department->id }}">{{ $department->title }}</option>
                                                    @endforeach
                                                </select>
                                            </fieldset>
                                            <span class="text-danger">@error('department_id'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <fieldset class="form-group">
                                                <label for="doctor_id" class="mb-2 d-flex align-items-center">Doctor Name</label>
                                                <select name="doctor_id" id="doctor_id" class="doctor form-select select2" style="width: 100%" disabled >
                                                    <option hidden value=""></option>
                                                </select>
                                                <span class="mb-0" style="color: red; font-family: -apple-system" id="no-doctor"></span>
                                            </fieldset>
{{--                                            <input type="text" name="doctor_name" id="doctor_name">--}}
                                            <span class="text-danger">@error('doctor_id'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="appointment_date" class="mb-2">Appointment Date</label>
                                                <input type="text" name="appointment_date" id="appointment_date"
                                                       class="form-control input-date" value="{{ old('appointment_date') }}">
                                            </div>
                                            <span class="text-danger">@error('appointment_date'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="schedule_id" class="mb-2">Time Slot</label>
                                                <ul  class="error" id="slots"></ul>
                                            </div>
                                            <span class="text-danger">@error('schedule_id'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="problem" class="mb-2">Problem</label>
                                                <textarea class="form-control"
                                                          name="problem" id="problem"
                                                          rows="2"
                                                          >{{ old("problem")  }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="status" class="mb-2">Status</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status" id="active"
                                                           value="1">
                                                    <label class="form-check-label" for="active">Active</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status" id="inactive"
                                                           value="0">
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
        $('#no').on('click', function (){
            $('#no_pid').show()
            $('#patient_id').attr('disabled', true)
        })
        $('#yes').on('click', function (){
            $('#no_pid').hide()
            $('#patient_id').attr('disabled', false)
        })
        $('#patient_id').on('change', function (){
            $('#no_pid').show()
        })

        $('.input-date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose:true
        });

        $('#doctor_type').on('change', function (d) {
            let doctor_type = d.target.value;
            console.log(d.target.value)
            document.getElementById("department_id").disabled = false;
            let doctor_department = $("#department_id").val();
            if(doctor_type != null && doctor_department != null ){
                fetch(`/appointment/get-doctor/${doctor_type}/${doctor_department}`)
                    // console.log(response)
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
                    if (res.length === 0 ){
                        $("#slots").html('<span class="error font-bold">No schedule found for selected date</span>')
                    }
                    else {
                        // $("#slots").html(res.map((slot) => `<div class="form-check check-time"><input class="form-check-input form-check-success" type="radio" name="schedule_id" id="schedule_id" value="${slot.id}" required><label class="form-check-label" for="schedule_id">${tConvert(slot.start_time) + ' - ' + tConvert(slot.end_time)}</label></div>`).join(' '))
                        $("#slots").html(res.map((slot) => `<div class="form-check check-time"><input class="form-check-input form-check-success" type="radio" name="schedule_id" id="schedule_id" value="${slot.id}" required><label class="form-check-label" >${tConvert(slot.start_time) + ' - ' + tConvert(slot.end_time)}</label></div><input type="radio" name="appointment_time" id="appointment_time" value="${tConvert(slot.start_time) + ' - ' + tConvert(slot.end_time)}" hidden>`).join(' '))

                    }
                    let chk1 = $("input:radio[id='schedule_id']");
                    chk1.on('change', function () {
                        $(this).closest("div").next().prop('checked', $(this).is(":checked"));
                    });


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

        $(document).ready(function () {
            $('#no_pid').hide()
            $('#patient_id').attr('disabled', true)

            $("#patient_id").change(function (e) {
                let patientId = e.target.value;
                console.log(patientId)
                if(patientId.length === 0){
                    $('#first_name').val('').attr('readonly',false)
                    $('#last_name').val('').attr('readonly',false)
                    $('#phone_no').val('').attr('readonly',false)
                    $('#age').val('').attr('readonly',false)
                    const option = new Option('', '', false, true)
                    $('.selector').append(option).trigger('change').attr('disabled',false);
                }
                fetch(`/appointment/get-patient/${patientId}`)
                    .then(res => res.json())
                    .then(res => {
                        console.log(res)
                        $('#first_name').val(res.first_name).attr('readonly','readonly')
                        $('#last_name').val(res.last_name).attr('readonly','readonly')
                        $('#phone_no').val(res.phone_no).attr('readonly','readonly')
                        $('#age').val(res.age).attr('readonly','readonly')
                        for (let i = 0; i < 3; i++) {
                            $(`.selector option[value=${res.gender}]`).remove()
                        }
                        const option = new Option(res.gender.toUpperCase(), res.gender, true, true)
                        $('.selector').append(option).trigger('change').attr("disabled",true);
                    })
                    .catch(err => {
                        console.log(err)
                    })
            })
        })

        //Jquery form validation
        $("#createForm").validate({
            errorPlacement: function (error, e) {
                e.parents('.form-group').append(error);
            },
            rules:{
                doctor_id: "required",
                appointment_date:"required",
                schedule_id: "required",
                first_name: "required",
                last_name: "required",
                phone_no:
                    {
                        required: true,
                        maxlength: 11
                    },
                status: "required",
            },
            messages:{
                doctor_id: "Doctor Name is required",
                appointment_date: "Appointment Date is required",
                schedule_id: "Slot is required",
                first_name: "First Name is required",
                last_name: "Last Name is required",
                phone_no: {
                  required: "Phone Number is required",
                    maxlength: "Phone Number is greater than 11 Digits"
                },
                status: "Status is required",
            }
        });

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
