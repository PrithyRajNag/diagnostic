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
                            <h3 class="text-capitalize">Doctor Percentage Information</h3>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('doctor.index')}}" class="btn-sm btn-primary">BACK</a>
                            </div>
                            <hr/>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="card hms-box-shadow">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <b><label for="doctor_id" class="mb-2">Doctor Name</label></b>
                                        <p>{{ ucwords($doctorPercentage->doctors->full_name ?? 'N/A') }} ({{$doctorPercentage->doctors->departments->title}})</p>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <b><label for="percentage" class="mb-2">Percentage</label></b>
                                        <p>{{ ucwords($doctorPercentage->percentage ?? 'N/A') }} <b> %</b></p>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <b><label for="percentage" class="mb-2">Today's Earning</label></b>
                                        <p>{{ $earning ?? 'N/A' }} <b> BDT</b></p>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <b><label for="status" class="mb-2">{{'Status'}}</label></b>
                                        @if($doctorPercentage->status == 1)
                                            <p>{{ ucwords("Active" ?? '') }}</p>
                                        @else
                                            <p>{{ucwords("Inactive" ?? '')}}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
