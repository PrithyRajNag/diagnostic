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
                            <h3 class="text-capitalize">Ambulance Information</h3>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="vehicle_number" class="mb-2">Vehicle Number</label></b>
                                    <p>{{ ucwords( $data->vehicle_number?? 'N/A') }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="vehicle_model" class="mb-2">Vehicle Model</label></b>
                                    <p>{{ ucwords( $data->vehicle_model ?? 'N/A') }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="driver_name" class="mb-2">Driver Name</label></b>
                                    <p>{{ ucwords($data->driver_name ?? 'N/A') }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="driver_phone_number" class="mb-2">Driver Phone Number</label></b>
                                    <p>{{ ucwords( $data->driver_phone_number ?? 'N/A') }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="driver_license" class="mb-2">Driver License</label></b>
                                    <p>{{ucwords($data->driver_license ?? 'N/A')  }}</p>
                                </div>
                                <div class="divider">
                                    <div class="divider-text"> Present Address</div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for=present_address['country']" class="mb-2">Country</label></b>
                                    <p>{{ $data->present_address['country'] ?? 'N/A' }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="present_address['district']" class="mb-2">District</label></b>
                                    <p>{{ $data->present_address['district'] ?? 'N/A' }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="present_address['upazila']" class="mb-2">Thana / Upazila</label></b>
                                    <p>{{ $data->present_address['upazila'] ?? 'N/A' }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="present_address['post_code']" class="mb-2">Post Code</label></b>
                                    <p>{{ $data->present_address['post_code'] ?? 'N/A' }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="present_address['address']" class="mb-2">Address Line</label></b>
                                    <p>{{ ($data->present_address['address_line1'].','.$data->present_address['address_line2']) ?? 'N/A' }}</p>
                                </div>
                                <div class="divider">
                                    <div class="divider-text"> Permanent Address</div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for=permanent_address['country']" class="mb-2">Country</label></b>
                                    <p>{{ $data->permanent_address['country'] ?? 'N/A' }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="permanent_address['district']" class="mb-2">District</label></b>
                                    <p>{{ $data->permanent_address['district'] ?? 'N/A' }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="permanent_address['upazila']" class="mb-2">Thana / Upazila</label></b>
                                    <p>{{ $data->permanent_address['upazila'] ?? 'N/A' }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="permanent_address['post_code']" class="mb-2">Post Code</label></b>
                                    <p>{{ $data->permanent_address['post_code'] ?? 'N/A' }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="permanent_address['address']" class="mb-2">Address Line</label></b>
                                    <p>{{ ($data->permanent_address['address_line1'].','.$data->permanent_address['address_line2']) ?? 'N/A' }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="status" class="mb-2">{{'Status'}}</label></b>
                                    <br>
                                    @if($data->status == 1)
                                        <span class="badge bg-success">{{ ucwords("Active" ?? 'N/A') }}</span>
                                    @else
                                        <p class="badge bg-danger">{{ucwords("Inactive" ?? 'N/A')}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
