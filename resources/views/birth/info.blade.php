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
                            <h3 class="text-capitalize">Birth Information</h3>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="name" class="mb-2">{{'Name'}}</label></b>
                                    <p>{{ ucwords($birth->name ?? '') }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="weight" class="mb-2">{{'Weight'}}</label></b>
                                    <p>{{ ucwords($birth->weight ?? '')  }} lb</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="gender" class="mb-2">{{'Gender'}}</label></b>
                                    <p>{{ ucwords($birth->gender ?? '') }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="blood_group" class="mb-2">{{'Blood Group'}}</label></b>
                                    <p>{{ ucwords($birth->blood_group ?? '') }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="doctor_id" class="mb-2">{{'Doctor Name'}}</label></b>
                                    <p>{{ ucwords($birth->doctor_id ?? '') }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="mother_name" class="mb-2">{{'Mother Name'}}</label></b>
                                    <p>{{ ucwords($birth->mother_name ?? '') }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="father_name" class="mb-2">{{'Father Name'}}</label></b>
                                    <p>{{ ucwords($birth->father_name ?? '') }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="phone_number" class="mb-2">{{'Phone Number'}}</label></b>
                                    <p>{{ ucwords($birth->phone_number ?? '') }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="date" class="mb-2">{{'Date'}}</label></b>
                                    <p>{{ ucwords($birth->date ?? '') }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="time" class="mb-2">{{'Time'}}</label></b>
                                    <p>{{ ucwords($birth->time ?? '') }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="address" class="mb-2">{{'Address'}}</label></b>
                                    <p>{{ ucwords($birth->address ?? '') }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="note" class="mb-2">{{'Note'}}</label></b>
                                    <p>{{ ucwords($birth->note ?? '') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
