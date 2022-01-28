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
                            <h3 class="text-capitalize">Patient Case Study Information</h3>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">

                                <div class="col-sm-12 col-md-6">
                                    <b><label for="patient_id" class="mb-2">Patient ID</label></b>
                                    <p></p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="food_allergies" class="mb-2">Food Allergies</label></b>
                                    <p></p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="tendency_bleed" class="mb-2">Tendency Bleed</label></b>
                                    <p></p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="heart_disease" class="mb-2">Heart Disease</label></b>
                                    <p></p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="high_blood_pressure" class="mb-2">High Blood Pressure</label></b>
                                    <p></p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="diabetic" class="mb-2">Diabetic</label></b>
                                    <p></p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="surgery" class="mb-2">Surgery</label></b>
                                    <p></p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="accident" class="mb-2">Accident</label></b>
                                    <p></p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="other" class="mb-2">Others</label></b>
                                    <p></p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="family_medical_history" class="mb-2">Family Medical History</label></b>
                                    <p></p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="current_medication" class="mb-2">Current Medication</label></b>
                                    <p></p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="female_pregnancy" class="mb-2">Female Pregnancy</label></b>
                                    <p></p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="breast_feeding" class="mb-2">Breast Feeding</label></b>
                                    <p></p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="health_insurance" class="mb-2">Health Insurance</label></b>
                                    <p></p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="low_income" class="mb-2">Low Income</label></b>
                                    <p></p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="reference" class="mb-2">Reference</label></b>
                                    <p></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
