@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Create Advance Payment</h3>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('advance.index')}}" class="btn-sm btn-primary">BACK</a>
                            </div>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" action="{{route('advance.store')}}" method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <fieldset class="form-group">
                                                <label for="appointment_id" class="mb-2">Appointment ID</label>
                                                <select name="appointment_id" class="form-select">
                                                    <option hidden value=""></option>
                                                    {{--                                                    @foreach($bedTypes as $bedType)--}}
                                                    {{--                                                        <option value="{{ $bedType->id }}">{{ $bedType->name }}</option>--}}
                                                    {{--                                                    @endforeach--}}
                                                </select>
                                            </fieldset>
                                            <span class="text-danger">@error('appointment_id'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <fieldset class="form-group">
                                                <label for="patient_id" class="mb-2">Patient ID</label>
                                                <select name="patient_id" class="form-select">
                                                    <option hidden value=""></option>
                                                    {{--                                                    @foreach($bedTypes as $bedType)--}}
                                                    {{--                                                        <option value="{{ $bedType->id }}">{{ $bedType->name }}</option>--}}
                                                    {{--                                                    @endforeach--}}
                                                </select>
                                            </fieldset>
                                            <span class="text-danger">@error('patient_id'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="amount" class="mb-2">Amount</label>
                                                <input type="text" class="form-control" id="amount" name="amount" value="{{ old('amount') }}">
                                            </div>
                                            <span class="text-danger">@error('amount'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <fieldset class="form-group">
                                                <label for="payment_method" class="mb-2">Payment Method</label>
                                                <select name="payment_method" class="form-select">
                                                    <option hidden value=""></option>
                                                    <option  value="cash">Cash</option>
                                                    <option  value="card">Card</option>
                                                    <option  value="cheque">Cheque</option>
                                                </select>
                                            </fieldset>
                                            <span class="text-danger">@error('payment_method'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="receipt_no" class="mb-2">Receipt No</label>
                                                <input type="text" class="form-control" id="receipt_no" name="receipt_no" value="{{ old('receipt_no') }}">
                                            </div>
                                            <span class="text-danger">@error('receipt_no'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="active"
                                                       value="1">
                                                <label class="form-check-label" for="active">Active</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="inactive"
                                                       value="0">
                                                <label class="form-check-label" for="inactive">Inactive</label>
                                            </div>
                                            <span class="text-danger">@error('status'){{ $message }}@enderror</span>
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


    </script>
@endpush
