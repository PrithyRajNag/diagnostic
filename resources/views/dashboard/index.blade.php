@extends('layouts.master')
@section('content')
    @if(session('success'))
        <x-alert type="success" message="{{session('success')}}"></x-alert>
    @endif
    <div class="page-title">
        <h2 class="text-capitalize decoration">Dashboard</h2>
    </div>

    <section class="section">

        <div class="row mb-2 mt-3">
            <x-dashboard-card cssclass="decoration number-color-1" title="STAFF" value="{{$totalStaffs}}"></x-dashboard-card>
            <x-dashboard-card cssclass="decoration number-color-2" title="DOCTORS" value="{{$totalDoctors}}"></x-dashboard-card>
            <x-dashboard-card cssclass="decoration number-color-3" title="NURSES" value="{{$totalNurses}}"></x-dashboard-card>
            <x-dashboard-card cssclass="decoration number-color-4" title="ACCOUNTANTS" value="{{$totalAccountants}}"></x-dashboard-card>
            <x-dashboard-card cssclass="decoration number-color-5" title="ADMINS" value="{{$totalAdmins}}"></x-dashboard-card>
            <x-dashboard-card cssclass="decoration number-color-7" title="LABORATORISTS" value="{{$totalLaboratorists}}"></x-dashboard-card>
            <x-dashboard-card cssclass="decoration number-color-6" title="RECEPTIONISTS" value="{{$totalReceptionists}}"></x-dashboard-card>
            <x-dashboard-card cssclass="decoration number-color-8" title="TESTS" value="{{$totalTests}}"></x-dashboard-card>
        </div>
        <div class="row mb-4 ">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header decoration text-center card-bg-mint">
                        <p class='card-heading p-1 pl-3 large-card-font-color custom'>Earning From Tests</p>
                    </div>
                    <div class="card-body card-bg-mint">
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="pl-3 decoration text-center">
                                    <p class="custom">{{number_format($totalPatientEarning,2,'.',',' )}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header decoration text-center  card-bg-mint">
                        <p class='card-heading p-1 pl-3 large-card-font-color custom'>Today's Earning</p>
                    </div>
                    <div class="card-body  card-bg-mint">
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="pl-3 decoration text-center">
                                    <p class="custom"> {{number_format($dailyEarning,2,'.',',' )}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header  decoration text-center  card-bg-mint">
                        <p class='card-heading p-1 pl-3 large-card-font-color custom'>Weekly Earning </p>
                    </div>
                    <div class="card-body  card-bg-mint">
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="pl-3 decoration text-center">
                                    <p class="custom"> {{number_format($weeklyEarning,2,'.',',' )}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header decoration text-center  card-bg-mint">
                        <p class='card-heading p-1 pl-3 large-card-font-color custom'>Monthly Earning</p>
                    </div>
                    <div class="card-body  card-bg-mint">
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="pl-3 decoration text-center">
                                    <p class="custom"> {{number_format($monthlyEarning,2,'.',',' )}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header decoration text-center  card-bg-mint">
                        <p class='card-heading p-1 pl-3 large-card-font-color custom'>Yearly Earning</p>
                    </div>
                    <div class="card-body  card-bg-mint">
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="pl-3 decoration text-center">
                                    <p class="custom"> {{number_format($yearlyEarning,2,'.',',' )}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header decoration text-center  card-bg-mint">
                        <p class='card-heading p-1 pl-3 large-card-font-color custom'>Total Due Balance</p>
                    </div>
                    <div class="card-body  card-bg-mint">
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="pl-3 decoration text-center">
                                    <p class="custom">{{number_format($totalDue, 2,'.',',')}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-xl-4 col-sm-6">
                <div class="card text-center card-bg-blue">
                    <div class="card-content">
                        <div class="card-body">
                            <h3 class="card-title">TODAY'S PATIENTS</h3>
                            <p class="badge bg-danger">{{$dailyPatients}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6">
                <div class="card text-center card-bg-blue">
                    <div class="card-content">
                        <div class="card-body">
                            <h3 class="card-title">TODAY'S APPOINTMENTS</h3>
                            <p class="badge bg-danger">{{$todaysAppointments}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6">
                <div class="card text-center card-bg-blue">
                    <div class="card-content">
                        <div class="card-body">
                            <h3 class="card-title">TOTAL PATIENTS</h3>
                            <p class="badge bg-danger">{{$totalPatients}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
