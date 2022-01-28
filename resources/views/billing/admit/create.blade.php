@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Create Patient Admission</h3>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('admit.index')}}" class="btn-sm btn-primary">BACK</a>
                            </div>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" action="{{route('admit.store')}}" method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
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
                                            <fieldset class="form-group">
                                                <label for="doctor_id" class="mb-2">Doctor Name</label>
                                                <select name="doctor_id" class="form-select">
                                                    <option hidden value=""></option>
                                                    {{--                                                    @foreach($bedTypes as $bedType)--}}
                                                    {{--                                                        <option value="{{ $bedType->id }}">{{ $bedType->name }}</option>--}}
                                                    {{--                                                    @endforeach--}}
                                                </select>
                                            </fieldset>
                                            <span class="text-danger">@error('doctor_id'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="admission_date" class="mb-2">Admission Date</label>
                                                <input type="date" class="form-control" id="admission_date" name="admission_date" value="{{ old('admission_date') }}">
                                            </div>
                                            <span class="text-danger">@error('admission_date'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="discharge_date" class="mb-2">Discharge Date</label>
                                                <input type="date" class="form-control" id="discharge_date" name="discharge_date" value="{{ old('discharge_date') }}">
                                            </div>
                                            <span class="text-danger">@error('discharge_date'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <fieldset class="form-group">
                                                <label for="package_id" class="mb-2">Package Name</label>
                                                <select name="package_id" class="form-select">
                                                    <option hidden value=""></option>
                                                    {{--                                                    @foreach($bedTypes as $bedType)--}}
                                                    {{--                                                        <option value="{{ $bedType->id }}">{{ $bedType->name }}</option>--}}
                                                    {{--                                                    @endforeach--}}
                                                </select>
                                            </fieldset>
                                            <span class="text-danger">@error('package_id'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="guardian_name" class="mb-2">Guardian Name</label>
                                                <input type="text" class="form-control" id="guardian_name" name="guardian_name" value="{{ old('guardian_name') }}">
                                            </div>
                                            <span class="text-danger">@error('guardian_name'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="guardian_relation" class="mb-2">Guardian Relation</label>
                                                <input type="text" class="form-control" id="guardian_relation" name="guardian_relation" value="{{ old('guardian_relation') }}">
                                            </div>
                                            <span class="text-danger">@error('guardian_relation'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="guardian_contact" class="mb-2">Guardian Contact</label>
                                                <input type="text" class="form-control" id="guardian_contact" name="guardian_contact" value="{{ old('guardian_contact') }}">
                                            </div>
                                            <span class="text-danger">@error('guardian_contact'){{ $message }}@enderror</span>
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
