@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Create Lab</h3>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('lab.index')}}" class="btn-sm btn-primary">BACK</a>
                            </div>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form id="createForm" class="form form-vertical" action="{{route('lab.store')}}" method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="lab_name" class="mb-2"><span class="required">*</span> Lab Name</label>
                                                <input type="text" class="form-control" id="lab_name" name="lab_name" value="{{ old('lab_name') }}"
                                                       placeholder="Lab Name" required>
                                            </div>
                                            <span class="text-danger">@error('lab_name'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="room_number" class="mb-2"><span class="required">*</span> Room Number</label>
                                                <input type="text" class="form-control" id="room_number" name="room_number" value="{{ old('room_number') }}"
                                                       placeholder="Room Number" required>
                                            </div>
                                            <span class="text-danger">@error('room_number'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="address" class="mb-2">Address</label>
                                                <textarea class="form-control"
                                                          name="address" id="add1"
                                                          rows="3"
                                                          >{{ old("address")  }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="status"><span class="required">*</span> Status</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status" id="active"
                                                           value="1" required>
                                                    <label class="form-check-label" for="active">Active</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status" id="inactive"
                                                           value="0" required>
                                                    <label class="form-check-label" for="inactive">Inactive</label>
                                                </div>
                                                <span class="text-danger">@error('status'){{ $message }}@enderror</span>
                                            </div>
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
    $("#createForm").validate({
        errorPlacement: function (error, e) {
            e.parents('.form-group').append(error);
        },
        rules:{
            lab_name: "required",
            room_number: "required",
            status:"required",
        },
        messages:{
            lab_name:"Lab name is required",
            room_number: "Room number is required",
            status: "Status is required",
        }
    });
</script>
@endpush
