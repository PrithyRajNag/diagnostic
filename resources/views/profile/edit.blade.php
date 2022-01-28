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
                            <h3 class="text-capitalize d-inline">Update Profile</h3>
                            @if($data != null)
                                <a href="{{ route('profile.show',$data->uuid ?? '') }}"
                                   class="btn btn-sm btn-primary icon icon-left float-end">View Profile</a>
                            @endif
                            <hr/>
                        </div>
                    </div>
                    <div>
                        <nav>
                            <div class="nav nav-tabs justify-content-center font-size" id="nav-tab">
                                <button class="nav-link active" id="profile" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Profile</button>
                                <button class="nav-link" id="education" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Education</button>
                                <button class="nav-link" id="qualification" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Qualification</button>
                            </div>
                        </nav>
                    </div>

                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            @if($data == null)
                                <form id="createForm" class="form form-vertical" action="{{route('profile.store')}}"
                                      method="POST" enctype="multipart/form-data">
                                    @csrf
                                @else
                                    <form class="form form-vertical"
                                          action="{{route('profile.update', $data->uuid)}}"
                                          method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        @endif
                                        <div class="form-body">
                                            <div class="row">
                                                <input type="text" value="{{ Auth::user()->id ?? '' }}" id="user_id"
                                                       name="user_id" hidden>
                                                <span class="text-end" style="color: blue">{{ Auth::user()->email ?? '' }}</span>
