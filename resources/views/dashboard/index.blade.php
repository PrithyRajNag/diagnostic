@extends('layouts.master')
@section('content')
    @if(session('success'))
        <x-alert type="success" message="{{session('success')}}"></x-alert>
    @endif
    <div class="page-title">
        <h3 class="text-capitalize">Dashboard</h3>
    </div>

    <section class="section">
        <div class="row mb-2 mt-3">
            <x-dashboard-card title="STAFF" value="{{$totalStaffs}}"></x-dashboard-card>
            <x-dashboard-card title="DOCTORS" value="{{$totalDoctors}}"></x-dashboard-card>
            <x-dashboard-card title="NURSES" value="{{$totalNurses}}"></x-dashboard-card>
            <x-dashboard-card title="ACCOUNTANTS" value="{{$totalAccountants}}"></x-dashboard-card>
            <x-dashboard-card title="PATIENTS" value="{{$totalPatients}}"></x-dashboard-card>
            <x-dashboard-card title="TESTS" value="{{$totalTests}}"></x-dashboard-card>
            <x-dashboard-card title="AMBULANCES" value="{{$totalAmbulances}}"></x-dashboard-card>
            <x-dashboard-card title="DUE" value=" {{number_format($totalDue, 2,'.',',')}}"></x-dashboard-card>
        </div>
        <div class="row">
            <div class="col-xl-4 col-sm-6 col-12">
                <div class="card text-center">
                    <div class="card-content">
                        <div class="card-body">
                            <h3 class="card-title">AVAILABLE BED</h3>
                            <p class="badge bg-danger">{{$totalAvailableBed}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 col-12">
                <div class="card text-center">
                    <div class="card-content">
                        <div class="card-body">
                            <h3 class="card-title">TODAY'S APPOINTMENTS</h3>
                            <p class="badge bg-danger">{{$todaysAppointments}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 col-12">
                <div class="card text-center">
                    <div class="card-content">
                        <div class="card-body">
                            <h3 class="card-title">CURRENT ADMITTED PATIENT</h3>
                            <p class="badge bg-danger">{{$admittedlPatients}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class='card-heading p-1 pl-3'>EARNING FROM TESTS</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="pl-3">
                                    <h1> {{number_format($totalPatientEarning,2,'.',',' )}}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class='card-heading p-1 pl-3'>TODAY'S EARNING</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="pl-3">
                                    <h1> {{number_format($dailyEarning,2,'.',',' )}}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class='card-heading p-1 pl-3'>WEEKLY EARNING </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="pl-3">
                                    <h1> {{number_format($weeklyEarning,2,'.',',' )}}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class='card-heading p-1 pl-3'>MONTHLY EARNING</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="pl-3">
                                    <h1> {{number_format($monthlyEarning,2,'.',',' )}}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class='card-heading p-1 pl-3'>YEARLY EARNING</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="pl-3">
                                    <h1> {{number_format($yearlyEarning,2,'.',',' )}}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
