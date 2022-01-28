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
                            <h3 class="text-capitalize">Patient Information</h3>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('patient.index')}}" class="btn-sm btn-primary">BACK</a>
                            </div>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="first_name" class="mb-2">First Name</label></b>
                                    <p>{{ ucwords($patient->first_name ?? '') }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="last_name" class="mb-2">Last Name</label></b>
                                    <p>{{ ucwords($patient->last_name ?? '') }}</p>
                                </div>
                                @if($patient->age != null)
                                    <div class="col-sm-12 col-md-6">
                                        <b><label for="age" class="mb-2">Age</label></b>
                                        <p>{{ ucwords($patient->age ?? '') }}</p>
                                    </div>
                                @endif
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="phone_number" class="mb-2">Phone Number</label></b>
                                    <p>{{ ucwords($patient->phone_no ?? '') }}</p>
                                </div>
                                @if($patient->gender != null)
                                    <div class="col-sm-12 col-md-6">
                                        <b><label for="gender" class="mb-2">Gender</label></b>
                                        <p>{{ucwords($patient->gender ?? '')  }}</p>
                                    </div>
                                @endif
                                @if($patient->blood_group != null)
                                    <div class="col-sm-12 col-md-6">
                                        <b><label for="blood_group" class="mb-2">Blood Group</label></b>
                                        <p>{{ ucwords($patient->blood_group ?? '') }}</p>
                                    </div>
                                @endif
                                @if($patient->religion != null)
                                    <div class="col-sm-12 col-md-6">
                                        <b><label for="religion" class="mb-2">Religion</label></b>
                                        <p>{{ ucwords($patient->religion ?? '') }}</p>
                                    </div>
                                @endif
                                @if($patient->dob != null)
                                    <div class="col-sm-12 col-md-6">
                                        <b><label for="dob" class="mb-2">Date of Birth</label></b>
                                        <p>{{ ucwords($patient->dob ?? '') }}</p>
                                    </div>
                                @endif
                                @if($patient->address != null)
                                    <div class="col-sm-12 col-md-6">
                                        <b><label for="address" class="mb-2">Address</label></b>
                                        <p>{{ ucwords($patient->address ?? '') }}</p>
                                    </div>
                                @endif
                                @if($patient->attendee_name != null)
                                    <div class="divider">
                                        <div class="divider-text">
                                            <label for="other_information" class="mt-2 font-weight-bolder">Attendee
                                                Information</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <b><label for="attendee_name" class="mb-2">Attendee Name</label></b>
                                        <p>{{ ucwords($patient->attendee_name) ?? '' }}</p>
                                    </div>
                                    @if($patient->attendee_relation != null)
                                        <div class="col-sm-12 col-md-6">
                                            <b><label for="attendee_relation" class="mb-2">Attendee Relation</label></b>
                                            <p>{{ ucwords($patient->attendee_relation) ?? '' }}</p>
                                        </div>
                                    @endif
                                    @if($patient->attendee_phone_no != null)
                                        <div class="col-sm-12 col-md-6">
                                            <b><label for="attendee_phone_no" class="mb-2">Attendee Contact</label></b>
                                            <p>{{ ucwords($patient->attendee_phone_no) ?? '' }}</p>
                                        </div>
                                    @endif
                                @endif

                                @if($patient->doctor_id != null)
                                    <div class="col- my-2">
                                        <label for="other_information" class="mt-2 font-weight-bolder">Doctor Information</label>
                                        <hr style="margin: 10px 0px">
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <b><label for="doctor_id" class="mb-2">Doctor Name</label></b>
                                        <p>{{ ucwords($patient->doctors->full_name) ?? '' }}</p>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <b><label for="doctor_type" class="mb-2">Doctor Type</label></b>
                                        <p>{{ ucfirst(strtolower($patient->doctors->user_type)) ?? '' }}</p>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <b><label for="department_id" class="mb-2">Doctor Department</label></b>
                                        <p>{{ ucwords($patient->doctors->departments->title) ?? '' }}</p>
                                    </div>
                                    @if($patient->assign_date != null)
                                        <div class="col-sm-12 col-md-6">
                                            <b><label for="department_id" class="mb-2">Doctor Assign Date</label></b>
                                            <p>{{ $patient->assign_date ?? '' }}</p>
                                        </div>
                                    @endif
                                    @if($patient->release_date != null)
                                        <div class="col-sm-12 col-md-6">
                                            <b><label for="department_id" class="mb-2">Doctor Release Date</label></b>
                                            <p>{{ $patient->release_date ?? '' }}</p>
                                        </div>
                                    @endif
                                @endif
                                <div class="divider">
                                    <div class="divider-text">Other Information</div>
                                </div>
                                @if( $patient->package_id)
                                    <div class="col-sm-12 col-md-6">
                                        <b><label for="department_id" class="mb-2">Package Name</label></b>
                                        <p>{{ $patient->package->package_name ?? '' }}</p>
                                    </div>
                                @endif
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="status" class="mb-2">{{'Status'}}</label></b>
                                    <br>
                                    @if($patient->status == 1)
                                        <p class="badge bg-success mb-1">{{ ucwords("Active" ?? '') }}</p>
                                    @else
                                        <p class="badge bg-danger mb-1">{{ucwords("Inactive" ?? '')}}</p>
                                    @endif
                                </div>
                                @if(count($histories) > 0)
                                    <div class="divider">
                                        <div class="divider-text">Patient History</div>
                                    </div>
                                    @if(count($histories) >= 10)
                                        @for($i=0; $i<=9 ; $i++)
                                            <div style="padding-bottom: 15px">
                                                <div class="col-sm-12 d-flex">
                                                    <b><label class="mb-2">History
                                                            Category :</label></b>
                                                    <p style="margin-left: 5px">{{ $histories[$i]->category ?? '' }}</p>
                                                </div>
                                                <div class="col-sm-12 d-flex">
                                                    <b><label class="mb-2">History
                                                            Type :</label></b>
                                                    <p style="margin-left: 5px">{{ $histories[$i]->type ?? '' }}</p>
                                                </div>
                                                <div class="col-sm-12 d-flex">
                                                    <b><label class="mb-2">Time :</label></b>
                                                    <p style="margin-left: 5px">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$histories[$i]->time)->format('d-m-y') ?? ''}}</p>
                                                </div>
                                                <div class="col-sm-12 d-flex">
                                                    <b><label class="mb-2">Description :</label></b>
                                                    <p style="margin-left: 5px">{{ $histories[$i]->description ?? '' }}</p>
                                                </div>
                                            </div>
                                        @endfor
                                    @else
                                        @for($i=0; $i<=count($histories)-1 ; $i++)
                                            <div style="padding-bottom: 15px">
                                                <div class="col-sm-12 d-flex">
                                                    <b><label class="mb-2">History
                                                            Category :</label></b>
                                                    <p style="margin-left: 5px">{{ ucfirst(strtolower($histories[$i]->category)) ?? '' }}</p>
                                                </div>
                                                <div class="col-sm-12 d-flex">
                                                    <b><label class="mb-2">History
                                                            Type :</label></b>
                                                    <p style="margin-left: 5px">{{ $histories[$i]->type ?? '' }}</p>
                                                </div>
                                                <div class="col-sm-12 d-flex">
                                                    <b><label class="mb-2">Time :</label></b>
                                                    <p style="margin-left: 5px">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$histories[$i]->time)->format('d-m-y') ?? ''}}</p>
                                                </div>
                                                <div class="col-sm-12 d-flex">
                                                    <b><label class="mb-2">Description :</label></b>
                                                    <p style="margin-left: 5px">{{ $histories[$i]->description ?? '' }}</p>
                                                </div>
                                                <div class="col-sm-12 d-flex">
                                                    <b><label class="mb-2">Updated By :</label></b>
                                                    <p style="margin-left: 5px">{{ $histories[$i]->updated_by ?? '' }}</p>
                                                </div>
                                            </div>
                                        @endfor
                                    @endif
                                    <div class="d-flex justify-content-end">
                                        <a href="{{route('patient.history',$patient->uuid)}}" class="btn-sm btn-success">Show All Histories</a>
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
