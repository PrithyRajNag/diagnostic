@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">{{'Create Death Record'}}</h3>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('death.index')}}" class="btn-sm btn-primary">BACK</a>
                            </div>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" action="{{route('death.store')}}" method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <label for="patient_id" class="mb-2">{{'Patient Name'}}</label>
                                            <div class="form-group">
                                                <select name="patient_id" class="form-select">
                                                    <option hidden value=""></option>
                                                    @foreach($patients as $patient)
                                                        <option value="{{ $patient->id }}">{{ $patient->full_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <span class="text-danger">@error('patient_id'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="date" class="mb-2">{{'Date'}}</label>
                                                <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}"
                                                       placeholder="date">
                                            </div>
                                            <span class="text-danger">@error('date'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="time" class="mb-2">{{'Time'}}</label>
                                                <input type="time" class="form-control" id="time" name="time" value="{{ old('time') }}"
                                                       placeholder="time">
                                            </div>
                                            <span class="text-danger">@error('time'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="phone_number" class="mb-2">{{"Receiver's Contact"}}</label>
                                                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number') }}"
                                                       placeholder="phone number">
                                            </div>
                                            <span class="text-danger">@error('phone_number'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="doctor_id" class="mb-2">{{'Authorized Doctor Name'}}</label>
                                                <select name="doctor_id" class="form-select">
                                                    <option hidden value=""></option>
{{--                                                    @foreach($patients as $patient)--}}
{{--                                                        <option value="{{ $patient->id }}">{{ $patient->full_name }}</option>--}}
{{--                                                    @endforeach--}}
                                                </select>
                                            </div>
                                            <span class="text-danger">@error('doctor_id'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="note" class="form-label">{{'Note'}}</label>
                                                <textarea class="form-control" name="note" rows="3" placeholder="note">{{ old('note') }}</textarea>
                                            </div>
                                            <span class="text-danger">@error('note'){{ $message }}@enderror</span>
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
