@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Edit Schedule</h3>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('schedule.index')}}" class="btn-sm btn-primary">BACK</a>
                            </div>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" action="{{route('schedule.update', $schedule->uuid)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="doctor_id" class="mb-2 d-flex align-items-center">Doctor Name</label>
                                                <select class="form-select select2"  style="width: 100%" name="doctor_id">
@foreach($doctors as $doctor)
                                                        <option value="{{ $doctor->id }}" {{$schedule->doctor_id == $doctor->id ? 'selected' : ''}}>{{ucwords($doctor->full_name)}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <span class="text-danger">@error('doctor_id'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="day" class="mb-2 d-flex align-items-center">Days</label>
                                                <select class="form-select select2"  style="width: 100%" name="day">
                                                    <option hidden value="{{old('day', $schedule->day)}}"></option>
                                                    <option value="saturday" {{ $schedule->day == 'saturday' ? 'selected' : '' }} >Saturday</option>
                                                    <option value="sunday" {{ $schedule->day == 'sunday' ? 'selected' : '' }} >Sunday</option>
                                                    <option value="monday" {{ $schedule->day == 'monday' ? 'selected' : '' }} >Monday</option>
                                                    <option value="tuesday"{{ $schedule->day == 'tuesday' ? 'selected' : '' }} >Tuesday</option>
                                                    <option value="wednesday" {{ $schedule->day == 'wednesday' ? 'selected' : '' }} >Wednesday</option>
                                                    <option value="thursday"{{ $schedule->day == 'thursday' ? 'selected' : '' }} >Thursday</option>
                                                    <option value="friday" {{ $schedule->day == 'friday' ? 'selected' : '' }} >Friday</option>
                                                </select>
                                            </div>
                                            <span class="text-danger">@error('day'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="start_time" class="mb-2">{{'Start Time'}}</label>
                                                <input type="time" class="form-control" id="start_time" name="start_time" value="{{ $schedule->start_time }}">
                                            </div>
                                            <span class="text-danger">@error('start_time'){{ $message }}@enderror</span>

                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="end_time" class="mb-2">{{'End Time'}}</label>
                                                <input type="time" class="form-control" id="end_time" name="end_time" value="{{ $schedule->end_time }}">
                                            </div>
                                            <span class="text-danger">@error('end_time'){{ $message }}@enderror</span>

                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="per_patient_time" class="mb-2">{{'Per Patient Time '}} &nbsp;
                                                    ( {{'In Minutes'}} )</label>
                                                <input type="number" min="0" class="form-control" id="per_patient_time" name="per_patient_time" value="{{ $schedule->per_patient_time }}">
                                            </div>
                                            <span class="text-danger">@error('per_patient_time'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="status"><span class="required">*</span> Status</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status"
                                                           id="active"
                                                           value="1" {{($schedule->status == "1") ? "checked" : ""}}>
                                                    <label class="form-check-label" for="active">Active</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status"
                                                           id="inactive"
                                                           value="0" {{($schedule->status == "0") ? "checked" : ""}}>
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

        $("#createForm").validate({
            errorPlacement: function (error, e) {
                e.parents('.form-group').append(error);
            },
            rules: {
                doctor_id: "required",
                day: "required",
                start_time: "required",
                end_time: "required",
                per_patient_time: "required",
                status: "required",
            },
            messages: {
                doctor_id: "Doctor Name is required",
                day: "Days is required",
                start_time: "Start Time is required",
                end_time: "End Time is required",
                per_patient_time: "Per Patient Time is required",
                status: "Status is required",
            }
        });
        $(".select2").select2({
            allowClear: true
        })
    </script>
@endpush
