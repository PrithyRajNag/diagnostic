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
                            <h3 class="text-capitalize">{{'Death Information'}}</h3>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="name" class="mb-2">{{'Patient Name'}}</label></b>
                                    <p>{{ ucwords($death->patients->full_name ?? '') }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="date" class="mb-2">{{'Date'}}</label></b>
                                    <p>{{ ucwords($death->date ?? '') }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="time" class="mb-2">{{'Time'}}</label></b>
                                    <p>{{ ucwords($death->time ?? '') }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="phone_number" class="mb-2">{{"Receiver's Contact"}}</label></b>
                                    <p>{{ ucwords($death->phone_number ?? '') }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="doctor_id" class="mb-2">{{"Authorized Doctor Name"}}</label></b>
{{--                                    <p>{{ ucwords($death->phone_number ?? '') }}</p>--}}
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="note" class="mb-2">{{"Note"}}</label></b>
                                    <p>{{ ucwords($death->note ?? '') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