<div class="col-sm-12 col-md-12 text-center my-4">
                                                    <div class="avatar avatar-xl">
                                                        @if($data != null && $data->image != null)
                                                            <img src="{{asset("storage/images/".$data->image)}}"
                                                                 alt="" srcset="">
                                                        @else
                                                            <img
                                                                src="https://www.w3schools.com/howto/img_avatar.png"
                                                                alt="" srcset="">
                                                        @endif
                                                    </div>
                                                    <div class="form-file mt-2 form-group" style="margin-left: 8px">
                                                        <label class="form-file-label" for="image">
                                                            <input type="file" class="form-file-input" name="image"
                                                                   id="image"
                                                                   hidden>
                                                            <span class="form-file-button"><i
                                                                    data-feather="upload"></i></span>
                                                        </label>
                                                        <div class="form-group col-sm-6">
                                                            <div id="image-holder"
                                                                 style="width: 200px; position: relative"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mainProfile row">
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="first_name" class="mb-2"><span
                                                                    class="required">*</span> First Name</label>
                                                            <input type="text"
                                                                   value="{{$data->first_name ?? old('first_name') ?? ''}}"
                                                                   class="form-control" id="first_name"
                                                                   name="first_name" required>
                                                        </div>
                                                        <span
                                                            class="text-danger">@error('first_name'){{ $message }}@enderror</span>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="last_name" class="mb-2"><span
                                                                    class="required">*</span> Last Name</label>
                                                            <input type="text"
                                                                   value="{{$data->last_name ?? old('last_name') ?? ''}}"
                                                                   class="form-control" id="last_name" name="last_name"
                                                                   required
                                                            >
                                                        </div>
                                                        <span
                                                            class="text-danger">@error('last_name'){{ $message }}
                                                            @enderror
                                                    </span>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="designation" class="mb-2">Designation</label>
                                                            <input type="text"
                                                                   value="{{$data->designation ?? old('designation') ?? ''}}"
                                                                   class="form-control" id="designation"
                                                                   name="designation"
                                                                   required>
                                                        </div>
                                                        <span
                                                            class="text-danger">@error('designation'){{ $message }}
                                                            @enderror
                                                    </span>
                                                    </div>
                                                    @foreach(auth()->user()->roles as $roles)
                                                        @if($roles->slug == "doctor")
                                                            <div class="col-sm-12 col-md-6">
                                                                <fieldset class="form-group">
                                                                    <label for="department_id" class="mb-2 d-flex align-items-center"><span
                                                                            class="required">*</span> Department</label>
                                                                    <select name="department_id"
                                                                            class="form-select select2" style="width: 100%"
                                                                            required>
                                                                        <option value=""></option>
                                                                        @foreach($departments as $department)
                                                                            <option
                                                                                value="{{ $department->id }}" @if($data != null) {{ $data->department_id == $department->id ? 'selected' : '' }} @endif>{{ $department->title }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </fieldset>
                                                                <span
                                                                    class="text-danger">@error('department_id'){{ $message }}@enderror</span>
                                                            </div>
                                                            <div class="col-sm-12 col-md-6">
                                                                <fieldset class="form-group">
                                                                    <label for="user_type" class="mb-2 d-flex align-items-center"><span
                                                                            class="required">*</span> Doctor
                                                                        Type</label>
                                                                    <select name="user_type"
                                                                            class="form-control select2" style="width: 100%" required>
                                                                        <option value=""></option>
                                                                        <option
                                                                            value="INDOOR" @if($data != null){{ $data->user_type == 'INDOOR' ? 'selected': '' }} @endif >
                                                                            Indoor
                                                                        </option>
                                                                        <option
                                                                            value="OUTDOOR" @if($data != null) {{ $data->user_type == 'OUTDOOR' ? 'selected': '' }} @endif>
                                                                            Outdoor
                                                                        </option>
                                                                    </select>
                                                                </fieldset>
                                                                <span
                                                                    class="text-danger">@error('user_type'){{ $message }}@enderror</span>
                                                            </div>
                                                        @else
                                                            <input type="text" value="STAFF" class="form-control"
                                                                   id="user_type" name="user_type" hidden>
                                                        @endif
                                                    @endforeach
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="phone_number" class="mb-2"><span
                                                                    class="required">*</span> Phone Number</label>
                                                            <input type="text"
                                                                   value="{{$data->phone_number?? old('phone_number') ?? ''}}"
                                                                   class="form-control" id="phone_number"
                                                                   name="phone_number"
                                                                   required>
                                                        </div>
                                                        <span
                                                            class="text-danger">@error('phone_number'){{ $message }}@enderror</span>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <fieldset class="form-group">
                                                            <label for="gender" class="mb-2 d-flex align-items-center"><span
                                                                    class="required">*</span> Gender</label>
                                                            <select name="gender" class="form-select select2" style="width: 100%" required>
                                                                <option hidden
                                                                        value="{{ old('gender') ?? $data->gender ?? '' }}"> {{ucwords($data->gender ?? '')}}</option>
                                                                <option value="male"
                                                                        @if (old('gender') == 'male') selected="selected" @endif>
                                                                    Male
                                                                </option>
                                                                <option value="female"
                                                                        @if (old('gender') == 'female') selected="selected" @endif>
                                                                    Female
                                                                </option>
                                                                <option value="other"
                                                                        @if (old('gender') == 'other') selected="selected" @endif>
                                                                    Other
                                                                </option>
                                                            </select>
                                                        </fieldset>
                                                        <span
                                                            class="text-danger">@error('gender'){{ $message }}@enderror</span>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="dob" class="mb-2"><span
                                                                    class="required">*</span> Date of Birth</label>
                                                            <input type="date"
                                                                   value="{{$data->dob ?? old('dob') ?? ''}}"
                                                                   class="form-control"
                                                                   id="dob" name="dob" required>
                                                        </div>
                                                        <span
                                                            class="text-danger">@error('dob'){{ $message }}@enderror</span>
                                                    </div>

                                                    <div class="col-sm-12 col-md-6">
                                                        <fieldset class="form-group" >
                                                            <label for="blood_group" class="mb-2 d-flex align-items-center"><span
                                                                    class="required">*</span> Blood Group</label>
                                                            <select  name="blood_group" class="form-select select2" style="width: 100%" required>
                                                                <option hidden
                                                                        value="{{ $data->blood_group ?? '' }}"> {{ucwords($data->blood_group ?? '') }}</option>
                                                                <option value="a+"
                                                                        @if (old('blood_group') == 'a+') selected="selected" @endif>
                                                                    A+
                                                                </option>
                                                                <option value="a-"
                                                                        @if (old('blood_group') == 'a-') selected="selected" @endif>
                                                                    A-
                                                                </option>
                                                                <option value="b+"
                                                                        @if (old('blood_group') == 'b+') selected="selected" @endif>
                                                                    B+
                                                                </option>
                                                                <option value="b-"
                                                                        @if (old('blood_group') == 'b-') selected="selected" @endif>
                                                                    B-
                                                                </option>
                                                                <option value="o+"
                                                                        @if (old('blood_group') == 'o+') selected="selected" @endif>
                                                                    O+
                                                                </option>
                                                                <option value="o-"
                                                                        @if (old('blood_group') == 'o-') selected="selected" @endif>
                                                                    O-
                                                                </option>
                                                                <option value="ab+"
                                                                        @if (old('blood_group') == 'ab+') selected="selected" @endif>
                                                                    AB+
                                                                </option>
                                                                <option value="ab-"
                                                                        @if (old('blood_group') == 'ab-') selected="selected" @endif>
                                                                    AB-
                                                                </option>
                                                            </select>
                                                        </fieldset>
                                                        <span
                                                            class="text-danger">@error('blood_group'){{ $message }}@enderror</span>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="nid" class="mb-2"><span
                                                                    class="required">*</span>Nid</label>
                                                            <input type="text"
                                                                   value="{{$data->nid ?? old('nid') ?? ''}}"
                                                                   class="form-control" id="nid" name="nid" required>
                                                        </div>
                                                        <span
                                                            class="text-danger">@error('nid'){{ $message }}@enderror</span>
                                                    </div>
                                                    @if($data != null)
                                                        <div class="col-sm-12 col-md-6">
                                                            <div class="form-group">
                                                                <label for="salary" class="mb-2"><span class="required">*</span> Salary</label>
                                                                <input type="text" class="form-control" id="salary" name="salary"
                                                                       value="{{$data->salary ?? ''}}"
                                                                       placeholder="Salary" required readonly>
                                                            </div>
                                                            <span class="text-danger">@error('salary'){{ $message }}@enderror</span>
                                                        </div>
                                                    @else
                                                        <input type="text" class="form-control" id="salary" name="salary"
                                                               value="0" required hidden>
                                                    @endif
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="joining_date" class="mb-2">Joining Date</label>
                                                            <input type="date"
                                                                   value="{{$data->joining_date ?? old('joining_date') ?? ''}}"
                                                                   class="form-control"
                                                                   id="joining_date" name="joining_date" required>
                                                        </div>
                                                        <span
                                                            class="text-danger">@error('joining_date'){{ $message }}@enderror</span>
                                                    </div>

                                                    <div class="col- mt-2">
                                                        <label for="present_address" class="mt-2 font-weight-bolder"><span
                                                                class="required">*</span> Present
                                                            Address</label>
                                                        <hr style="margin: 10px 0px">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="present_address['country']"
                                                                   class="mb-2">Country</label>
                                                            <input type="text" name="present_address[country]"
                                                                   id="present_country" class="form-control"
                                                                   value="{{ $data->present_address['country'] ?? '' }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="present_address[district]"
                                                                   class="mb-2">District</label>
                                                            <input type="text" name="present_address[district]"
                                                                   id="present_district"
                                                                   class="form-control"
                                                                   value="{{ $data->present_address['district'] ?? '' }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="present_address[upazila]" class="mb-2">Thana/Upazila</label>
                                                            <input type="text" name="present_address[upazila]"
                                                                   id="present_upazila"
                                                                   class="form-control"
                                                                   value="{{ $data->present_address['upazila'] ?? '' }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="present_address[post_code]" class="mb-2">Post
                                                                Code</label>
                                                            <input type="text" name="present_address[post_code]"
                                                                   id="present_post"
                                                                   class="form-control"
                                                                   value="{{ $data->present_address['post_code'] ?? '' }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="present_address[address_line1]" class="mb-2">Address
                                                                Line
                                                                1</label>
                                                            <textarea class="form-control"
                                                                      name="present_address[address_line1]"
                                                                      id="present_add1"
                                                                      rows="2"
                                                                      required>{{ $data->present_address['address_line1'] ?? '' }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="present_address[address_line2]" class="mb-2">Address
                                                                Line
                                                                2</label>
                                                            <textarea class="form-control"
                                                                      name="present_address[address_line2]"
                                                                      id="present_add2"
                                                                      rows="2">{{ $data->present_address['address_line2'] ?? '' }}</textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col- mt-2">
                                                        <label for="permanent_address" class="mt-2 font-weight-bolder"><span
                                                                class="required">*</span> Permanent
                                                            Address &nbsp; &nbsp;</label>
                                                        <input type="checkbox" id="same_as_present"
                                                               name="same_as_present">
                                                        <label for="same_as_present">Same as Present</label>
                                                        <hr style="margin: 10px 0px">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="permanent_address['country']" class="mb-2">Country</label>
                                                            <input type="text" name="permanent_address[country]"
                                                                   id="permanent_country"
                                                                   class="form-control"
                                                                   value="{{ $data->permanent_address['country'] ?? '' }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="permanent_address[district]" class="mb-2">District</label>
                                                            <input type="text" name="permanent_address[district]"
                                                                   id="permanent_district"
                                                                   class="form-control"
                                                                   value="{{ $data->permanent_address['district'] ?? '' }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="permanent_address[upazila]" class="mb-2">Thana/Upozila</label>
                                                            <input type="text" name="permanent_address[upazila]"
                                                                   id="permanent_upazila"
                                                                   class="form-control"
                                                                   value="{{ $data->permanent_address['upazila'] ?? '' }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="permanent_address[post_code]" class="mb-2">Post
                                                                Code</label>
                                                            <input type="text" name="permanent_address[post_code]"
                                                                   id="permanent_post"
                                                                   class="form-control"
                                                                   value="{{ $data->permanent_address['post_code'] ?? '' }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="permanent_address[address_line1]" class="mb-2">Address
                                                                Line
                                                                1</label>
                                                            <textarea class="form-control"
                                                                      name="permanent_address[address_line1]"
                                                                      id="permanent_add1"
                                                                      rows="2"
                                                                      required>{{ $data->permanent_address['address_line1'] ?? '' }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="permanent_address[address_line2]" class="mb-2">Address
                                                                Line
                                                                2</label>
                                                            <textarea class="form-control"
                                                                      name="permanent_address[address_line2]"
                                                                      id="permanent_add2"
                                                                      rows="2">{{ $data->permanent_address['address_line2'] ?? '' }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="showEducation row">
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="degree_level" class="mb-2 d-flex align-items-center"> Degree Level</label>
                                                            <input type="text" class="form-control" id="degree_level" name="degree_level"
                                                                   value="{{ old('degree_level', $educations->degree_level ?? '') }}"
                                                            >
                                                        </div>
                                                        <span class="text-danger">@error('degree_level'){{ $message }}@enderror</span>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="degree" class="mb-2 d-flex align-items-center"> Degree</label>
                                                            <input type="text" class="form-control" id="degree" name="degree"
                                                                   value="{{ old('degree', $educations->degree ?? '') }}">
                                                        </div>
                                                        <span class="text-danger">@error('degree'){{ $message }}@enderror</span>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="passing_year" class="mb-2 d-flex align-items-center">Passing Year</label>
                                                            <input type="number" min="0" class="form-control" id="passing_year" name="passing_year"
                                                                   value="{{ old('passing_year',$educations->passing_year ?? '') }}">
                                                        </div>
                                                        <span class="text-danger">@error('passing_year'){{ $message }}@enderror</span>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="result" class="mb-2 d-flex align-items-center">Result</label>
                                                            <input type="text" maxlength="4" class="form-control" id="result" name="result"
                                                                   value="{{ old('result', $educations->result ?? '') }}">
                                                        </div>
                                                        <span class="text-danger">@error('result'){{ $message }}@enderror</span>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="board_university" class="mb-2 d-flex align-items-center">Board / University</label>
                                                            <input type="text" class="form-control" id="board_university" name="board_university"
                                                                   value="{{ old('board_university', $educations->board_university ?? '') }}">
                                                        </div>
                                                        <span class="text-danger">@error('board_university'){{ $message }}@enderror</span>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="major" class="mb-2 d-flex align-items-center">Major</label>
                                                            <input type="text" class="form-control" id="major" name="major"
                                                                   value="{{ old('major', $educations->major ?? '') }}">
                                                        </div>
                                                        <span class="text-danger">@error('major'){{ $message }}@enderror</span>
                                                    </div>
                                                </div>
                                                <div class="showQualification row">
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="org_name" class="mb-2 d-flex align-items-center">Organization Name</label>
                                                            <input type="text" class="form-control" id="org_name" name="org_name"
                                                                   value="{{ old('org_name', $qualifications->org_name ?? '') }}"
                                                            >
                                                        </div>
                                                        <span class="text-danger">@error('org_name'){{ $message }}@enderror</span>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="position" class="mb-2 d-flex align-items-center">Position</label>
                                                            <input type="text" class="form-control" id="position" name="position"
                                                                   value="{{ old('position', $qualifications->position ?? '') }}">
                                                        </div>
                                                        <span class="text-danger">@error('position'){{ $message }}@enderror</span>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="start_date" class="mb-2 d-flex align-items-center">Start Date</label>
                                                            <input type="date" min="0" class="form-control" id="start_date" name="start_date"
                                                                   value="{{ old('start_date', $qualifications->start_date ?? '') }}">
                                                        </div>
                                                        <span class="text-danger">@error('start_date'){{ $message }}@enderror</span>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="end_date" class="mb-2 d-flex align-items-center"> End Date</label>
                                                            <input type="date" class="form-control" id="end_date" name="end_date"
                                                                   value="{{ old('end_date', $qualifications->end_date ?? '') }}">
                                                        </div>
                                                        <span class="text-danger">@error('end_date'){{ $message }}@enderror</span>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="duration" class="mb-2 d-flex align-items-center">Duration</label>
                                                            <input type="text" class="form-control" id="duration" name="duration"
                                                                   value="{{ old('duration', $qualifications->duration ?? '') }}">
                                                        </div>
                                                        <span class="text-danger">@error('duration'){{ $message }}@enderror</span>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="responsibilities" class="mb-2 d-flex align-items-center">Responsibilities</label>
                                                            <textarea class="form-control"
                                                                      name="responsibilities" id="responsibilities"
                                                                      rows="2">{{$qualifications->responsibilities ?? ''}}</textarea>
                                                        </div>
                                                        <span class="text-danger">@error('responsibilities'){{ $message }}@enderror</span>
                                                    </div>
                                                </div>



                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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
        $(document).ready(function (){
            $('.showEducation').hide()
            $('.showQualification').hide()

            $('#education').on('click', function (e){
                $('.mainProfile').hide()
                $('.showEducation').show()
                $('.showQualification').hide()
            })
            $('#qualification').on('click', function (e){
                $('.mainProfile').hide()
                $('.showEducation').hide()
                $('.showQualification').show()

            })
            $('#profile').on('click', function (e){
                $('.mainProfile').show()
                $('.showEducation').hide()
                $('.showQualification').hide()

            })

        })
        //JQuery validation

        $("#createForm").validate({
            errorPlacement: function (error, e) {
                e.parents('.form-group').append(error);
            },
            rules:{
                first_name: "required",
                last_name: "required",
                designation: "required",
                department:"required",
                phone_number: "required",
                dob:"required",
                gender:"required",
                blood_group: "required",
                nid: "required",
                joining_date: "required",
                present_address :"required",
                permanent_address: "required",
                image : {
                    required:true,
                    extension: "Jpeg|Jpg|Png"
                },

            },
            messages:{
                first_name: "First Name is required",
                last_name: "Last Name is required",
                designation: "Designation is required",
                department: "Department is required",
                phone_number: "Phone Number is required",
                dob: "Date of Birth is required",
                gender: "Gender is required",
                blood_group: "Blood Group is required",
                nid: "NID is required",
                joining_date: "Joining Date is required",
                present_address: "Present Address is required",
                permanent_address: "Permanent Address is required",
                image:"Image is required",

            }
        });
        //For Image Preview
        $("#image").on('change', function () {
            var imgPath = $(this)[0].value;
            var extension = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            if (extension === "gif" || extension === "png" || extension === "jpg" || extension === "jpeg") {
                if (typeof (FileReader) != "undefined") {

                    var image_holder = $("#image-holder");
                    image_holder.empty();

                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $("<img />", {
                            "src": e.target.result,
                            "class": "img-thumbnail"
                        }).appendTo(image_holder);
                    };
                    image_holder.show();
                    reader.readAsDataURL($(this)[0].files[0]);
                } else {
                    alert("This browser does not support FileReader.");
                }
            } else {
                alert("Please Select Image Only !");
            }
        });
        $("input[name*='same_as_present']").click(function () {
            $("#permanent_country").val($("#present_country").val());
            $("#permanent_district").val($("#present_district").val());
            $("#permanent_upazila").val($("#present_upazila").val());
            $("#permanent_post").val($("#present_post").val());
            $("#permanent_add1").val($("#present_add1").val());
            $("#permanent_add2").val($("#present_add2").val());
        })
        $(".select2").select2({
            allowClear: true,
        })

    </script>
@endpush

