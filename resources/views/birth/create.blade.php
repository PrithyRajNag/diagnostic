@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Create Birth Record</h3>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('birth.index')}}" class="btn-sm btn-primary">BACK</a>
                            </div>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" action="{{route('birth.store')}}" method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="name" class="mb-2">{{'Name'}}</label>
                                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                                                       placeholder="name">
                                            </div>
                                            <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="weight" class="mb-2">{{'Weight'}}</label>
                                                <input type="text" class="form-control" id="weight" name="weight" value="{{ old('weight') }}"
                                                       placeholder="weight">
                                            </div>
                                            <span class="text-danger">@error('weight'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="gender" class="mb-2">{{'Gender'}}</label>
                                                <select name="gender" class="form-select">
                                                    <option hidden value=""></option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                    <option value="other">Other</option>
                                                </select>
                                            </div>
                                            <span class="text-danger">@error('gender'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="blood_group" class="mb-2">{{'Blood Group'}}</label>
                                                <select name="blood_group" class="form-select">
                                                    <option hidden value=""></option>
                                                    <option value="a+">A+</option>
                                                    <option value="a-">A-</option>
                                                    <option value="b+">B+</option>
                                                    <option value="b-">B-</option>
                                                    <option value="o+">O+</option>
                                                    <option value="o-">O-</option>
                                                    <option value="ab+">AB+</option>
                                                    <option value="ab-">AB-</option>
                                                </select>
                                            </div>
                                            <span class="text-danger">@error('blood_group'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="doctor_id" class="mb-2">{{'Doctor Name'}}</label>
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
                                            <div class="form-group">
                                                <label for="mother_name" class="mb-2">{{'Mother Name'}}</label>
                                                <input type="text" class="form-control" id="mother_name" name="mother_name" value="{{ old('mother_name') }}"
                                                       placeholder="mother name">
                                            </div>
                                            <span class="text-danger">@error('mother_name'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="father_name" class="mb-2">{{'Father Name'}}</label>
                                                <input type="text" class="form-control" id="father_name" name="father_name" value="{{ old('father_name') }}"
                                                       placeholder="father name">
                                            </div>
                                            <span class="text-danger">@error('father_name'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="phone_number" class="mb-2">{{'Phone Number'}}</label>
                                                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number') }}"
                                                       placeholder="phone number">
                                            </div>
                                            <span class="text-danger">@error('phone_number'){{ $message }}@enderror</span>
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
                                        <div class="divider">
                                           <div class="divider-text">Address</div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="address['country']"
                                                       class="mb-2">Country</label>
                                                <input type="text" name="address[country]"
                                                       id="country" class="form-control"
                                                       value="{{ old("address['country']") }} ">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="address[district]"
                                                       class="mb-2">District</label>
                                                <input type="text" name="address[district]" id="district"
                                                       class="form-control"
                                                       value="{{ old("address['district']") }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="address[upazila]" class="mb-2">Thana/Upazila</label>
                                                <input type="text" name="address[upazila]" id="upazila"
                                                       class="form-control"
                                                       value="{{ old("address['upazila']") }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="address[post_code]" class="mb-2">Post Code</label>
                                                <input type="text" name="address[post_code]" id="post"
                                                       class="form-control"
                                                       value="{{ old("address['post_code']") }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="address[address_line1]" class="mb-2">Address Line 1</label>
                                                <textarea class="form-control"
                                                          name="address[address_line1]" id="add1"
                                                          rows="2"
                                                          required>{{ old("address['address_line1']")  }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="address[address_line2]" class="mb-2">Address Line 2</label>
                                                <textarea class="form-control"
                                                          name="address[address_line2]" id="add2"
                                                          rows="2"
                                                          required>{{ old("address['address_line2']")  }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="note" class="mb-2">{{'Note'}}</label>
                                                <textarea class="form-control" name="note" rows="3">{{ old('note') }}</textarea>
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
