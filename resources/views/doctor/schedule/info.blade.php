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
                            <h3 class="text-capitalize">Schedule Information</h3>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="row">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <b><label for="doctor_id" class="mb-2">Doctor Name</label></b>
                                        <p>{{ ucwords($schedule->profiles->full_name ?? '') }}</p>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <b><label for="days" class="mb-2">Days</label></b>
                                        <p>{{$schedule->day ?? ''}}</p>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <b><label for="start_time" class="mb-2">Start Time</label></b>
                                        <p>{{ date("h:i:s a", strtotime($schedule->start_time  ?? 'N/A' ))}}</p>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <b><label for="end_time" class="mb-2">End Time</label></b>
                                        <p>{{ date("h:i:s a", strtotime($schedule->end_time  ?? 'N/A' )) }}</p>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <b><label for="per_patient_time" class="mb-2">Per Patient Time</label></b>
                                        <p>{{ ucwords($schedule->per_patient_time ?? '') }}</p>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <b><label for="status" class="mb-2">{{'Status'}}</label></b>
                                        <br>
                                        @if($schedule->status == 1)
                                            <p class="badge bg-success mb-1">{{ ucwords("Active" ?? '') }}</p>
                                        @else
                                            <p class="badge bg-danger mb-1">{{ucwords("Inactive" ?? '')}}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
@endsection
