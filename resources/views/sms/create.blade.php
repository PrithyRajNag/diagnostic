@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Create SMS</h3>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('sms.index')}}" class="btn-sm btn-primary">BACK</a>
                            </div>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" action="{{route('sms.store')}}" method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 mb-3 d-flex">
                                            <div style="padding-right: 10px">
                                                <input type="radio" name="sms_to" value="doctor">
                                                <span class="">All Doctors</span>
                                            </div>
                                            <div style="padding-right: 10px">
                                                <input type="radio" name="sms_to" value="nurse">
                                                <span class="">All Nurses</span>
                                            </div>
                                            <div style="padding-right: 10px">
                                                <input type="radio" name="sms_to" value="specific">
                                                <span class="">Specific Number</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="receiver" class="mb-2 d-flex align-items-center">Receiver Number</label>
                                                <input type="text" class="form-control" id="receiver" name="receiver"
                                                       placeholder="Receiver Number" value="{{ old('receiver') }}">
                                            </div>
                                            <span class="text-danger">@error('receiver'){{ $message }}@enderror</span>
                                        </div>

                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="message"
                                                       class="form-label">Message</label>
                                                <textarea class="form-control" name="message" rows="3">{{ old('message') }}</textarea>
                                                <span class="text-danger">@error('message'){{ $message }}@enderror</span>
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
