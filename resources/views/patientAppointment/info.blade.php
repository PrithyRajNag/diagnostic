@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                @if ($errors)
                    @foreach ($errors->all() as $error)
                        <x-alert type="danger" message="{{$error}}"></x-alert>
                    @endforeach
                @endif
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Patient Appointment Information</h3>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="patient_id" class="mb-2">Patient Name</label></b>
                                    <p>{{$appointment->patients->full_name ?? 'N/A'}}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="patient_id" class="mb-2">Phone Number</label></b>
                                    <p>{{$appointment->patients->phone_no ?? 'N/A'}}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="doctor_id" class="mb-2">Doctor Name</label></b>
                                    <p>{{$appointment->doctors->full_name ?? 'N/A'}}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="doctor_type" class="mb-2">Doctor Type</label></b>
                                    <p>{{$appointment->doctors->user_type ?? 'N/A'}}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="department_id" class="mb-2">Department</label></b>
                                    <p>{{$appointment->doctors->departments->title ?? 'N/A'}}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="schedule_id" class="mb-2">Slot</label></b>
                                    <p>{{date('h:i a', strtotime($appointment->schedules->start_time)). ' - '. date('h:i a', strtotime($appointment->schedules->end_time)) ?? 'N/A'}}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="appointment_date" class="mb-2">Appointment Date</label></b>
                                    <p>{{$appointment->appointment_date ?? 'N/A'}}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="patient_id" class="mb-2">Problem</label></b>
                                    <p>{{$appointment->problem ?? 'N/A'}}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="status" class="mb-2">{{'Status'}}</label></b>
                                    <br>
                                    @if($appointment->status == 1)
                                        <p class="badge bg-success">{{ ucwords("Active" ?? '') }}</p>
                                    @else
                                        <p class="badge bg-danger">{{ucwords("Inactive" ?? '')}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
