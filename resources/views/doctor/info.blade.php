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
                            <h3 class="text-capitalize">Doctor Information</h3>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('doctor.index')}}" class="btn-sm btn-primary">BACK</a>
                            </div>
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

                <div class="row">
                    @if($doctor->profile != null && $doctor->profile->image != null)
                        <div class="col-sm-12 col-md-12 text-center my-4">
                            <div class="profile-picture">
                                <img src="{{asset("storage/images/".$doctor->profile->image)}}"
                                     alt="">
                            </div>
                        </div>
                    @endif
                    <div class="card hms-box-shadow">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="profileInfo row">
                                        @if($doctor->profile != null)
                                            <div class="col-sm-12 col-md-6">
                                                <b><label for="first_name" class="mb-2">First Name</label></b>
                                                <p>{{ ucwords($doctor->profile->first_name ?? 'N/A') }}</p>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <b><label for="last_name" class="mb-2">Last Name</label></b>
                                                <p>{{ ucwords($doctor->profile->last_name ?? 'N/A') }}</p>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <b><label for="email" class="mb-2">Email Address</label></b>
                                                <p>{{ $doctor->email ?? 'N/A' }}</p>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <b><label for="designation" class="mb-2">Designation</label></b>
                                                <p>{{ ucwords($doctor->profile->designation ?? 'N/A') }}</p>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <b><label for="department_id" class="mb-2">Department</label></b>
                                                <p>{{ ucwords($doctor->profile->departments->title ?? 'N/A') }}</p>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <b><label for="phone_number" class="mb-2">Phone Number</label></b>
                                                <p>{{ ucwords($doctor->profile->phone_number ?? 'N/A') }}</p>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <b><label for="dob" class="mb-2">Date of Birth</label></b>
                                                <p>{{ ucwords($doctor->profile->dob ?? 'N/A') }}</p>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <b><label for="gender" class="mb-2">Gender</label></b>
                                                <p>{{ucwords($doctor->profile->gender ?? 'N/A')  }}</p>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <b><label for="blood_group" class="mb-2">Blood Group</label></b>
                                                <p>{{ ucwords($doctor->profile->blood_group ?? 'N/A') }}</p>
                                            </div>
                                            @if($doctor->profile->nid != null)
                                                <div class="col-sm-12 col-md-6">
                                                    <b><label for="blood_group" class="mb-2">NID</label></b>
                                                    <p>{{ $doctor->profile->nid ?? 'N/A' }}</p>
                                                </div>
                                            @endif
                                            <div class="col-sm-12 col-md-6">
                                                <b><label for="salary" class="mb-2">Salary</label></b>
                                                <p>{{ $doctor->profile->salary ?? 'N/A' }} BDT</p>
                                            </div>
                                            @if($doctor->profile->joining_date != null)
                                                <div class="col-sm-12 col-md-6">
                                                    <b><label for="joining_date" class="mb-2">Joining Date</label></b>
                                                    <p>{{ ucwords($doctor->profile->joining_date ?? 'N/A') }}</p>
                                                </div>
                                            @endif
                                            <div class="col-sm-12 col-md-6">
                                                <b><label for="biography" class="mb-2">Short Biography</label></b>
                                                <p>{{ ucwords($doctor->profile->biography ?? 'N/A') }}</p>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <b><label for="doctor_type" class="mb-2">{{'Doctor Type'}}</label></b>
                                                @if($doctor->profile->user_type == "INDOOR")
                                                    <p>{{ ucwords("Indoor" ?? 'N/A') }}</p>
                                                @else
                                                    <p>{{ucwords("Outdoor" ?? 'N/A')}}</p>
                                                @endif
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <b><label for="status" class="mb-2">{{'Status'}}</label></b>
                                                <br>
                                                @if($doctor->profile->status == 1)
                                                    <p class="badge bg-success mb-1">{{ ucwords("Active" ?? 'N/A') }}</p>
                                                @else
                                                    <p class="badge bg-danger mb-1">{{ucwords("Inactive" ?? 'N/A')}}</p>
                                                @endif
                                            </div>
                                            <div class="divider">
                                                <div class="divider-text">Present Address</div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <b><label for=present_address['country']" class="mb-2">Country</label></b>
                                                <p>{{$doctor->profile->present_address['country'] ?? 'N/A' }}</p>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <b><label for="present_address['district']"
                                                          class="mb-2">District</label></b>
                                                <p>{{$doctor->profile->present_address['district'] ?? 'N/A' }}</p>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <b><label for="present_address['upazila']"
                                                          class="mb-2">Thana/Upazila</label></b>
                                                <p>{{$doctor->profile->present_address['upazila'] ?? 'N/A' }}</p>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <b><label for="present_address['post_code']" class="mb-2">Post Code</label></b>
                                                <p>{{ $doctor->profile->present_address['post_code'] ?? 'N/A' }}</p>
                                            </div>
                                            <div class="col-sm-12">
                                                <b><label for="present_address['address']" class="mb-2">Address Line</label></b>
                                                <p>{{ ($doctor->profile->present_address['address_line1'].','.$doctor->profile->present_address['address_line2'] ?? 'N/A')}}</p>
                                            </div>
                                            <div class="divider">
                                                <div class="divider-text">Permanent Address</div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <b><label for=permanent_address['country']" class="mb-2">Country</label></b>
                                                <p>{{$doctor->profile->permanent_address['country'] ?? 'N/A' }}</p>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <b><label for="permanent_address['district']" class="mb-2">District</label></b>
                                                <p>{{$doctor->profile->permanent_address['district'] ?? 'N/A' }}</p>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <b><label for="permanent_address['upazila']"
                                                          class="mb-2">Thana/Upazila</label></b>
                                                <p>{{$doctor->profile->permanent_address['upazila'] ?? 'N/A' }}</p>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <b><label for="permanent_address['post_code']" class="mb-2">Post
                                                        Code</label></b>
                                                <p>{{ $doctor->profile->permanent_address['post_code'] ?? 'N/A' }}</p>
                                            </div>
                                            <div class="col-sm-12">
                                                <b><label for="permanent_address['address']" class="mb-2">Address Line</label></b>
                                                <p>{{ ($doctor->profile->permanent_address['address_line1'].','.$doctor->profile->permanent_address['address_line2'] ?? 'N/A')}}</p>
                                            </div>
                                    </div>
                                    <div class="educationInfo row">
                                        <div class="col-sm-12 col-md-6">
                                            <b><label for="degree_level" class="mb-2">Degree Level</label></b>
                                            <p>{{ $educations->degree_level ?? 'N/A' }}</p>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <b><label for="degree" class="mb-2">Degree</label></b>
                                            <p>{{ $educations->degree ?? 'N/A' }}</p>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <b><label for="passing_year" class="mb-2">Passing Year</label></b>
                                            <p>{{ $educations->passing_year ?? 'N/A' }}</p>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <b><label for="result" class="mb-2">Result</label></b>
                                            <p>{{ $educations->result ?? 'N/A' }}</p>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <b><label for="board_university" class="mb-2">Board / University</label></b>
                                            <p>{{ $educations->board_university ?? 'N/A' }}</p>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <b><label for="major" class="mb-2">Major</label></b>
                                            <p>{{ $educations->major ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                    <div class="qualificationInfo row">
                                        <div class="col-sm-12 col-md-6">
                                            <b><label for="org_name" class="mb-2">Organization Name</label></b>
                                            <p>{{ $qualifications->org_name ?? 'N/A' }}</p>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <b><label for="position" class="mb-2">Position</label></b>
                                            <p>{{ $qualifications->position ?? 'N/A' }}</p>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <b><label for="start_date" class="mb-2">Start Date</label></b>
                                            <p>{{ $qualifications->start_date ?? 'N/A' }}</p>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <b><label for="end_date" class="mb-2">End Date</label></b>
                                            <p>{{ $qualifications->end_date ?? 'N/A' }}</p>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <b><label for="duration" class="mb-2">Duration</label></b>
                                            <p>{{ $qualifications->duration ?? 'N/A' }}</p>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <b><label for="responsibilities" class="mb-2">Responsibilities</label></b>
                                            <p>{{ $qualifications->responsibilities ?? 'N/A' }}</p>
                                        </div>
                                    </div>

                                    @else
                                        <div class="col-sm-12 col-md-6">
                                            <b><label for="email" class="mb-2">Email Address</label></b>
                                            <p>{{ $doctor->email ?? 'N/A' }}</p>
                                        </div>
                                    @endif
                                </div>
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
                    $('.educationInfo').hide()
                    $('.qualificationInfo').hide()

                    $('#education').on('click', function (e){
                        $('.profileInfo').hide()
                        $('.educationInfo').show()
                        $('.qualificationInfo').hide()
                    })
                    $('#qualification').on('click', function (e){
                        $('.profileInfo').hide()
                        $('.educationInfo').hide()
                        $('.qualificationInfo').show()

                    })
                    $('#profile').on('click', function (e){
                        $('.profileInfo').show()
                        $('.educationInfo').hide()
                        $('.qualificationInfo').hide()

                    })



                })
            </script>
    @endpush
