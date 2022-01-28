@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Edit Blood Input</h3>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('blood-input.index')}}" class="btn-sm btn-primary">BACK</a>
                            </div>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                           <form class="form form-vertical" action="{{route('blood-input.update', $data->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="first_name" class="mb-2">First Name</label>
                                                <input type="text"
                                                       value="{{ ucwords($data->first_name) ?? ''}}"
                                                       class="form-control" id="first_name"
                                                       name="first_name" required>
                                            </div>
                                            <span
                                                class="text-danger">@error('first_name'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="last_name" class="mb-2">Last Name</label>
                                                <input type="text"
                                                       value="{{ ucwords($data->last_name) ?? ''}}"
                                                       class="form-control" id="last_name" name="last_name"
                                                       required>
                                            </div>
                                            <span
                                                class="text-danger">@error('last_name'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="age" class="mb-2">Age</label>
                                                <input type="number" value="{{ $data->age ?? ''}}"
                                                       class="form-control" id="age"
                                                       name="age"
                                                       required>
                                            </div>
                                            <span
                                                class="text-danger">@error('age'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="phone_number" class="mb-2">Phone Number</label>
                                                <input type="text" value="{{ $data->phone_number ?? ''}}"
                                                       class="form-control" id="phone_number"
                                                       name="phone_number"
                                                       required>
                                            </div>
                                            <span
                                                class="text-danger">@error('phone_number'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <fieldset class="form-group">
                                                <label for="gender" class="mb-2">Gender</label>
                                                <select name="gender" class="form-select" required>
                                                    <option hidden
                                                            value="{{ $data->gender ?? '' }}">{{  ucfirst($data->gender) }}</option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                    <option value="other">Other</option>
                                                </select>
                                            </fieldset>
                                            <span
                                                class="text-danger">@error('gender'){{ $message }}@enderror</span>
                                        </div>

                                        <div class="col-sm-12 col-md-6">
                                            <fieldset class="form-group">
                                                <label for="blood_group" class="mb-2">Blood Group</label>
                                                <select name="blood_group" class="form-select" required>
                                                    <option hidden
                                                            value="{{ $data->blood_group ?? '' }}"> {{ ucfirst($data->blood_group) ?? ''}}</option>
                                                    <option value="a+">A+</option>
                                                    <option value="a-">A-</option>
                                                    <option value="b+">B+</option>
                                                    <option value="b-">B-</option>
                                                    <option value="o+">O+</option>
                                                    <option value="o-">O-</option>
                                                    <option value="ab+">AB+</option>
                                                    <option value="ab-">AB-</option>
                                                </select>
                                            </fieldset>
                                            <span
                                                class="text-danger">@error('blood_group'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="bag_number" class="mb-2">Bag Number</label>
                                                <input type="text" value="{{ucwords($data->bloodCollection->bag_number) ?? ''}}"
                                                       class="form-control" id="bag_number"
                                                       name="bag_number"
                                                       required>
                                            </div>
                                            <span
                                                class="text-danger">@error('bag_number'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="age" class="mb-2">Date</label>
                                                <input type="date" value="{{ $data->date ?? ''}}"
                                                       class="form-control" id="date"
                                                       name="date"
                                                       required>
                                            </div>
                                            <span
                                                class="text-danger">@error('date'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <fieldset class="form-group">
                                                <label for="is_regular_donor" class="mb-2">Regular Donor</label>
                                                <select name="is_regular_donor" class="form-select" required>
                                                    <option hidden
                                                            value="{{ $data->is_regular_donor?? '' }}"> {{ ucfirst($data->is_regular_donor) ?? ''}}</option>
                                                    <option value="true">Yes</option>
                                                    <option value="false">No</option>
                                                </select>
                                            </fieldset>
                                            <span
                                                class="text-danger">@error('is_regular_donor'){{ $message }}@enderror</span>
                                        </div>

                                        <div class="col- mt-2">
                                            <label for="address" class="mt-2 font-weight-bolder">
                                                Address</label>
                                            <hr style="margin: 10px 0px">
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="address['country']"
                                                       class="mb-2">Country</label>
                                                <input type="text" name="address[country]"
                                                       id="country" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="address[district]"
                                                       class="mb-2">District</label>
                                                <input type="text" name="address[district]" id="present_district"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="address[upazila]" class="mb-2">Thana/Upozila</label>
                                                <input type="text" name="address[upazila]" id="present_upazila"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="address[post_code]" class="mb-2">Post
                                                    Code</label>
                                                <input type="text" name="address[post_code]" id="present_post"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="address[address_line1]" class="mb-2">Address
                                                    Line 1</label>
                                                <textarea class="form-control"
                                                          name="address[address_line1]" id="present_add1" rows="2" required></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="address[address_line2]" class="mb-2">Address
                                                    Line 2</label>
                                                <textarea class="form-control"
                                                          name="address[address_line2]" id="present_add2" rows="2"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit
                                            </button>
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
