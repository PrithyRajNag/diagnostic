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
                            <h3 class="text-capitalize">Package Information</h3>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="package_name" class="mb-2">Package Name</label></b>
                                    <p>{{ ucwords( $package->package_name?? 'N/A') }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="description" class="mb-2">Description</label></b>
                                    <p>{{ ucwords( $package->description ?? 'N/A') }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="service" class="mb-2">Services</label></b>
                                    <div>
                                    @foreach($package->services as $service)
                                        <a href="{{ route('service.show',$service->uuid) }}" class="badge bg-success mb-1">{{ ucwords( $service->service_name ?? 'N/A') }}</a>
                                    @endforeach
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="discount" class="mb-2">Discount</label></b>
                                    <p>{{ ucwords( $package->discount ?? 'N/A') }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="amount" class="mb-2">Amount</label></b>
                                    <p>{{ ucwords($package->amount ?? 'N/A') }}</p>
                                </div>

                                <div class="col-sm-12 col-md-6">
                                    <b><label for="status" class="mb-1">{{'Status'}}</label></b>
                                    <br>
                                    @if($package->status == 1)
                                        <p class="badge bg-success mb-1">{{ ucwords("Active" ?? 'N/A') }}</p>
                                    @else
                                        <p class="badge bg-danger mb-1">{{ucwords("Inactive" ?? 'N/A')}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
