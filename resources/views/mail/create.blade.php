@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Create Email</h3>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('mail.index')}}" class="btn-sm btn-primary">BACK</a>
                            </div>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" action="{{route('mail.store')}}" method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 mb-3 d-flex">
                                            <div style="padding-right: 10px">
                                                <input type="radio" name="email_to" value="doctor">
                                                <span class="">All Doctors</span>
                                            </div>
                                            <div style="padding-right: 10px">
                                                <input type="radio" name="email_to" value="nurse">
                                                <span class="">All Nurses</span>
                                            </div>
                                            <div style="padding-right: 10px">
                                                <input type="radio" name="email_to" value="specific">
                                                <span class="">Specific Email</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="receiver" class="mb-2 d-flex align-items-center">Receiver
                                                    Mail</label>
                                                <input type="email" class="form-control" id="receiver" name="receiver"
                                                       placeholder="Receiver Mail" value="{{ old('receiver') }}">
                                            </div>
                                            <span class="text-danger">@error('receiver'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="subject"
                                                       class="mb-2 d-flex align-items-center">Subject</label>
                                                <input type="email" class="form-control" id="subject" name="subject"
                                                       placeholder="Subject" value="{{ old('subject') }}">
                                            </div>
                                            <span class="text-danger">@error('subject'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="message"
                                                       class="form-label">Message</label>
                                                <textarea class="form-control" name="message"
                                                          rows="3">{{ old('message') }}</textarea>
                                                <span
                                                    class="text-danger">@error('message'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="file" class="form-label">Attach File</label>
                                                <div class="form-file">
                                                    <input type="file" class="form-file-input" id="customFile">
                                                    <label class="form-file-label" for="customFile">
                                                    </label>
                                                </div>
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
