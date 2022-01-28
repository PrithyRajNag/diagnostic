@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Create Service</h3>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('service.index')}}" class="btn-sm btn-primary">BACK</a>
                            </div>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form id="createForm" class="form form-vertical" action="{{route('service.store')}}" method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="service_name" class="mb-2"><span class="required">*</span> {{'Service Name'}}</label>
                                                <input
                                                       type="text"
                                                       class="form-control"
                                                       id="service_name"
                                                       name="service_name"
                                                       value="{{ old('service_name') }}"
                                                       placeholder="Service Name"
                                                       required
                                                />
                                            </div>
                                            <span class="text-danger">@error('service_name'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="description" class="mb-2">{{'Description'}}</label>
                                                <textarea type="text" class="form-control" id="description" name="description"></textarea>
                                            </div>
                                            <span class="text-danger">@error('description'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="quantity" class="mb-2"><span class="required">*</span> {{'Quantity'}}</label>
                                                <input
                                                    min="0"
                                                    type="number"
                                                    class="form-control"
                                                    id="quantity"
                                                    name="quantity"
                                                    value="{{ old('quantity') }}"
                                                    placeholder="Quantity"
                                                />
                                            </div>
                                            <span class="text-danger">@error('quantity'){{ $message }}@enderror</span>
                                        </div>

                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="rate" class="mb-2"><span class="required">*</span> {{'Rate'}}</label>
                                                <input  class="form-control"
                                                        type="number"
                                                        min="0"
                                                        id="rate"
                                                        name="rate"
                                                        value="{{ old('rate') }}"
                                                       placeholder="Amount"
                                                        required
                                                >
                                            </div>
                                            <span class="text-danger">@error('rate'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="status"><span class="required">*</span> Status</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status"
                                                           id="active"
                                                           value="1" @if( old('status')) == "1" ? 'checked' : '' @endif
                                                    required>
                                                    <label class="form-check-label" for="active">Active</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status"
                                                           id="inactive"
                                                           value="0" @if( old('status')) == "0" ? 'checked' : '' @endif
                                                    required>
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
        $('#createForm').validate({
            errorPlacement: function (error, e) {
                e.parents('.form-group').append(error);
            },
            rules:{
                service_name: "required",
                quantity: "required",
                rate:"required",
                status:"required"
            },
            messages:{
                service_name: "Service Name is required",
                quantity: "Quantity is required",
                rate: "Rate is required",
                status: "Status Field is required",
            }
        });

    </script>
@endpush
